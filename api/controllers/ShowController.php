<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  节目API控制器
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年1月19日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace api\controllers;
    use api\controllers\CommonController;
    use Yii;
    use common\models\Show;
    use common\models\Actor;

    class ShowController extends CommonController{

        /**
         * 获取节目列表
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月19日 上午10:52:22
        **/
        function getShowList(){
            $where = [];

            //返回节目列表
            $showM = new Show();
            $this->_count = $showM->getShowList($where);
            if($this->_count < 1){
                $this->_reCode = 204;
                return $this->_returnJson();
            }

            $pages = page($this->_count,20);
            $lists = $showM->getShowList($where,$pages['offset']);

            return $this->_returnJson($lists);
        }


        /**
         * 获取节目详情
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月19日 上午10:52:08
        **/
        function getShowInfo(){
            $id = Yii::$app->request->post('id',0);

            $info = [];
            if($id > 0){
                //节目详情
                $info = (new Show())->getShowInfoById($id);
                //节目演员详情
                $actorLists = (new Actor())->getShowActorInfo($id);
                $info['actors'] = $actorLists;
            }else{
                $this->_reCode = 440;
                $this->_reMsg = 'id errors->'.$id;
            }

            return $this->_returnJson($info);
        }
    }