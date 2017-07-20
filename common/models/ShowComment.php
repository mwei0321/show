<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  演出评论
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

    class ShowComment extends ActiveRecord{

        static function tableName(){
            return 'show_comment';
        }

        /**
         * 获取动态评论列表
         * @param  array
         * @param  string
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月13日 下午2:48:16
         **/
        function getShowCommentList($_where = 1,$_offset = 'count',$_pageSize = 10){
            $ShowCommentObj = self::find()->where($_where);
            if($_offset == 'count'){
                return $ShowCommentObj->count();
            }

            $ShowCommentList = $ShowCommentObj->offset($_offset)->limit($_pageSize)->orderBy('id DESC')->asArray()->all();
            if($ShowCommentList){
                //查询评论列表是否有回复
                $replyIds = arr2to1($ShowCommentList,'reply_id');
                $replyList = [];
                if($replyIds){
                    $replyList = self::find()->where(['id'=>$replyIds])->asArray()->all();
                    $replyList = fieldtokey($replyList);
                }
                //获取用户信息
                $memberIds = arr2to1($ShowCommentList,'member_id');
                $memberInfos = Member::find()->select('id,username,avatar')->where(['id'=>$memberIds])->asArray()->all();
                $memberInfos = fieldtokey($memberInfos);
                //优化处理
                foreach ($ShowCommentList as $k => $v){
                    $ShowCommentList[$k]['member_name'] = isset($memberInfos[$v['member_id']]['username']) ? $memberInfos[$v['member_id']]['username'] : '';
                    $ShowCommentList[$k]['member_avatar'] = isset($memberInfos[$v['member_id']]['avatar']) ? $memberInfos[$v['member_id']]['avatar'] : '';
                    $ShowCommentList[$k]['ctime'] = date('Y-m-d',$v['ctime']);
                    $ShowCommentList[$k]['comment_id'] = $v['id'];
                    if($v['reply_id'] > 0){
                        $replyName = Member::findOne($replyList[$v['reply_id']]['member_id']);
                        $ShowCommentList[$k]['reply_member_id']  = $replyName->id;
                        $ShowCommentList[$k]['reply_content']    = $replyList[$v['reply_id']]['content'];
                        $ShowCommentList[$k]['reply_member_name']= $replyName->username;
                    }else{
                        $ShowCommentList[$k]['reply_member_id']  = '';
                        $ShowCommentList[$k]['reply_content']    = '';
                        $ShowCommentList[$k]['reply_member_name']= '';
                    }
                    unset($ShowCommentList[$k]['id']);
                    unset($ShowCommentList[$k]['status']);
                }
                return $ShowCommentList;
            }

            return [];
        }
    }