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
                    $list[$k]['ctime'] = date('Y-m-d H:i',$v['ctime']);
                    unset($list[$k]['static']);
                    unset($list[$k]['utime']);
                    unset($list[$k]['content']);
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
            $info['ctime'] = date('Y-m-d H:i',$info['ctime']);
            unset($info['static']);
            unset($info['utime']);

            return $info;
        }
    }
