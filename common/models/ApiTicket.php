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


        /**
         * 获取演出节目场次
         * @param  int $_showId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月10日 上午10:18:57
        **/
        function getShowTimesList($_showId){
            return (new Ticket())->getShowTimesById($_showId);
        }

        /**
         * 获取场次座位情况
         * @param  int $_timesId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月10日 上午10:19:39
        **/
        function getTimesSeatInfo($_timesId,$_roomId = 1){
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
                unset($roomSeat[$k]['id']);
            }

            return $roomSeat;
        }
    }