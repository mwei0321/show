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
        function getShowTicketInfo($_showId){


        }

        /**
         * 获取节目演出不可能用的座位
         * @param  array
         * @param  string
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月9日 下午3:09:51
        **/
        function getShowTimesForbid($_timesId){

        }

        /**
         * 获取演出房间信息
         * @param  int $_roomId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月9日 下午3:06:55
        **/
        function getRoomInfo($_roomId){
            return self::find()->from('room_seat')->where(['room_number'=>$_roomId])->one();
        }
    }