<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  动态API接口处理模型
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
    use common\models\Dynamic;

    class ApiDynamic extends ActiveRecord{


        /**
         * 获取动态列表
         * @param  array $_where
         * @param  string $_offset
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月6日 上午11:58:34
        **/
        function getDynamicList($_where = 1,$_offset = 'count'){
            $list = (new Dynamic())->getDynamicList($_where,$_offset);

            if($_offset != 'count'){
                foreach ($list as $k => $v){
                    $list[$k]['cover'] = ImageUrl.$v['cover'];
                    $list[$k]['ctime'] = date('Y-m-d',$v['ctime']);
                    $list[$k]['dynamic_id'] = $v['id'];
                    unset($list[$k]['static']);
                    unset($list[$k]['utime']);
                    unset($list[$k]['content']);
                    unset($list[$k]['id']);
                }
            }

            return $list;
        }

        /**
         * 获取动态详情
         * @param  int $_dynamicId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月6日 下午3:09:16
        **/
        function getDynamicInfoById($_dynamicId){
            $info = (new Dynamic())->getDynamicInfoById($_dynamicId);

            $info['cover'] = ImageUrl.$info['cover'];
            $info['ctime'] = date('Y-m-d',$info['ctime']);
            $info['dynamic_id'] = $info['id'];
            unset($info['static']);
            unset($info['utime']);
            unset($info['id']);

            return $info;
        }

        /**
         * 获取动态最几
         * @param  string $_orderBy
         * @param  string $_limit
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月10日 下午5:27:21
        **/
        function getDynamicByTop($_orderBy = 'ctime DESC',$_limit = 3){
            $dynamic = (new Dynamic())->getDynamicListByTop($_orderBy,$_limit);

            foreach ($dynamic as $k => $v){
                $dynamic[$k]['dynamic_id'] = $v['id'];
                $dynamic[$k]['ctime'] = date('Y-m-d',$v['ctime']);
                $dynamic[$k]['cover'] = ImageUrl.$v['cover'];
                unset($dynamic[$k]['status']);
                unset($dynamic[$k]['utime']);
                unset($dynamic[$k]['ctime']);
                unset($dynamic[$k]['id']);
                unset($dynamic[$k]['content']);
            }

            return $dynamic;
        }
    }
