<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  演出票处理控制器
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年2月9日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace api\controllers;
    use Yii;
    use api\controllers\CommonController;
    use common\models\ApiTicket;

    class TicketController extends CommonController{

        /**
         * 构造函数
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月15日 上午11:13:24
        **/
        function init(){
            parent::init();
        }

        /**
         * 获取演出场次
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月10日 上午10:13:10
        **/
        function actionGetshowtimes(){
            $showId = Yii::$app->request->get('show_id',0);
            if($showId < 1){
                $this->_reCode = 400;
                $this->_returnJson();
            }

            $ticketM = new ApiTicket();
            $seatList = $ticketM->getShowTimesList($showId) ? : [];

            return $this->_returnJson($seatList);
        }

        /**
         * 获取场次售票情况
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月10日 下午2:43:27
        **/
        function actionGettimesticket(){
            $showId = Yii::$app->request->get('show_id',1);
            $timesId = Yii::$app->request->get('times_id',1);

            $ticketM = new ApiTicket();
            $ticketList = $ticketM->getTimesSeatInfo($showId,$timesId);


            return $this->_returnJson($ticketList);
        }

        /**
         * 购买入场券
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月10日 下午2:46:19
        **/
        function actionBuyticket(){
            //检查用户登录
            $this->_checkUser();

            $timesId = Yii::$app->request->get('times_id',0);
            $seatId = Yii::$app->request->get('seat_id','');
            $seatIds = explode(',', $seatId);
//             $showId = Yii::$app->request->get('show_id',0);

            if($this->mid && $timesId && $seatIds && is_array($seatIds)){
                $ApiTicketM = new ApiTicket();
                $reid = $ApiTicketM->BuyTicket($this->mid, $timesId, $seatIds);
            }else{
                $this->_reCode = 440;
                $this->_reMsg = 'memeber -> '.$this->mid.' &seatId -> '.$seatId.' &timesId -> '.$timesId;
            }

            //提示消息
            $reMsg = [
                '出票失败，请重试！',
                '恭喜您，出票成功，感谢您的支持！',
                '场次选择错误，请刷新重试！',
                '非常抱歉，该场次已开始！',
                '非常抱歉，选择座位已售，请重新选择！',
                '非常抱歉，选择座位有预留的，请重新选择！',
            ];
            $this->_showMsg = $reMsg[1];
            //判断出票是否成功
            $data = [];
            if($reid != 1){
                $this->_reCode = 110;
                $this->_showMsg = $reMsg[$reid];
            }
            //返回数据
            $data['code'] = $reid;
            $data['msg'] = $reMsg[$reid];

            return $this->_returnJson($data);
        }

        /**
         * 退票
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月5日 下午3:37:54
        **/
        function actionRefundticket(){
            $orderId = Yii::$app->request->get('order_id');
            $this->_reCode  = 400;
            $this->_showMsg = '退票失败！请刷新后再操作！';
            $this->_reMsg = '';

            if($orderId > 0){ //订单ID过滤
                $orderInfo = \common\models\Order::find()->where([
                    'id'        => $orderId,
                ])->one();
                if ($orderInfo->member_id != $this->mid){
                    $this->_reCode = 440;
                }elseif($orderInfo->status == 7){
                    $this->_reCode = 400;
                    $this->_showMsg = '已退过票！请误重复操作！';
                }elseif($orderInfo->id > 0 && $orderInfo->status = 1){ //该人是否有该订单信息
                    $this->_reCode  = 200;
                    $timesInfo = (new \common\models\Ticket())->getTimesByIds($orderInfo->times_id);
                    $timesInfo = array_shift($timesInfo);
                    if($timesInfo['stime'] > (time()+1800)){ //判断退票时间为开场30分钟以前
                        $orderInfo->status = 7; //退票
                        if($orderInfo->save(false)){
                            $this->_showMsg = '退票成功！';
                            return $this->_returnJson();
                        }
                    }else{
                        $this->_reCode  = 462; //退票时间过了
                        $this->_reMsg   = '退票时间已过了';
                        $this->_showMsg = '退票时间已过了';
                    }
                }
            }

            $this->_returnJson();
        }

        function actionCreateseat(){
            if(Yii::$app->request->get('seat','') == 'yes'){
                (new \common\models\Ticket())->createRoomSeat(1);
            }
        }
    }


