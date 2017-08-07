<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  动态接口控制器
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年2月6日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace api\controllers;
    use api\controllers\CommonController;
    use Yii;
    use common\models\ApiDynamic;

    class DynamicController extends CommonController{

        /**
         * 获取动态列表
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月6日 下午3:34:31
        **/
        function actionGetdynamiclist(){
            $where = [];
            $where['status'] = 1;

            //返回节目列表
            $dynamicM = new ApiDynamic();
            $this->_count = $dynamicM->getDynamicList($where);
            if($this->_count < 1){
                $this->_reCode = 204;
                return $this->_returnJson();
            }
            $pages = page($this->_count,20);
            $lists = $dynamicM->getDynamicList($where,$pages['offset'],$this->mid);

            return $this->_returnJson($lists);
        }

        /**
         * 获取动态详情
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月6日 下午3:05:28
        **/
        function actionGetdynamicinfo(){
            $dynamicId = Yii::$app->request->get('dyid',0);

            $info = [];
            if($dynamicId > 0){
                $info = (new ApiDynamic())->getDynamicInfoById($dynamicId,$this->mid);
            }else{
                $this->_reCode = 440;
                $this->_reMsg = 'id errors->'.$dynamicId;
            }

            //评论
            $comment = (new \common\models\DynamicComment())->getDynamicCommentList(['dynamic_id'=>$dynamicId],'0',3);
            $info['comment'] = $comment ? : [];
            $info['commentNum'] = \common\models\DynamicComment::find()->where(['dynamic_id'=>$dynamicId,'status'=>1])->count();

            //增加阅读数
            (new ApiDynamic())->IncDynamicReadNum($dynamicId);

            return $this->_returnJson($info);
        }

        /**
         * 获取评论列表
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月13日 下午2:35:56
         **/
        function actionGetcomment(){
            $request = Yii::$app->request;

            $dynamicId  = $request->get('dyid',0);
            $page       = $request->get('p',1);
            $num        = $request->get('num',20);

            $list = [];
            //实例化动态评论
            $dynamicCommentObj = new \common\models\DynamicComment();
            //条件
            $where = [];
            $where['dynamic_id']    = $dynamicId;
            $where['status']        = 1;
            //获取评论数
            $this->_count = $dynamicCommentObj->getDynamicCommentList($where);
            $page = page($this->_count,$this->_num);
            if($this->_count > 0 && $page){
                $list = $dynamicCommentObj->getDynamicCommentList($where,$page['offset'],$this->_num);
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

            $commentObj = new \common\models\DynamicComment();
            $commentObj->dynamic_id = $request->post('dyid',0);
            $commentObj->member_id  = $this->mid;
            $commentObj->ctime      = time();
            $commentObj->content    = text($request->post('content',''));
            $commentObj->reply_id   = $request->post('reply_id',0);
            if($commentObj->reply_id > 0){
                $replyMid = \common\models\DynamicComment::findOne($commentObj->reply_id);
                $commentObj->reply_mid  = $replyMid->member_id;
            }

            if($commentObj->save(false) && $commentObj->id > 0){
                //评论数统计
                $count = \common\models\DynamicComment::find()->where(['dynamic_id'=>$commentObj->dynamic_id])->count();
                $dynamicObj = ApiDynamic::findOne($commentObj->dynamic_id);
                $dynamicObj->comment_num = $count;
                $dynamicObj->save(false);

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
            $dynamicId = Yii::$app->request->get('comment_id',0);
            if($dynamicId > 0){
                $dynamicObj = \common\models\DynamicComment::findOne($dynamicId);
                $dynamicObj->status = 0;
                $dynamicObj->save(false);
                return $this->_returnJson();
            }
            $this->_reCode = 400;
            $this->_reMsg = '评论删除失败';
            $this->_showMsg = '评论删除失败';
            return $this->_returnJson();
        }
    }