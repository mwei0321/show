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
         * 获取演员详情
         * @param  int $_actorId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月6日 下午3:29:00
        **/
        function getActorInfoById($_actorId){
            $info = (new Actor())->getActorInfoById($_actorId);

            $info['avatar'] = ImageUrl.$info['avatar'];
            $info['gender'] = $info['gender'] ? '男' : '女' ;
            $info['actor_id'] = $info['id'];
            unset($info['ctime']);
            unset($info['id']);

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
