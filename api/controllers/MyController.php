<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  我的相关
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年7月24日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.mawei.live
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace api\controllers;
    use api\controllers\CommonController;
    use \Yii;

    class MyController extends CommonController{

        /**
         * 返回回复我的评论
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月24日 上午9:48:51
         **/
        function actionGetreplyme(){
            if($this->mid < 1){
                $this->_reCode = 401;
                $this->_returnJson();
            }
            //记录总条数
            $sql = "SELECT COUNT(*) cnt FROM (( SELECT 1 type, show_id obj_id FROM show_comment WHERE reply_mid = ".$this->mid." ) UNION ( SELECT 2 type, dynamic_id obj_id FROM dynamic_comment WHERE reply_mid = ".$this->mid." ) UNION ( SELECT 3 type, actor_id obj_id FROM actor_comment WHERE reply_mid = ".$this->mid." )) temp ";
            $count = Yii::$app->db->createCommand($sql)->queryOne();
            $this->_count = $count['cnt'];
            //数据为空
            if($this->_count < 1){
                $this->_reCode = 204;
                $this->_returnJson();
            }
            //分页处理
            $page = page($this->_count,10);
            $sql = "SELECT * FROM (( SELECT 1 type, show_id obj_id, reply_mid, content, ctime FROM show_comment WHERE reply_mid = ".$this->mid." ) UNION ( SELECT 2 type, dynamic_id obj_id, reply_mid, content, ctime FROM dynamic_comment WHERE reply_mid = ".$this->mid." ) UNION ( SELECT 3 type, actor_id obj_id, reply_mid, content, ctime FROM actor_comment WHERE reply_mid = ".$this->mid." )) temp ORDER BY ctime DESC LIMIT ".$page['page'];
            $list = Yii::$app->db->createCommand($sql)->queryAll();
            //数据处理  type（1:演出评论 2：动态评论 3：演员评论）
            foreach ($list as $k => $v){
                switch ($v['type']){
                    case 1: //回复我的演出评论
                        //类型标题
                        $showInfo = \common\models\Show::find()->select('title')->where(['id'=>$v['obj_id']])->one();
                        $list[$k]['show_title'] = $showInfo->title;
                        break;
                    case 2: //回复我的动态评论
                        //类型标题
                        $dynamicInfo = \common\models\Dynamic::find()->select('title')->where(['id'=>$v['obj_id']])->one();
                        $list[$k]['dynamic_title'] = $dynamicInfo->title;
                        break;
                    case 3: //回复我的演员评论
                        //类型标题
                        $actorInfo = \common\models\Actor::find()->select('name,avatar')->where(['id'=>$v['obj_id']])->one();
                        $list[$k]['actor_avatar'] = ImageUrl.$actorInfo->avatar;
                        $list[$k]['actor_name'] = $actorInfo->name;
                        break;
                }
                //回复人信息
                $userInfo = \common\models\Member::find()->select('username,avatar')->where(['id'=>$v['reply_mid']])->one();
                $list[$k]['reply_name'] = $userInfo->username;
                $list[$k]['reply_avatar'] = $userInfo->avatar;
                //时间处理
                $list[$k]['ctime'] = friendlyDate($v['ctime']);
            }

            return $this->_returnJson($list);
        }
    }