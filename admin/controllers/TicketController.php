<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  售票情况相关
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年2月20日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace admin\controllers;
    use Yii;
    use yii\web\Controller;
    use common\models\Ticket;
    use yii\helpers\Url;
    use common\models\CommonModel;

    class TicketController extends Controller{

        function actionSeat(){
            $showId = Yii::$app->request->get('show_id',0);
            $roomId = 1;

            $times = $ticket = [];
            $timesId = 0;
            if($showId > 0){
                $ticketM = new Ticket();
                $times = $ticketM->getShowTimesById($showId);
                //                 var_dump($times);exit;
                $timesId = $times[0]['id'];
                //预留座位
                $ReservedSeat = $ticketM->getShowTimesReserved($timesId);
                $ReservedSeat = $ReservedSeat ? arr2to1($ReservedSeat,'seat_id') : [];
                //已售座位
                $buySeat = $ticketM->getShowTicketSellInfo($timesId);
                $buySeat = $buySeat ? arr2to1($buySeat,'seat_id') : [];

            }

            return $this->render('seat',[
                'times'     => $times,
                'ticket'    => $ticket,
                'show_id'   => $showId,
                'times_id'  => $timesId,
                'reserved'  => $ReservedSeat,
                'buyseat'   => $buySeat,
                'seatNum'   => $ticketM->_RoomSeatNum($roomId),
            ]);
        }

        /**
         * 锁票
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月20日 下午3:35:03
        **/
        function actionLockseat(){
            $showId = Yii::$app->request->get('show_id',0);
            $roomId = 1;

            $times = $ticket = [];
            $timesId = 0;
            if($showId > 0){
                $ticketM = new Ticket();
                $times = $ticketM->getShowTimesById($showId);
//                 var_dump($times);exit;
                $timesId = $times[0]['id'];
                //预留座位
                $ReservedSeat = $ticketM->getShowTimesReserved($timesId);
                $ReservedSeat = $ReservedSeat ? arr2to1($ReservedSeat,'seat_id') : [];
                //已售座位

//                 var_dump($ticket);exit;
            }

            return $this->render('lock',[
                'times'     => $times,
                'ticket'    => $ticket,
                'show_id'   => $showId,
                'times_id'  => $timesId,
                'reserved'  => $ReservedSeat,
                'seatNum'   => $ticketM->_RoomSeatNum($roomId),
            ]);
        }

        /**
         * 场次座位
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月21日 上午10:20:05
        **/
        function actionTimesseat(){
            $timesId = Yii::$app->request->get('timesid',0);

            $ticketM = new Ticket();
            $timesInfo = $ticketM->getTimesByIds($timesId);
            $timesInfo = array_shift($timesInfo);
            //预留座位
            $ReservedSeat = $ticketM->getShowTimesReserved($timesId);
            $ReservedSeat = $ReservedSeat ? arr2to1($ReservedSeat,'seat_id') : [];
            //已售座位
            $buySeat = $ticketM->getShowTicketSellInfo($timesId);
            $buySeat = $buySeat ? arr2to1($buySeat,'seat_id') : [];

            $seatNum = $ticketM->_RoomSeatNum($timesInfo['room_id']);

            $seatId = 0;
            $html = '';
            $reArray = [];
            $reArray['status'] = 200;
            foreach ($seatNum as $val){
                $html .= '<p class="oneset">';
                for ($i = 0;$i <= $val;$i++){
                    $seatId++;
                    $html .= '<a class="seat ';
                    if(in_array($seatId, $buySeat)){
                        $html .= 'sold "';
                    }elseif(in_array($seatId, $ReservedSeat)){
                        $html .= ' selected " onclick="lockseat($(this));" url="'.Url::toRoute(['ticket/lock','show_id'=>$timesInfo['show_id'],'seat_id'=>$seatId,'tid'=>$timesId]).'" ';
                    }else{
                        $html .= '" onclick="lockseat($(this));" url="'.Url::toRoute(['ticket/lock','show_id'=>$timesInfo['show_id'],'seat_id'=>$seatId,'tid'=>$timesId]).'" ';
                    }
                    $html .= ' href="javascript:;"></a>';
                }
                $html .= '</p>';
            }
            $reArray['html'] = $html;

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $reArray;
        }

        /**
         * 锁座操作
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月20日 下午4:07:10
        **/
        function actionLock(){
            $timesId = Yii::$app->request->get('tid',0);
            $showId = Yii::$app->request->get('show_id',0);
            $seatId = Yii::$app->request->get('seat_id',0);
            //响应数据
            $reArray = [
                'status'=> 0,
                'url'   => Url::toRoute(['ticket/lockseat','show_id'=>$showId]),
            ];

            //锁票
            $ticketM = new Ticket();
            //0:未售 1:已售 2:已预留
            $seatStatus = $ticketM->checkSeatStatus($timesId, $seatId);
            if($seatStatus == 1){
                $reArray['status'] = 1;
            }elseif($seatStatus == 2){//取消预留
                $ticketM->find()->createCommand()->delete('reserved_seat',['times_id'=>$timesId,'seat_id'=>$seatId])->execute();
                $reArray['status'] = 2;
            }elseif($seatStatus == 0){ //写入预留
                $seatInfo = $ticketM->getSeatInfoById($seatId);
                //赋值
                $seatM = new CommonModel('reserved_seat');
                $seatM->show_id   = $showId;
                $seatM->times_id  = $timesId;
                $seatM->row       = $seatInfo['row'];
                $seatM->column    = $seatInfo['column'];
                $seatM->seat_id   = $seatId;
                if ($seatM->save(false)){
                    $reArray['status'] = 3;
                }
            }

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $reArray;
        }

        /**
         * 重写
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月17日 下午2:32:27
         **/
        function beforeAction($action){
            if(in_array($action->id,['lock'])){
                $action->controller->enableCsrfValidation = false;
            }
            parent::beforeAction($action);

            return true;
        }
    }
