<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  动态列表
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年2月13日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace admin\controllers;
    use Yii;
    use yii\web\Controller;
    use common\models\Dynamic;
use yii\helpers\Url;

    class DynamicController extends Controller{

        /**
         * 动态列表显示
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月13日 下午6:34:18
        **/
        function actionIndex(){
            $dynamicM = new Dynamic();
            $dynamicM->_pageSize = 5;
            $where = [];

            $count = $dynamicM->getDynamicList($where);
            $pageM = new \yii\data\Pagination([
                'totalCount'=>$count,
                'pageSize'=>$dynamicM->_pageSize,
                'pageParam'=>'p',
            ]);
            $lists = $dynamicM->getDynamicList($where,(string)$pageM->offset);

            return $this->render('index',[
                'lists' => $lists,
                'pages' => $pageM,
            ]);
        }

        /**
         * 动态编辑
         * @param  array
         * @param  string
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月13日 下午6:38:24
        **/
        function actionEdit(){
            $dyid = Yii::$app->request->get('dyid',0);

            $dynamicInfo = [];
            if($dyid > 0){
                $dynamicInfo = (new Dynamic())->getDynamicInfoById($dyid);
            }

            return $this->render('edit',[
                'dynamicInfo'   => $dynamicInfo,
            ]);
        }

        /**
         * 添加、修改数据到数据库
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月14日 下午2:02:00
        **/
        function actionUpdate(){
            $request = Yii::$app->request;

            //判断是否是更新数据
            $dyId = $request->post('dyid',0);
            if($dyId > 0){
                $dynamicM = Dynamic::findOne($dyId);
                $dynamicM->utime = time();
            }else{
                $dynamicM = new Dynamic();
                $dynamicM->ctime = time();
            }

            $dynamicM->title    =   $request->post('title','');
            $dynamicM->cover    =   $request->post('cover','');
            $dynamicM->content  =   $request->post('content','');
            $dynamicM->status   =   1;

            //写入数据操作
            $data = [];
            $data['status'] = 0;
            $data['msg'] = '添加修改失败！';
            if($dynamicM->save(false) && $dynamicM->id >0){
                $data['status'] = 200;
                $data['msg'] = '添加修改成功！';
                $data['url'] = Url::toRoute(['dynamic/index']);
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
            $fileInfo = (new \common\models\Uploade('dynamic'))->uploadeImg();
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
            if(in_array($action->id,['uploadeimg'])){
                $action->controller->enableCsrfValidation = false;
            }
            parent::beforeAction($action);

            return true;
        }
    }