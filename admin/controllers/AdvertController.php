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
    use common\models\Advert;
    use Yii;

    class AdvertController extends SiteController{

        /**
         * 广告首页
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月26日 下午6:10:39
        **/
        function actionIndex(){
            $count = Advert::find()->count();
            $pageM = new \yii\data\Pagination([
                'totalCount'=>$count,
                'pageSize'=>20,
                'pageParam'=>'p',
            ]);
            $lists = Advert::find()->offset($pageM->offset)->limit(20)->orderBy('id DESC')->all();

            return $this->render('index',[
                'lists'  => $lists ? : [],
            ]);
        }

        /**
         * 广告编辑
         * @param  array
         * @param  string
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月26日 下午4:59:46
        **/
        function actionEdit(){
            $advertId = Yii::$app->request->get('advert_id',0);

            $advertInfo = [];
            if($advertId > 0){
                $advertInfo = Advert::findOne($advertId);
            }

            return $this->render('edit',[
                'advertInfo'    => $advertInfo,
            ]);
        }

        /**
         * 广告添加、更新
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月26日 下午5:31:41
        **/
        function actionUpdata(){
            $requestObj = Yii::$app->request;

            $advertId = $requestObj->post('advert_id');
            if($advertId > 0){
                $advertObj = Advert::findOne($advertId);
            }else{
                $advertObj = new Advert();

            }

            $advertObj->title   = $requestObj->post('title','');
            $advertObj->cover   = $requestObj->post('cover','');
            $advertObj->content = $requestObj->post('content','');
            $advertObj->status  = 1;
            $advertObj->ctime   = time();

            //写入数据操作
            $data = [];
            $data['status'] = 0;
            $data['msg'] = '添加修改失败！';
            if($advertObj->save(false) && $advertObj->id >0){
                $data['status'] = 200;
                $data['msg'] = '添加修改成功！';
                $data['url'] = \yii\helpers\Url::toRoute(['advert/index']);
            }
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return $data;
        }

        /**
         * 删除广告
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月26日 下午6:21:31
        **/
        function actionDeladvert($id){
            $advertObj = Advert::findOne($id);
            $advertObj->status = 0;
            $advertObj->save(false);

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
         * @date 2017年7月5日 下午6:29:25
         **/
        function actionUploadeimg(){
            $fileInfo = (new \common\models\Uploade('advert'))->uploadeImg();
            $reArray = [
                'path'      =>  ImageUrl.$fileInfo['path'],
                'imgPath'   =>  $fileInfo['path'],
                'status'    =>  200,
            ];

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $reArray;
        }

        /**
         *
         * @param  array
         * @param  string
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年8月3日 下午6:11:09
        **/
        function actionUpcropimg(){
            $request = \Yii::$app->request;
            require_once ROOT_PATH.'/common/library/CropImg.php';

            $conf = array(
                'rate'      => array( 'w'=>256,'h'=>120 ),
                'root_path' => ROOT_PATH.'/upload/advert/'
            );
            $crop = @new \CropImg($request->post('avatar_src',''), $request->post('avatar_data',''),$_FILES['avatar_file'],$conf);
            $path = str_replace('/'.ROOT_PATH.'/upload','',$crop->getResult());
            $response = array(
                'state'  => 200,
                'message' => $crop -> getMsg(),
                'result' => ImageUrl.$path,
                'uppath' => $path
            );

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $response;
        }

        /**
         * ajax上传操作
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月5日 下午6:29:55
         **/
        function beforeAction($action){
            if(in_array($action->id,['uploadeimg','updata','upcropimg'])){
                $action->controller->enableCsrfValidation = false;
            }
            parent::beforeAction($action);

            return true;
        }
    }
