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
    }