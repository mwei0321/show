<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  bananr
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年7月5日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.mawei.live
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace admin\controllers;
    use Yii;
    use common\models\Banner;

    class BannerController extends SiteController{

        /**
         * banner列表
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月5日 下午6:35:02
        **/
        function actionIndex(){
            $list = Banner::find()->where(['status'=>1])->asArray()->all();

            return $this->render('index',[
                'lists'=>$list
            ]);
        }

        /**
         * 广告编辑页
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月5日 下午6:10:55
        **/
        function actionEdit(){
            $bannerId = Yii::$app->request->get('banner_id',0);

            $bannerInfo = [];
            if($bannerId > 0){
                $bannerInfo = Banner::findOne($bannerId);
            }

            return $this->render('edit',[
                'bannerInfo'    => $bannerInfo,
            ]);
        }

        /**
         * 广告栏更新、写入
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月5日 下午6:19:28
        **/
        function actionUpdata(){
            $requestObj = Yii::$app->request;

            $bannerId = $requestObj->post('banner_id');
            if($bannerId > 0){
                $bannerObj = Banner::findOne($bannerId);
            }else{
                $bannerObj = new Banner();
                $bannerObj->ctime = time();
            }

            $bannerObj->title   = $requestObj->post('title','');
            $bannerObj->imgUrl  = $requestObj->post('imgUrl','');
            $bannerObj->imgLink = $requestObj->post('link','');
            $bannerObj->status  = 1;

            //写入数据操作
            $data = [];
            $data['status'] = 0;
            $data['msg'] = '添加修改失败！';
            if($bannerObj->save(false) && $bannerObj->id >0){
                $data['status'] = 200;
                $data['msg'] = '添加修改成功！';
                $data['url'] = \yii\helpers\Url::toRoute(['banner/index']);
            }
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return $data;
        }

        /**
         * 节目图片上传
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月5日 下午6:29:25
        **/
        function actionUploadeimg(){
            $fileInfo = (new \common\models\Uploade('banner'))->uploadeImg();
            $reArray = [
                'path'      =>  ImageUrl.$fileInfo['path'],
                'imgPath'   =>  $fileInfo['path'],
                'status'    =>  200,
            ];

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $reArray;
        }

        /**
         * 删除banner
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月5日 下午6:29:02
        **/
        function actionDelbanner(){
            $dyid = Yii::$app->request->get('dyid',0);

            $data = [];
            $data['status'] = 0;
            $data['msg'] = '删除失败！请刷新后重试！';
            $data['url'] = \yii\helpers\Url::toRoute(['dynamic/index']);
            if((new Banner())->findOne(['id'=>$dyid])->delete()){
                $data['status'] = 200;
                $data['msg'] = '删除成功！';
            }

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return $data;
        }

        function actionUpstartlogo(){

        }

        /**
         * ajax上传操作
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月5日 下午6:29:55
        **/
        function beforeAction($action){
            if(in_array($action->id,['uploadeimg','delbanner'])){
                $action->controller->enableCsrfValidation = false;
            }
            parent::beforeAction($action);

            return true;
        }
    }