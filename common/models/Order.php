<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  处理订单
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年2月15日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace common\models;
    use yii\db\ActiveRecord;

    class Order extends ActiveRecord{
        public $_pageSize = 20;

        /**
         * 定义表名
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月15日 下午2:24:10
        **/
        static function tableName() {
            return 'ticket_order';
        }

        /**
         * 我的订单列表
         * @param  array $_where
         * @param  string $_offset
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月15日 下午2:18:41
        **/
        function getOrderList($_where = 1,$_offset = 'count'){
            $orderM = self::find()->where($_where);
            if($_offset == 'count'){
                return $orderM->count();
            }

            $data = $orderM->offset($_offset)->limit($this->_pageSize)->orderBy('id DESC')->asArray()->all();
            //添加订单下的票
            $ticket = $this->getOrderTicketByOId(arr2to1($data));
            foreach ($data as $k => $v){
                $data[$k]['ticket'] = $ticket[$v['id']];
            }

            return $data;
        }

        /**
         * 获取订单票
         * @param  int|array $_orderId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月15日 下午2:26:07
        **/
        function getOrderTicketByOId($_orderId){
            $ticketList = self::find()->from('ticket')->where([
                            'order_id'  =>  $_orderId,
                        ])->asArray()->all();
            $data = [];
            foreach ($ticketList as $k => $v){
                $data[$v['order_id']] = $v;
            }

            return $data;
        }
    }
