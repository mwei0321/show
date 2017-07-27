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
         * banner首页
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月5日 下午6:35:02
        **/
        function actionIndex(){
            //启动图片logo
            \common\models\CommonM::setTabelName('start_logo');
            $startlogo = \common\models\CommonM::find()->select('path')->where(['id'=>1])->one();

            //banner显示列表
            $list = Banner::find()->where(['status'=>1])->orderBy('sort DESC')->all();


            return $this->render('index',[
                'lists'=>$list,
                'startlogo' => $startlogo,
            ]);
        }

        /**
         * banner列表
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月20日 上午11:01:05
        **/
        function actionAdvlist(){

            return $this->render('advlist',[

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
         * 排序
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月24日 上午11:44:57
        **/
        function actionSort(){
            $sort = Yii::$app->request->get('sort','');

            $status = 400;
            if($sort){
                $sortnum = 100;
                $sort = explode(',', $sort);
                array_shift($sort);
                Banner::updateAll(['sort'=>0]);
                foreach ($sort as $v){
                    $bannerObj = Banner::findOne($v);
                    $bannerObj->sort = $sortnum--;
                    $bannerObj->save(false);
                }
                $status = 200;
            }

            $reArray = [
                'status'    =>  $status,
            ];

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $reArray;
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

        /**
         * 上传启动logo
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月19日 下午3:51:51
        **/
        function actionUpstartlogo(){
            $fileInfo = (new \common\models\Uploade('startlogo',['isDate'=>false]))->uploadeImg('startlogo');
            //修改启动logo
            \common\models\CommonM::setTabelName('start_logo');
            if($fileInfo['size'] > 0){
                $startlogoObj = \common\models\CommonM::findOne(1);
                if(!$startlogoObj){
                    $startlogoObj = new \common\models\CommonM();
                }
                $startlogoObj->path    = $fileInfo['path'];
                $startlogoObj->ctime   = time();
                $startlogoObj->save(false);
            }

            $reArray = [
                'path'      =>  ImageUrl.$fileInfo['path'],
                'imgPath'   =>  $fileInfo['path'],
                'status'    =>  200,
            ];

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $reArray;
        }

        /**
         * ajax上传操作
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月5日 下午6:29:55
        **/
        function beforeAction($action){
            if(in_array($action->id,['uploadeimg','delbanner','upstartlogo','sort'])){
                $action->controller->enableCsrfValidation = false;
            }
            parent::beforeAction($action);

            return true;
        }
    }