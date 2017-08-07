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
            $type = Yii::$app->request->get('type',1);

            $where = [];
            $where['status'] = $type;

            //返回节目列表
            $showM = new ApiShow();

            $this->_count = $showM->getShowList($where);
            if($this->_count < 1){
                $this->_reCode = 204;
                return $this->_returnJson();
            }
            $pages = page($this->_count,10);
            $lists = [];
            if($pages){
                $lists = $showM->getShowList($where,$pages['offset'],$this->mid);
            }

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
                $info = (new ApiShow())->getShowInfoById($id,$this->mid);
                //节目演员详情
                $actorLists = (new ApiActor())->getShowActorList($id);
                $info['actors'] = $actorLists;
                //动态
                $dynamic = (new ApiDynamic())->getDynamicByTop();
                $info['dynamic'] = $dynamic;
                //评论
                $comment = (new \common\models\ShowComment())->getShowCommentList(['show_id'=>$id],'0',3);
                $info['comment'] = $comment ? : [];
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

        /**
         * 获取评论列表
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月13日 下午2:35:56
         **/
        function actionGetcomment(){
            $request = Yii::$app->request;

            $showId  = $request->get('show_id',0);
            $page       = $request->get('p',1);
            $num        = $request->get('num',20);

            $list = [];
            //实例化动态评论
            $showCommentObj = new \common\models\ShowComment();
            //条件
            $where = [];
            $where['show_id']    = $showId;
            $where['status']        = 1;
            //获取评论数
            $this->_count = $showCommentObj->getShowCommentList($where);
            if($this->_count > 0 && $page = page($this->_count,$this->_num)){
                $list = $showCommentObj->getShowCommentList($where,$page['offset'],$this->_num);
            }else{
                $this->_reCode = 204;
                return $this->_returnJson();
            }

            return $this->_returnJson($list);
        }

        /**
         * 发布评论
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月5日 上午10:07:59
         **/
        function actionUpcomment(){
            $request = Yii::$app->request;

            $commentObj = new \common\models\ShowComment();
            $commentObj->show_id    = $request->post('show_id',0);
            $commentObj->member_id  = $this->mid;
            $commentObj->ctime      = time();
            $commentObj->content    = $_REQUEST['content'];
            $commentObj->reply_id   = $request->post('reply_id',0);
            if($commentObj->reply_id > 0){
                $replyMid = \common\models\ShowComment::findOne($commentObj->reply_id);
                $commentObj->reply_mid  = $replyMid->member_id;
            }

            if($commentObj->save(false) && $commentObj->id > 0){
                //评论数统计
                $count = \common\models\ShowComment::find()->where(['show_id'=>$commentObj->show_id])->count();
                $showObj = ApiShow::findOne($commentObj->show_id);
                $showObj->comment_num = $count;
                $showObj->save(false);

                return $this->_returnJson();
            }

            $this->_reCode = 400;
            $this->_reMsg = '评论失败';
            $this->_showMsg = '评论失败';
            return $this->_returnJson();
        }

        /**
         * 删除评论
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月5日 上午10:19:41
         **/
        function actionDelcomment(){
            $showId = Yii::$app->request->get('comment_id',0);
            if($showId > 0){
                $showObj = \common\models\ShowComment::findOne($showId);
                $showObj->status = 0;
                $showObj->save(false);
                return $this->_returnJson();
            }
            $this->_reCode = 400;
            $this->_reMsg = '评论删除失败';
            $this->_showMsg = '评论删除失败';
            return $this->_returnJson();
        }
    }