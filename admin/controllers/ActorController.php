<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  演员
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年2月16日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace admin\controllers;
    use Yii;
    use yii\web\Controller;
    use common\models\Actor;

    class ActorController extends Controller{

        /**
         * 演员列表
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月16日 下午3:51:31
        **/
        function actionIndex(){

            $ActorM = new Actor();
            $ActorM->_pageSize = 5;
            $where = [];

            $count = $ActorM->getActorList($where);
            $pageM = new \yii\data\Pagination([
                'totalCount'=>$count,
                'pageSize'=>$ActorM->_pageSize,
                'pageParam'=>'p',
            ]);
            $lists = $ActorM->getActorList($where,(string)$pageM->offset);

            return $this->render('index',[
                'actorList' => $lists,
                'pages' => $pageM,
            ]);
        }

        /**
         * 编辑
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月16日 下午4:07:55
        **/
        function actionEdit(){
            $actorId = Yii::$app->request->get('actor_id',0);

            $ActorInfo = [];
            if($actorId > 0){
                $ActorInfo = (new Actor())->getActorInfoById($actorId);
            }

            return $this->render('edit',[
                'ActorInfo'   => $ActorInfo,
            ]);
        }

        /**
         * 节目图片上传
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月13日 下午3:01:24
         **/
        function actionUploadeimg(){
            $fileInfo = (new \common\models\Uploade('actor'))->uploadeImg();
            $reArray = [
                'path'      =>  ImageUrl.$fileInfo['path'],
                'imgPath'   =>  $fileInfo['path'],
                'status'    =>  200,
            ];

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
            if(in_array($action->id,['uploadeimg','delactor'])){
                $action->controller->enableCsrfValidation = false;
            }
            parent::beforeAction($action);

            return true;
        }
    }
