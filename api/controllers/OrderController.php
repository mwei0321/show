<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  订单处理
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年2月15日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace api\controllers;
    use api\controllers\CommonController;
    use common\models\ApiOrder;

    class OrderController extends CommonController{

        function init(){
            parent::init();
        }

        /**
         * 我的订单列表
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月15日 上午11:02:32
        **/
        function actionGetmyorder(){
            //检查用户
            $this->_checkUser();

            $orderM = new ApiOrder();
            $this->_count = $orderM->getMyOrder($this->mid);
            if($this->_count < 1){
                $this->_reCode = 204;
                return $this->_returnJson();
            }

            $page = page($this->_count,20);
            $lists = $orderM->getMyOrder($this->mid,$page['offset']);

            return $this->_returnJson($lists);
        }

        /**
         * 订单详情
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年8月2日 下午3:13:43
        **/
        function actionGetorderinfo(){
            $orderId = \Yii::$app->request->get('order_id',0);

            $info = ApiOrder::getOrderInfoById($orderId);

            $this->_returnJson($info);
        }
    }