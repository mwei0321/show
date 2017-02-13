<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  演员操作控制器
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年2月6日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace api\controllers;
    use Yii;
    use api\controllers\CommonController;
    use common\models\ApiActor;

    class ActorController extends CommonController{

        /**
         * 获取演员详情
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月6日 下午3:30:22
        **/
        function actionGetactorinfo(){
            //获取ID
            $actorId = Yii::$app->request->get('actorid',0);
            //演员详情
            $info = (new ApiActor())->getActorInfoById($actorId);
            //演员演出过的节目
            $showlist = (new ApiActor())->getActorShowList($actorId);
            $info['actor_show'] = $showlist;

            return $this->_returnJson($info);
        }

        /**
         * 获取演员演过的节目列表
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月6日 下午3:31:34
        **/
        function actionGetactorshow(){
            //获取ID
            $actorId = Yii::$app->request->get('actor_id',0);
            $showlist = [];
            if($actorId > 0){
                $showlist = (new ApiActor())->getActorShowList($actorId);
            }else{
                $this->_reCode = 440;
                $this->_reMsg = 'actorId errors -> '.$actorId;
            }

            return $this->_returnJson($showlist);
        }
    }