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
            $buySeat = $ticketM->getShowTicketInfo($_timesId);
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
         * @param  int $_seatId 座位ID
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
                $seatInfo = self::find()->from('room_seat')->where([
                                'room_id'=>$timesInfo['room_id'],
                                'seat_id'=>$_seatId
                            ])->asArray()->one();

                //判断座位
                if($seatInfo){
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
                            //写入购票数据
                            $this->member_id    = $_memberId;
                            $this->room_id      = $timesInfo['room_id'];
                            $this->show_id      = $timesInfo['show_id'];
                            $this->times_id     = $_timesId;
                            $this->row          = $seatInfo['row'];
                            $this->column       = $seatInfo['column'];
                            $this->seat_id      = $_seatId;
                            $reid = $this->save();
                            exit;
                        }else {
                            $reCode = 5;
                        }
                    }else {
                        $reCode = 4;
                    }
                }else{
                    $reCode = 3;
                }
            }else{
                $reCode = 2;
            }

            return $reCode;
        }
    }