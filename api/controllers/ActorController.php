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
            $actorId = Yii::$app->request->get('actor_id',0);
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

        /**
         * 获取评论列表
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月13日 下午2:35:56
         **/
        function actionGetcomment(){
            $request = Yii::$app->request;

            $actorId  = $request->get('actor_id',0);
            $page       = $request->get('p',1);
            $num        = $request->get('num',20);

            $list = [];
            //实例化动态评论
            $actorCommentObj = new \common\models\ActorComment();
            //条件
            $where = [];
            $where['actor_id']    = $actorId;
            $where['status']        = 1;
            //获取评论数
            $this->_count = $actorCommentObj->getActorCommentList($where);
            if($this->_count > 0 && $page = page($this->_count,$this->_num)){
                $list = $actorCommentObj->getActorCommentList($where,$page['offset']);
            }else{
                $this->_reCode = 204;
                return $this->_returnJson();
            }

            return $this->_returnJson($list);
        }

        /**
         * 演员评论
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月13日 下午2:31:10
        **/
        function actionUpcomment(){
            $request = Yii::$app->request;

            $commentObj = new \common\models\CommonModel('actor_comment');
            $commentObj->artor_id   = $request->post('show_id',0);
            $commentObj->member_id  = $this->mid;
            $commentObj->ctime      = time();
            $commentObj->content    = text($request->post('content',''));
            $commentObj->reply_id   = $request->post('reply_id',0);

            if($commentObj->save(false) && $commentObj->id > 0){
                return $this->_returnJson();
            }
            $this->_reCode = 400;
            $this->_reMsg = '评论失败';
            $this->_showMsg = '评论失败';
            return $this->_returnJson();
        }

    }