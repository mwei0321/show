<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  演出票、场次处理模型
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年2月10日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace common\models;
    use yii\db\ActiveRecord;
    use common\models\Ticket;

    class ApiTicket extends ActiveRecord{

        private $_week = ['周日','周一','周二','周三','周四','周五','周六'];

        static function tableName(){
            return 'ticket';
        }

        /**
         * 获取演出节目场次
         * @param  int $_showId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月10日 上午10:18:57
        **/
        function getShowTimesList($_showId){
            $times = (new Ticket())->getShowTimesById($_showId);

            foreach ($times as $k => $v){
                $times[$k]['times_id'] = $v['id'];
                $times[$k]['stime_date'] = date('Y-m-d',$v['stime']);
                $times[$k]['stime_week'] = $this->_week[date('w',$v['stime'])];
                $times[$k]['stime_time'] = date('H:i',$v['stime']);

                unset($times[$k]['id']);
                unset($times[$k]['etime']);
                unset($times[$k]['stime']);
                unset($times[$k]['ctime']);
            }

            return $times;
        }

        /**
         * 获取场次座位情况
         * @param  int $_show_id
         * @param  int $_timesId
         * @param  int $_roomId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月10日 上午10:19:39
        **/
        function getTimesSeatInfo($_show_id,$_timesId,$_roomId = 1){
            $ticketM = new Ticket();

            //获取房间座位
            $roomSeat = $ticketM->getRoomInfo($_roomId);
            //获取场次预留座位
            $resseredSeat = $ticketM->getShowTimesReserved($_timesId);
            $resseredSeatIds = $resseredSeat ? arr2to1($resseredSeat,'seat_id') : [];
            //获取已售座位
            $buySeat = $ticketM->getShowTicketSellInfo($_timesId);
            $buySeatIds = $buySeat ? arr2to1($buySeat,'seat_id') : [];
            //处理
            foreach ($roomSeat as $k => $v){
                $status = 0;
                //判断座位状态
                if(in_array($v['seat_id'],$resseredSeatIds)){
                    $status = 2;
                }elseif(in_array($v['seat_id'], $buySeatIds))
                    $status = 1;
                $roomSeat[$k]['status'] = $status;
                $roomSeat[$k]['times_id'] = $_timesId;
                $roomSeat[$k]['show_id'] = $_show_id;
                unset($roomSeat[$k]['id']);
            }

            return $roomSeat;
        }

        /**
         * 购票
         * @param  int $_memberId 会员ID
         * @param  int $_timesId 场次ID
         * @param  array $_seatId 座位ID
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月13日 上午9:46:45
        **/
        function BuyTicket($_memberId,$_timesId,$_seatId){
            $reCode = 1;

            //场次详情
            $timesInfo = self::find()->from('show_times')->where([
                            'and',
                            ['id'=>$_timesId],
                            ['>','stime',(time()+10)]
                        ])->asArray()->one();

            //判断场次节目是否开始，开始
            if($timesInfo){
                $seatLists = self::find()->from('room_seat')->where([
                                'room_id'=>$timesInfo['room_id'],
                                'seat_id'=>$_seatId
                            ])->asArray()->all();
                //判断座位
                if($seatLists){
                    $seatIsBuy = self::find()->from('ticket')->where([
                                    'seat_id'   => $_seatId,
                                    'times_id'  => $_timesId,
                                ])->count();

                    //判断座位是否已售
                    if($seatIsBuy == 0){
                        $seatIsReserved = self::find()->from('reserved_seat')->where([
                                    'seat_id'   => $_seatId,
                                    'times_id'  => $_timesId,
                                ])->count();
//                                 var_dump($seatIsReserved);exit;
                        //判断座位是否是预留
                        if($seatIsReserved == 0){
                            //写入订单
                            $orderM = new \common\models\CommonModel('ticket_order');
                            $orderM->member_id    = $_memberId;
                            $orderM->room_id      = $timesInfo['room_id'];
                            $orderM->show_id      = $timesInfo['show_id'];
                            $orderM->times_id     = $_timesId;
                            $orderM->code         = rand(100000,999999);
                            $orderM->ticket_num   = count($_seatId);
                            $orderM->save(false);
                            //写入购票数据
                            if($orderM->save(false) && $orderM->attributes['id'] > 0){
                                $seatLists = fieldtokey($seatLists,'seat_id');
                                $ticketIds = [];
                                foreach ($_seatId as $k => $v){
                                    $ticketM = new self();
                                    $ticketM->order_id     = $orderM->attributes['id'];
                                    $ticketM->times_id     = $_timesId;
                                    $ticketM->row          = $seatLists[$v]['row'];
                                    $ticketM->column       = $seatLists[$v]['column'];
                                    $ticketM->seat_id      = $v;
                                    $reid = $ticketM->save();
                                    $ticketIds[] = $ticketM->attributes['id'];
                                }
                                return $reid ? 1 : 0;
                            }
                            return 0;
                        }else {
                            $reCode = 5; //选择座位有预留的
                        }
                    }else {
                        $reCode = 4; //选择座位已售
                    }
                }else{
                    $reCode = 3; //场次已开始
                }
            }else{
                $reCode = 2; //场次已开始
            }

            return $reCode;
        }

        /**
         * 获取票务信息
         * @param  array $_ticketIds
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月13日 下午2:43:16
        **/
        function getTicketInfoByIds($_ticketIds){


        }
    }