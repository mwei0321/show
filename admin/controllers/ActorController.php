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
         * 演员详情查看
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月17日 上午11:21:39
        **/
        function actionInfo(){
            $actorId = Yii::$app->request->get('actor_id',0);

            $ActorInfo = (new Actor())->getActorInfoById($actorId);

            return $this->render('info',[
                'ActorInfo'   => $ActorInfo,
            ]);
        }

        /**
         * 数据添加，修改
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月17日 下午2:20:34
        **/
        function actionUpdate(){
            $request = Yii::$app->request;

            //判断是否是更新数据
            $actorId = $request->post('actor_id',0);
            if($actorId > 0){
                $actorM = Actor::findOne($actorId);
            }else{
                $actorM = new Actor();
                $actorM->ctime = time();
            }

            $actorM->name             =   $request->post('name','');
            $actorM->avatar           =   $request->post('avatar','');
            $actorM->gender           =   $request->post('gender',1);
            $actorM->constellation    =   $request->post('constellation','');
            $actorM->birthday         =   $request->post('birthday','');
            $actorM->address          =   $request->post('address','');
            $actorM->intro            =   $request->post('intro','');

            //写入数据操作
            $data = [];
            $data['status'] = 0;
            $data['msg'] = '添加修改失败！';
            if($actorM->save(false) && $actorM->id >0){
                $data['status'] = 200;
                $data['msg'] = '添加修改成功！';
                $data['url'] = \yii\helpers\Url::toRoute(['actor/index']);
            }
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return $data;
        }

        /**
         * 删除
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月17日 上午11:46:38
        **/
        function actionDelactor(){
            $actorId = Yii::$app->request->get('actor_id',0);

            $data = [];
            $data['status'] = 0;
            $data['msg'] = '删除失败！请刷新后重试！';
            $data['url'] = \yii\helpers\Url::toRoute(['actor/index']);
            if((new Actor())->findOne(['id'=>$actorId])->delete()){
                $data['status'] = 200;
                $data['msg'] = '删除成功！';
            }

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return $data;
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
