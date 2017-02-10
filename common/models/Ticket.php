<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  节目入场券操作模型
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年2月6日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace common\models;
    use yii\db\ActiveRecord;

    class Ticket extends ActiveRecord{

        static function tableName(){
            return 'ticket';
        }

        /**
         * 获取演出票购买详情
         * @param  int $_showId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月9日 下午2:43:29
        **/
        function getShowTicketInfo($_timesId){
            return self::find()->where(['times_id'=>$_timesId])->asArray()->all();
        }

        /**
         * 获取节目演出预留的座位
         * @param  int $_timesId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月9日 下午3:09:51
        **/
        function getShowTimesReserved($_timesId){
            return self::find()->from('reserved_seat')->where(['show_times'=>$_timesId])->asArray()->one();
        }

        /**
         * 获取演出场次
         * @param  int $_showId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月7日 上午11:11:24
         **/
        function getShowTimesById($_showId){
            return self::find()->from('show_times')->where([
                'and',
                ['show_id'   => $_showId],
                ['>','stime',(time()+10)]
            ])->orderBy('stime DESC')->asArray()->all();
        }

        /**
         * 返回座位信息
         * @param  int $_seatId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月10日 下午3:49:46
        **/
        function getSeatInfoById($_seatId){
            return self::find()->from('room_seat')->where(['seat_id'=>$_seatId])->asArray()->one();
        }

        /**
         * 检查座位是否已售、或者预留
         * @param  int $_seatId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月10日 下午3:53:27
        **/
        function getSeatIsBuy($_seatId){

        }

        /**
         * 获取演出房间信息
         * @param  int $_roomId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月9日 下午3:06:55
        **/
        function getRoomInfo($_roomId){
            return self::find()->from('room_seat')->where(['room_id'=>$_roomId])->orderBy('seat_id ASC')->asArray()->all();
        }

        /**
         * 创建房间座位
         * @param  array $_coord 座位数组 [列,列]
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月10日 上午11:00:53
        **/
        function createRoomSeat($_roomId = 1,$_coord = [29,28,28,23,23,23,23,23,23,28,28,28,28,27,27]){
            //删除座位
            (new \common\models\CommonModel('room_seat'))->deleteAll(['room_id'=>$_roomId]);
            //写入座位sql
            $sql = "INSERT INTO `room_seat` (`room_id`,`row`,`column`,`seat_id`) VALUES ";

            $seatId = 1;
            foreach ($_coord as $k => $v){
                for($i = 1;$i <= $v;$i++){
                    $sql .= "($_roomId,".($k+1).",$i,$seatId),";
                    $seatId++;
                }
            }
            $sql = substr($sql, 0,-1);
            //写入数据到数据库
            return \Yii::$app->db->createCommand($sql)->execute();
        }
    }