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

    class DynamicComment extends ActiveRecord{

        static function tableName(){
            return 'dynamic_comment';
        }

        /**
         * 获取动态评论列表
         * @param  array
         * @param  string
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月13日 下午2:48:16
        **/
        function getDynamicCommentList($_where = 1,$_offset = 'count',$_pageSize = 10){
            $DynamicCommentObj = self::find()->where($_where);
            if($_offset == 'count'){
                return $DynamicCommentObj->count();
            }

            $dynamicCommentList = $DynamicCommentObj->offset($_offset)->limit($_pageSize)->orderBy('id DESC')->asArray()->all();
            if($dynamicCommentList){
                //查询评论列表是否有回复
                $replyIds = arr2to1($dynamicCommentList,'reply_id');
                $replyList = [];
                if($replyIds){
                    $replyList = self::find()->where(['id'=>$replyIds])->asArray()->all();
                    $replyList = fieldtokey($replyList);
                }
                //获取用户信息
                $memberIds = arr2to1($dynamicCommentList,'member_id');
                $memberInfos = Member::find()->select('id,username,avatar')->where(['id'=>$memberIds])->asArray()->all();
                $memberInfos = fieldtokey($memberInfos);
                foreach ($dynamicCommentList as $k => $v){
                    $dynamicCommentList[$k]['member_name'] = $memberInfos[$v['member_id']]['username'];
                    $dynamicCommentList[$k]['member_avatar'] = $memberInfos[$v['member_id']]['avatar'];
                    $dynamicCommentList[$k]['ctime'] = date('Y-m-d',$v['ctime']);
                    $dynamicCommentList[$k]['comment_id'] = $v['id'];
                    if($v['reply_id'] > 0){
                        $replyName = Member::findOne($replyList[$v['reply_id']]['member_id']);
                        $dynamicCommentList[$k]['reply_member_id']  = $replyName->id;
                        $dynamicCommentList[$k]['reply_content']    = $replyList[$v['reply_id']]['content'];
                        $dynamicCommentList[$k]['reply_member_name']= $replyName->username;
                    }else{
                        $dynamicCommentList[$k]['reply_member_id']  = '';
                        $dynamicCommentList[$k]['reply_content']    = '';
                        $dynamicCommentList[$k]['reply_member_name']= '';
                    }
                    unset($dynamicCommentList[$k]['id']);
                    unset($dynamicCommentList[$k]['status']);
                }
                return $dynamicCommentList;
            }

            return [];
        }
    }