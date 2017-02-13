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
         * 获取演出丧心场次
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月10日 上午10:13:10
        **/
        function actionGetshowtimes(){
            $showId = Yii::$app->request->get('show_id',1);

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
            $memberId = Yii::$app->request->get('mid',1);
            $seatId = Yii::$app->request->get('seat_id','');
            $timesId = Yii::$app->request->get('times_id',0);
//             $showId = Yii::$app->request->get('show_id',0);

            if($memberId && $seatId && $timesId){
                $ApiTicketM = new ApiTicket();
                $reid = $ApiTicketM->BuyTicket($memberId, $timesId, $seatId);
            }else{
                $this->_reCode = 440;
                $this->_reMsg = 'memeber -> '.$memberId.' &seatId -> '.$seatId.' &timesId -> '.$timesId;
            }

            //提示消息
            $reMsg = [
                '出票失败，请重试！',
                '恭喜您，出票成功，感谢您的支持！',
                '场次选择错误，请刷新重试！',
                '非常抱歉，该场次已开始！',
                '非常抱歉，该座位已售，请重新选择！',
                '非常抱歉，该座位已售，请重新选择！',
            ];

            //判断出票是否成功
            $data = [];
            if($reid != 1){
                $this->_reCode = 400;
            }

            $data['code'] = $reid;

            $this->_returnJson($data);
        }
    }


