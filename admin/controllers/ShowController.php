<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年1月11日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace admin\controllers;
    use Yii;
    use yii\web\Controller;
    use common\models\Show;
    use common\models\Actor;
    use common\models\CommonModel;
    use common\models\Ticket;

    class ShowController extends SiteController{
//         public $layout = 'template';
//         public $enableCsrfValidation = false;


        /**
         * 话剧演出节日列表
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月11日 下午6:21:43
        **/
        function actionIndex(){
            $where = [];
            $keyword = Yii::$app->request->get('keyword','');
            $keyword && $where = ['like','title',$keyword];

            $showModel = new Show();
            $count = $showModel->getShowList($where);
            $pageM = new \yii\data\Pagination([
                'totalCount'=>$count,
                'pageSize'=>$showModel->_pageSize,
                'pageParam'=>'p',
            ]);
            $lists = $showModel->getShowList($where,(string)$pageM->offset);
            //获取开始结束时间
            foreach ($lists as $k => $v){
                //写入演出时间范围
                $times = $showModel->getShowExpire($v['id']);
                $lists[$k]['stime'] = $times['stime'] ? date('Y-m-d',$times['stime']) : null;
                $lists[$k]['etime'] = date('Y-m-d',$times['etime']);
            }

            return $this->render('index',[
                'lists'     => $lists,
                'pages'     => $pageM,
            ]);
        }

        /**
         * 演出详情
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月23日 下午5:54:52
        **/
        function actionInfo(){
            //获取ID
            $showId = Yii::$app->request->get('show_id');

            //获取节目详情
            $showModel = new Show();
            $showInfo = $showModel->getShowInfoById($showId);
            //写入演出时间范围
            $times = $showModel->getShowExpire($showId);
            $showInfo['etime'] = date('Y-m-d',$times['etime']);
            //获取演员列表
            $actorObj = new Actor();
            $showActors = $actorObj->getShowActorInfo($showId);

            //获取场次
            $timesList = (new Ticket())->getShowTimesById($showId);
            $ReservedSeat = $buySeat = [];
            $timesId = 0;
            $roomId = 1;
            $ticketM = new Ticket();
            if($timesList){
                //预留座位
                $timesId = $timesList[0]['id'];
                $roomId = $timesList[0]['room_id'];
                $ReservedSeat = $ticketM->getShowTimesReserved($timesId);
                $ReservedSeat = $ReservedSeat ? arr2to1($ReservedSeat,'seat_id') : [];
                //已售座位
                $buySeat = $ticketM->getShowTicketSellInfo($timesId);
                $buySeat = $buySeat ? arr2to1($buySeat,'seat_id') : [];
            }

            return $this->render('info',[
                'showInfo'  => $showInfo,
                'showActors'=> $showActors,
                'showTimes' => $timesList,
                'reserved' => $ReservedSeat,
                'times_id' => $timesId,
                'seatNum'   => $ticketM->_RoomSeatNum($roomId),
            ]);
        }

        /**
         * 节目编辑，修改
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月12日 下午3:30:46
        **/
        function actionEdit(){
            //获取ID
            $id = Yii::$app->request->get('id');

            $showInfo = [];
            $timesList = [];
            if($id > 0){
                //获取节目详情
                $showModel = new Show();
                $showInfo = $showModel->getShowInfoById($id);
                //获取场次
                $timesList = (new Ticket())->getShowTimesById($id);
//                 var_dump($timesList);exit;
            }
            //获取演员列表
            $actorObj = new Actor();
            $actors = $actorObj->getActorInfoAll();
            //获取节目演员
            $showActorM = new CommonModel('show_actor');
            $showActors = $showActorM->getInfoByWhere(['show_id'=>$id]);

            //职务列表
            $dutys = $actorObj->getActorDutyLists();

            return $this->render('edit',[
                'showInfo'  => $showInfo,
                'actors'    => $actors,
                'dutys'     => $dutys,
                'showActors'=> $showActors,
                'showTimes' => $timesList,
            ]);
        }


        /**
         * 数据更新
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月13日 上午10:25:16
        **/
        function actionUpdata(){
            $request = Yii::$app->request;
            if(!trim($request->post('title',''))){
                return $this->redirect(['show/index']);
            }
            //时间
            $time = $request->post('time',[]);
            $show_id = $request->post('id','');
            //节目信息
            if($request->post('id','') > 0)
                $showModel = Show::findOne($show_id);
            else{
                $showModel = new Show();
                $showModel->ctime   =   time();
            }
            //时间判断
            $timeslist = Yii::$app->request->post('time',[]);
            if((Yii::$app->request->post('timesids',[])) || $timeslist){
                $showModel->status = 1;
            }else{
                $showModel->status = 2;
            }

            $showModel->title   =   $request->post('title','');
            $showModel->cover   =   $request->post('cover','');
            $showModel->intro   =   $request->post('intro','');
            $showModel->duration=   intval($request->post('duration',0));

//             var_dump($showModel);exit;
            if($showModel->save(false) && $showModel->id > 0){
                $showId = $showModel->id;
                //写入场次
                $isTime = 1;
                if(Yii::$app->request->post('time',[])){
                       $isTime = $this->_updataTimes($showId);
                }

                //删除演员
                (new CommonModel('show_actor'))->deleteAll(['show_id'=>$showModel->id]);
                //写入演员信息
                $actor = $request->post('actor',[]);
                $duty  = $request->post('duty',[]);
                $act  = $request->post('act',[]);
                foreach ($actor as $k => $v){
                    if($v > 0){
                        $actorModel = new CommonModel('show_actor');
                        $actorModel->show_id     = $showModel->id;
                        $actorModel->actor_id    = $v;
                        $actorModel->duty        = $duty[$k];
                        $actorModel->act         = $act[$k];
                        $actorModel->ctime       = time();
                        $actorModel->save(false);
//                     echo $actorModel->id;
                    }
                }
                if($show_id > 0 || $isTime)
                    return $this->redirect(['show/index']);
                else
                    return $this->redirect(['ticket/lockseat','show_id'=>$showId]);
            }

            return $this->renderPartial('jump');
        }

        /**
         * 演出场次处理
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月7日 下午3:56:14
        **/
        function _showTimes($_showId){
            $times = Yii::$app->request->post('time',[]);

            //删除之前的场次
            (new Show())->deleteShowTimesByIds($_showId);

            //写入新的场次
            if($times && is_array($times)){
                foreach ($times as $k => $v){
                    $showTimesM = new CommonModel('show_times');
                    $showTimesM->show_id    = $_showId;
                    $showTimesM->stime      = strtotime($v);
                    $showTimesM->ctime      = time();
                    $showTimesM->save();
                }
            }

            return null;
        }

        /**
         * 更新、添加演出场次
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月22日 上午10:26:54
        **/
        function _updataTimes($_showId){
            $request = Yii::$app->request;

            $isTime = 1;
//             //更新场次
//             $timesIds = $request->post('timesids','');
//             if($timesIds){
//                 $timesIds = explode(',', substr($timesIds,0,-1));
//                 foreach ($timesIds as $k => $v){
//                     $stime = $request->post('times_'.$v,'');
//                     $stime = strtotime($stime);
//                     $TimesM = \admin\models\ShowTimes::findOne(['id'=>$v]);
//                     $TimesM->stime = $stime;
//                     $TimesM->save();
//                 }
//                 $isTime = 0;
//             }
            //插入新场次
            $times = Yii::$app->request->post('time',[]);
            if($times && is_array($times)){
                foreach ($times as $k => $v){
                    $showTimesM = new CommonModel('show_times');
                    $showTimesM->show_id    = $_showId;
                    $showTimesM->stime      = strtotime($v);
                    $showTimesM->ctime      = time();
                    $showTimesM->save();
                }
                $isTime = 0;
                //更新开始、结束时间
                \common\models\CommonM::setTabelName('show_times');
                $stimes = \common\models\CommonM::find()->where(['show_id'=>$_showId])->orderBy('stime ASC')->one();
                $etimes = \common\models\CommonM::find()->where(['show_id'=>$_showId])->orderBy('stime DESC')->one();
                $showObj = Show::findOne($_showId);
                $showObj->stime = $stimes->stime;
                $showObj->etime = $etimes->stime;
                $showObj->save(false);
            }


            return $isTime;
        }

        /**
         * 删除节目
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月18日 上午11:11:49
        **/
        function actionDelShow($id){
            (new Show())->deleteShowById($id);

            $reArray = [
                'status'    => 200,
            ];
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return $reArray;
        }

        /**
         * 节目图片上传
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月13日 下午3:01:24
        **/
        function actionUploadeimg(){
            $fileInfo = (new \common\models\Uploade('showimg'))->uploadeImg();
            $reArray = [
                'path'      =>  ImageUrl.$fileInfo['path'],
                'imgPath'   =>  $fileInfo['path'],
                'status'    =>  200,
            ];

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $reArray;
//             return \yii\helpers\Json::encode($reArray);
        }

        /**
         * 重写
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月17日 下午2:32:27
        **/
        function beforeAction($action){
            if(in_array($action->id,['uploadeimg'])){
                $action->controller->enableCsrfValidation = false;
            }
            parent::beforeAction($action);

            return true;
        }
    }