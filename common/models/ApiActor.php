<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  演员API接口处理模型
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年2月6日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace common\models;
    use yii\db\ActiveRecord;
    use common\models\Actor;

    class ApiActor extends ActiveRecord{

        static function tableName(){
            return 'actor';
        }

        /**
         * 获取所有演员
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月20日 上午11:37:03
        **/
        function getAllActor(){
            $artorlist = Actor::find()->select('id actor,name,avatar')->asArray()->all();
            foreach ($artorlist as $k => $v){
                $artorlist[$k]['avatar'] = ImageUrl.$v['avatar'];
            }

            return $artorlist;
        }

        /**
         * 节目演员详情
         * @param  int $_showId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月6日 上午11:00:57
        **/
        function getShowActorList($_showId){
            $list = (new Actor())->getShowActorInfo($_showId);

            foreach ($list as $k => $v){
                $list[$k]['avatar'] = ImageUrl.$v['avatar'];
                $v['duty'] == 2 && $list[$k]['dutyName'] = $v['act'];
            }

            return $list;
        }

        /**
         * 获取演出演员基本信息
         * @param  int $_showId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月24日 下午5:35:31
        **/
        function getActorByShowId($_showId){
//             $sql = "SELECT a.`id`,a.`avatar`,a.`name` FROM `show_actor` sa LEFT JOIN `actor` a ON sa.actor_id = a.id WHERE sa.`show_id` = ".$_showId;
            $sql = "SELECT `actor_id` FROM `show_actor` WHERE show_id = ".$_showId;
            $actorIds = \Yii::$app->db->createCommand($sql)->queryColumn();
            $actorIds = $actorIds ? array_unique($actorIds) : [];
            $actorListInfo = self::find()->select('id actor_id,name,avatar')->where(['id'=>$actorIds])->asArray()->all();
            if($actorListInfo){
                foreach ($actorListInfo as $k => $v){
                    $actorListInfo[$k]['avatar'] = ImageUrl.$v['avatar'];
                }
            }else{
                return [];
            }

            return $actorListInfo;
        }

        /**
         * 获取演员详情
         * @param  int $_actorId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月6日 下午3:29:00
        **/
        function getActorInfoById($_actorId,$_memberId = 0){
            $info = (new Actor())->getActorInfoById($_actorId);

            $info['avatar'] = ImageUrl.$info['avatar'];
            $info['gender'] = $info['gender'] ? '男' : '女' ;
            $info['actor_id'] = $info['id'];
            $info['isPraise'] = 0;
            unset($info['ctime']);
            unset($info['id']);
            //是否点赞过
            if($_memberId > 0){
                $actorIds = \common\models\Praise::isPraiseByActorIds($_memberId,$info['actor_id']);
                $info['isPraise'] = in_array($info['actor_id'], $actorIds) ? 1 : 0;
            }

            return $info;
        }

        /**
         * 获取演员演的节目
         * @param  int $_actorId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月6日 上午11:40:52
        **/
        function getActorShowList($_actorId){
            $showlist = (new Actor())->getActorShowList($_actorId);

            foreach ($showlist as $k => $v){
                $showlist[$k]['cover'] = ImageUrl.$v['cover'];
                $showlist[$k]['show_id'] = $v['id'];
                unset($showlist[$k]['ctime']);
                unset($showlist[$k]['intro']);
                unset($showlist[$k]['duration']);
                unset($showlist[$k]['id']);
                unset($showlist[$k]['status']);
            }

            return $showlist;
        }
    }
