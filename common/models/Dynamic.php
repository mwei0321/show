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
            $dynamicM = self::find()->where($_where)->andWhere(['status'=>1]);
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

        /**
         * 获取前几动态列表
         * @param  string $_orderBy
         * @param  string $_limit
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月10日 下午5:12:26
        **/
        function getDynamicListByTop($_orderBy = 'ctime DESC',$_limit = 3){
            return self::find()->where(['status'=>1])->orderBy($_orderBy)->limit($_limit)->asArray()->all();
        }
    }
