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
    use yii\base\Controller;
    use admin\models\Show;
    use common\models\Actor;
    use yii\web\UploadedFile;

    class ShowController extends Controller{
//         public $layout = 'template';


        /**
         * 话剧演出节日列表
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月11日 下午6:21:43
        **/
        function actionIndex(){


            return $this->render('index');
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
            //职务列表
            $dutys = $actorObj->getActorDutyLists();

            return $this->render('edit',[
                'showInfo'  => $showInfo,
                'actors'    => $actors,
                'dutys'     => $dutys,
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

            $data = [];
            $data['cover']      =   $request->post('cover','');
            $data['title']      =   $request->post('title','');
            $data['cover']      =   $request->post('cover','');
            $data['stime']      =   $request->post('cover','');
            $data['intro']      =   $request->post('cover','');
            $data['duration']   =   $request->post('cover','');
            $data['intro']      =   $request->post('cover','');

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
            echo json_encode($reArray);
        }
    }