<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  节目API接口处理模型
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
    use common\models\Show;

    class ApiShow extends ActiveRecord{

        /**
         * 节目列表
         * @param  array $_where
         * @param  string $_offset
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月18日 上午10:04:03
         **/
        function getShowList($_where = 1,$_offset = 'count',$_memberId = 0){
            $showM = new Show();
            $lists = $showM->getShowList($_where,$_offset);
            if(!$lists) return [];
            //处理列表
            if((string)$_offset != 'count'){
                //点赞列表
                $showIds = [];
                if($_memberId > 0){
                    $showIds = arr2to1($lists);
                    $showIds = \common\models\Praise::isPraiseByShowIds($_memberId, $showIds);
                }

                foreach ($lists as $k => $v){
                    $lists[$k]['cover'] = ImageUrl.$v['cover'];
                    unset($lists[$k]['ctime']);
                    //写入演出时间范围
                    $times = $showM->getShowExpire($v['id']);
                    $lists[$k]['stime'] = date('Y-m-d',$times['stime']);
                    $lists[$k]['etime'] = date('Y-m-d',$times['etime']);
                    //
                    $lists[$k]['show_id'] = $v['id'];
                    //是否点赞
                    $lists[$k]['isPraise']  = in_array($v['id'], $showIds) ? 1 : 0;
                    unset($lists[$k]['id']);
                }
            }

            return $lists;
        }


        /**
         * API获取节目详情
         * @param  int $_showId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月6日 上午10:36:58
         **/
        function getShowInfoById($_showId,$_memberId = 0){
            $showM = new Show();
            $info = $showM->getShowInfoById($_showId);
            //写入演出时间范围
            $times = $showM->getShowExpire($_showId);
            $info['stime'] = date('Y-m-d',$times['stime']);
            $info['etime'] = date('Y-m-d',$times['etime']);
            $info['show_id'] = $_showId;
            $info['cover'] = ImageUrl.$info['cover'];
            $info['isPraise'] = 0;
            unset($info['id']);
            //是否点赞
            if($_memberId > 0){
                $showId = \common\models\Praise::isPraiseByShowIds($_memberId, $info['show_id']);
                $info['isPraise'] = in_array($info['show_id'], $showId) ? 1 : 0;
            }

            return $info;
        }

    }