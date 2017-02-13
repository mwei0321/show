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

    class ShowController extends Controller{
//         public $layout = 'template';
//         public $enableCsrfValidation = false;


        /**
         * 话剧演出节日列表
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月11日 下午6:21:43
        **/
        function actionIndex(){
            $showModel = new Show();
            $showModel->_pageSize = 5;
            $where = [];

            $count = $showModel->getShowList($where);
            $pageM = new \yii\data\Pagination([
                'totalCount'=>$count,
                'pageSize'=>$showModel->_pageSize,
                'pageParam'=>'p',
            ]);
            $lists = $showModel->getShowList($where,(string)$pageM->offset);

			/**Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $lists;**/
			
            return $this->render('index',[
                'lists' => $lists,
                'pages' => $pageM,
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
            if($id > 0){
                //获取节目详情
                $showModel = new Show();
                $showInfo = $showModel->getShowInfoById($id);
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
            ]);
        }


        /**
         * 数据更新
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月13日 上午10:25:16
        **/
        function actionUpdata(){
            $this->_showTimes(1);
var_dump($_REQUEST);exit;
            $request = Yii::$app->request;
            //时间
            $time = explode(' - ', $request->post('time'));
            //节目信息
            if($request->post('id','') > 0)
                $showModel = Show::findOne($request->post('id',''));
            else
                $showModel = new Show();

            $showModel->title   =   $request->post('title','');
            $showModel->cover   =   $request->post('cover','');
            $showModel->intro   =   $request->post('intro','');
            $showModel->duration=   $request->post('duration','');
//             $showModel->stime   =   strtotime($time[0]);
//             $showModel->etime   =   strtotime($time[1]);
            $showModel->ctime   =   time();
//             var_dump($_POST);
//             var_dump($showModel);exit;
            if($showModel->save(false) && $showModel->id > 0){
                //删除演员
                (new CommonModel('show_actor'))->deleteAll(['show_id'=>$showModel->id]);
                //写入演员信息
                $actor = $request->post('actor');
                $duty  = $request->post('duty');
                foreach ($actor as $k => $v){
                    $actorModel = new CommonModel('show_actor');
                    $actorModel->show_id     = $showModel->id;
                    $actorModel->actor_id    = $v;
                    $actorModel->duty        = $duty[$k];
                    $actorModel->act         = '';
                    $actorModel->ctime       = time();
                    $actorModel->save(false);
//                     echo $actorModel->id;
                }
//                 return $this->redirect('http://q.com/index.php?r=show');
                return $this->redirect(['show/index']);
            }else{

            }
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
            var_dump($times);exit;
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