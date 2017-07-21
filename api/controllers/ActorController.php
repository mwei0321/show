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

        function actionIndex(){
            $ActorObj = new ApiActor();
            //即将演出
            $recentlyShow = \common\models\Show::find()->select('id,title')->where(['status'=>2])->orderBy('ctime DESC')->asArray()->one();
            $recentlyShowActorList = $ActorObj->getShowActorList($recentlyShow['id']);
            $recentlyShow['artor'] = $recentlyShowActorList ? : [];
            //最近演出
            $sql = "SELECT s.`id`,s.`title` FROM `show` s LEFT JOIN `show_times` st ON `s`.`id` = `st`.`show_id` WHERE st.`stime` > ".time()." AND s.`status` = 1 ORDER BY st.`stime` ASC LIMIT 1";
            $nowShow = Yii::$app->db->createCommand($sql)->queryColumn();
            //最新加入演员
            $actorList = ApiActor::find()->orderBy('ctime DESC')->limit(4)->asArray()->all();


            $this->_returnJson();
        }

        /**
         * 所有演员列表
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月20日 上午11:23:08
        **/
        function actionGetallactor(){
            $allActorList = (new ApiActor())->getAllActor();

            $this->_returnJson($allActorList);
        }

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
            $info = (new ApiActor())->getActorInfoById($actorId,$this->mid);
            //演员演出过的节目
            $showlist = (new ApiActor())->getActorShowList($actorId);
            $info['actor_show'] = $showlist;
            //演员相册
            \common\models\CommonM::setTabelName('actor_photo');
            $actorPhotos = \common\models\CommonM::find()->select('id `photo_id`,`path`,`size`')->where(['artor_id'=>$actorId,'status'=>1])->orderBy('ctime DESC')->asArray()->all();
            if($actorPhotos){
                foreach ($actorPhotos as $k => $v){
                    $actorPhotos[$k]['path'] = ImageUrl.$v['path'];
                }
                $info['actorPhotos'] = $actorPhotos;
            }else
                $info['artorPhotos'] = [];
            //评论
            $comment = (new \common\models\ActorComment())->getActorCommentList(1,3);
            $info['comment'] = $comment ? : [];

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

            $commentObj = new \common\models\ActorComment();
            $commentObj->actor_id   = $request->post('actor_id',0);
            $commentObj->member_id  = $this->mid;
            $commentObj->ctime      = time();
            $commentObj->content    = text($request->post('content',''));
            $commentObj->reply_id   = $request->post('reply_id',0);
            if($commentObj->reply_id > 0){
                $replyMid = \common\models\ActorComment::findOne($commentObj->reply_id);
                $commentObj->reply_mid  = $replyMid->member_id;
            }

            if($commentObj->save(false) && $commentObj->id > 0){
                return $this->_returnJson();
            }
            $this->_reCode = 400;
            $this->_reMsg = '评论失败';
            $this->_showMsg = '评论失败';
            return $this->_returnJson();
        }

    }