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
use common\models\Ticket;

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

//             var_dump(time());exit;

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
            $times = Yii::$app->request->get('times_id',1);

            $ticketM = new ApiTicket();
            $ticketList = $ticketM->getTimesSeatInfo($times);


            return $this->_returnJson($ticketList);
        }

        /**
         * 购买入场券
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月10日 下午2:46:19
        **/
        function actionBuyTicket(){
            $memberId = Yii::$app->request->get('mid',1);
            $seatId = Yii::$app->request->get('seat_id',1);

            $ticketM = new Ticket();
            $ticketM->member_id     = $memberId;
            $ticketM->show_id       = $seatId;
        }
    }


