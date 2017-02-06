<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:
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

    class Dynamic extends ActiveRecord{
        public $_pageSize = 20;

        static function tablName(){
            return 'dynamic';
        }

        /**
         * 获取动态列表
         * @param  array $_where
         * @param  string $_offset
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月6日 上午11:47:12
        **/
        function getDynamicList($_where = 1,$_offset = 'count'){
            $dynamicM = self::find()->where($_where);
            if((string)$_offset == 'count'){
                return $dynamicM->count();
            }

            $data = $dynamicM->offset($_offset)->limit($this->_pageSize)->orderBy('id DESC')->asArray()->all();
            return $data;
        }

        /**
         * 获取动态详情
         * @param  int $_dynamicId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月6日 上午11:48:48
        **/
        function getDynamicInfoById($_dynamicId){
            return self::find()->where(['id'=>$_dynamicId])->asArray()->one();
        }
    }
