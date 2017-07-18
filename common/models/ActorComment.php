<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  演员评论
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年7月5日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.mawei.live
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace common\models;
    use yii\db\ActiveRecord;

    class ActorComment extends ActiveRecord{

        static function tableName(){
            return 'actor_comment';
        }

        /**
         * 获取动态评论列表
         * @param  array
         * @param  string
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月13日 下午2:48:16
        **/
        function getActorCommentList($_where = 1,$_offset = 'count',$_pageSize = 10){
            $actorCommentObj = self::find()->where($_where);
            if($_offset == 'count'){
                return $actorCommentObj->count();
            }

            $actorCommentList = $actorCommentObj->offset($_offset)->limit($_pageSize)->orderBy('id DESC')->asArray()->all();
            if($actorCommentList){
                //查询评论列表是否有回复
                $replyIds = arr2to1($actorCommentList,'reply_id');
                $replyList = [];
                if($replyIds){
                    $replyList = self::find()->where(['id'=>$replyIds])->asArray()->all();
                    $replyList = fieldtokey($replyList);
                }
                //获取用户信息
                $memberIds = arr2to1($actorCommentList,'member_id');
                $memberInfos = Member::find()->select('id,username,avatar')->where(['id'=>$memberIds])->asArray()->all();
                $memberInfos = fieldtokey($memberInfos);
                foreach ($actorCommentList as $k => $v){
                    $actorCommentList[$k]['member_name'] = $memberInfos[$v['member_id']]['username'];
                    $actorCommentList[$k]['member_avatar'] = $memberInfos[$v['member_id']]['avatar'];
                    $actorCommentList[$k]['ctime'] = date('Y-m-d',$v['ctime']);
                    $actorCommentList[$k]['comment_id'] = $v['id'];
                    if($v['reply_id'] > 0){
                        $replyName = Member::findOne($replyList[$v['reply_id']]['member_id']);
                        $actorCommentList[$k]['reply_member_id']  = $replyName->id;
                        $actorCommentList[$k]['reply_content']    = $replyList[$v['reply_id']]['content'];
                        $actorCommentList[$k]['reply_member_name']= $replyName->username;
                    }else{
                        $actorCommentList[$k]['reply_member_id']  = '';
                        $actorCommentList[$k]['reply_content']    = '';
                        $actorCommentList[$k]['reply_member_name']= '';
                    }
                    unset($actorCommentList[$k]['id']);
                    unset($actorCommentList[$k]['status']);
                }
                return $actorCommentList;
            }

            return [];
        }
    }