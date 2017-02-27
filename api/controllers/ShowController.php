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
    use common\models\ApiShow;
    use common\models\ApiActor;
    use common\models\ApiDynamic;

    class ShowController extends CommonController{

        /**
         * 获取节目列表
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月19日 上午10:52:22
        **/
        function actionGetshowlist(){
            $where = [];
            $where['status'] = 1;

            //返回节目列表
            $showM = new ApiShow();

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
        function actionGetshowinfo(){
            $id = Yii::$app->request->get('show_id',0);

            $info = [];
            if($id > 0){
                //节目详情
                $info = (new ApiShow())->getShowInfoById($id);
                //节目演员详情
                $actorLists = (new ApiActor())->getShowActorList($id);
                $info['actors'] = $actorLists;
                //动态
                $dynamic = (new ApiDynamic())->getDynamicByTop();
                $info['dynamic'] = $dynamic;
            }else{
                $this->_reCode = 440;
                $this->_reMsg = 'id errors->'.$id;
            }

            return $this->_returnJson($info);
        }

        /**
         * 搜索
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月17日 上午9:35:50
        **/
        function actionSearch(){
            $keyword = Yii::$app->request->get('keyword','');

            $data = [];
            if($keyword){
                $searchM = new \common\models\Search();
                //节目演出
                $data['show'] = $searchM->searchShow($keyword);
                //演员
                $data['actor'] = $searchM->searchActor($keyword);
                //动态
                $data['dynamic'] = $searchM->searchDynamic($keyword);
            }else{
                $this->_reCode = 440;
                $this->_reMsg = 'param errors-> keyword null';
            }

            return $this->_returnJson($data);
        }
    }