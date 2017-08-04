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
    use Yii;

    class OrderController extends CommonController{

        function init(){
            parent::init();
        }

        /**
         * 生成二维码
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年8月4日 下午3:09:03
        **/
        function actionQrcode(){
            //导入二维码生成类
            require_once ROOT_PATH.'/common/library/phpqrcode.php';
            //保存文件
            $filename = ROOT_PATH.'/qrcode.png';
            //生成二维码
            \QRcode::png('mawei.live',$filename,'L',6,2);
//             //加入logo
//             if (file_exists($filename)) {
//                 $QR = imagecreatefromstring(file_get_contents($filename));
//                 $logo = imagecreatefromstring(file_get_contents($logo));
//                 $QR_width = imagesx($QR);//二维码图片宽度
//                 $QR_height = imagesy($QR);//二维码图片高度
//                 $logo_width = imagesx($logo);//logo图片宽度
//                 $logo_height = imagesy($logo);//logo图片高度
//                 $logo_qr_width = $QR_width / 5;
//                 $scale = $logo_width/$logo_qr_width;
//                 $logo_qr_height = $logo_height/$scale;
//                 $from_width = ($QR_width - $logo_qr_width) / 2;
//                 //重新组合图片并调整大小
//                 imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,
//                     $logo_qr_height, $logo_width, $logo_height);
//             }

//             //输出图片
//             imagepng($QR, ROOT_PATH.'/helloweba.png');

            return $filename;
        }

        /**
         * 取票
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年8月4日 下午3:41:54
        **/
        function actionCollectticket(){
            $orderId = Yii::$app->request->get('order_id',0);
            $code = Yii::$app->request->get('code',0);

            $info = \common\models\TicketOrder::find()->where([
                'id'    => $orderId,
                'code'  => $code,
            ])->one();


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