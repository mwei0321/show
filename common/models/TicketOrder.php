<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  订票订单
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年7月31日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.mawei.live
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace common\models;
    use yii\db\ActiveRecord;

    class TicketOrder extends ActiveRecord{

        static function tableName(){
            return 'ticket_order';
        }

        /**
         * 订单列表
         * @param  int $_timesId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月31日 下午3:09:22
        **/
        static function getOrderList($_timesId){
            $order = self::find()->select('id,member_id,show_id,times_id,code,ticket_num,ctime')->where(['times_id'=>$_timesId,'status'=>1])->orderBy('id DESC')->asArray()->all();
            if($order){
                foreach ($order as $k => $v){
                    //用户信息
                    $userInfo = \common\models\Member::find()->select('username,avatar,cellphone')->where(['id'=>$v['member_id']])->one();
                    $order[$k]['username']  = $userInfo->username;
                    $order[$k]['cellphone'] = $userInfo->cellphone;
                    $order[$k]['avatar']    = $userInfo->avatar;
                    //座位信息
                    $seatInfo = \common\models\Ticket::find()->select('column,row')->where(['order_id'=>$v['id']])->asArray()->all();
                    $order[$k]['seats'] = $seatInfo ? :[];
                }
            }

            return $order?:[];
        }
    }
