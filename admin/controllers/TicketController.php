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

    class TicketController extends SiteController{

        function actionSeat(){
            $showId = Yii::$app->request->get('show_id',0);
            $roomId = 1;

            $times = $ticket = [];
            $timesId = 0;
            if($showId > 0){
                $ticketM = new Ticket();
                $times = $ticketM->getShowTimesById($showId);
                //                 var_dump($times);exit;
                $timesId = $times[0]['id']??0;
                if($timesId > 0){
                    //预留座位
                    $ReservedSeat = $ticketM->getShowTimesReserved($timesId);
                    $ReservedSeat = $ReservedSeat ? arr2to1($ReservedSeat,'seat_id') : [];
                    //已售座位
                    $buySeat = $ticketM->getShowTicketSellInfo($timesId);
                    $buySeat = $buySeat ? arr2to1($buySeat,'seat_id') : [];
                }
                //订单
//                 $order = \common\models\TicketOrder::getOrderList($timesId);
            }

            return $this->render('seat',[
                'times'     => $times,
                'ticket'    => $ticket,
                'show_id'   => $showId,
                'times_id'  => $timesId,
                'reserved'  => $ReservedSeat??[],
                'buyseat'   => $buySeat??[],
//                 'order'     => $order,
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

            $seatId = $seatcode = 0;
            $html = '';
            $reArray = [];
            $reArray['status'] = 200;
            //座位html
            foreach ($seatNum as $val){
                $html .= '<p class="oneset">';
                $seatcode += $val;
                $seatId = $seatcode;
                for ($i = 0;$i < $val;$i++){
                    $html .= '<a href="javascript:;" class="seat ';
                    if(in_array($seatId, $buySeat)){
                        $html .= 'sold "';
                    }elseif(in_array($seatId, $ReservedSeat)){
                        $html .= ' selected " iscancel="1" onclick="lockseat($(this),1);" url="'.Url::toRoute(['ticket/lock','show_id'=>$timesInfo['show_id'],'seat_id'=>$seatId,'tid'=>$timesId]).'" ';
                    }else{
                        $html .= '" onclick="lockseat($(this));" iscancel="0" url="'.Url::toRoute(['ticket/lock','show_id'=>$timesInfo['show_id'],'seat_id'=>$seatId,'tid'=>$timesId]).'" ';
                    }
                    $html .= '></a>';
                    $seatId--;
                }
                $html .= '</p>';
            }
            $reArray['html'] = $html;

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $reArray;
        }

        /**
         * 场次订单信息
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年8月1日 下午3:08:00
        **/
        function actionTimesorder(){
            $timesId = Yii::$app->request->get('times_id',0);

            $order = \common\models\TicketOrder::getOrderList($timesId);
            $html = '';
            $reArray = [];
            $reArray['status'] = 200;
            foreach ($order as $k => $v){
                $html .= '<tr><td> ';
                $html .= $v['code'].' </td><td>';
                foreach ($v['seats'] as $val){
                    $html .= $val['row']." 排 ".$val['column']." 座&nbsp;";
                }
                $html .= '</td><td>'.$v['cellphone'].'</td></tr>';
            }

            $reArray['html'] = $html;

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $reArray;
        }

        /**
         * 订单信息下载
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年8月1日 下午4:38:11
        **/
        function actionExcel(){
            $timesId = Yii::$app->request->get('times_id',0);
            $time = Yii::$app->request->get('time','');
            $showId = Yii::$app->request->get('show_id',0);
            //导入excel库
            require_once ROOT_PATH.'/common/library/PhpExcel.php';
            $excelObj = new \PhpExcel2();
            //订单信息
            $orderlist = \common\models\TicketOrder::getOrderList($timesId);
            $orderdata = [];
                if($orderlist){
                foreach ($orderlist as $k => $v){
                    $orderdata[$k]['code'] = $v['code'];
                    $seats = '';
                    foreach ($v['seats'] as $val){
                        $seats .= $val['row']."排".$val['column']."座 ";
                    }
                    $orderdata[$k]['seats'] = $seats;
                    $orderdata[$k]['cellphone'] = $v['cellphone'];
                }
            }
            //演出信息
            $showInfo = \common\models\Show::findOne($showId);
            $title = "$showInfo->title".date('Y-m-d-H-i');

            $excelObj->setSheetIndex("$title");
            $excelObj->writeCellTitle(['订单序列号','座位号','联系方式']);
            $excelObj->writeData($orderdata);
            $excelObj->downloadFile("$title");
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
                $reArray['status'] = 1;//已售
            }elseif($seatStatus == 2){
                $ticketM->find()->createCommand()->delete('reserved_seat',['times_id'=>$timesId,'seat_id'=>$seatId])->execute();
                $reArray['status'] = 2;//取消预留
            }elseif($seatStatus == 0){
                $seatInfo = $ticketM->getSeatInfoById($seatId);
                //赋值
                $seatM = new CommonModel('reserved_seat');
                $seatM->show_id   = $showId;
                $seatM->times_id  = $timesId;
                $seatM->row       = $seatInfo['row'];
                $seatM->column    = $seatInfo['column'];
                $seatM->seat_id   = $seatId;
                if ($seatM->save(false)){
                    $reArray['status'] = 3;//写入预留
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
            if(in_array($action->id,['lock','timesorder'])){
                $action->controller->enableCsrfValidation = false;
            }
            parent::beforeAction($action);

            return true;
        }
    }
