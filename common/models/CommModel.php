<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  可变共用模型
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年1月13日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace common\models;
    use yii\db\ActiveRecord;

    class CommonModel extends ActiveRecord{
        private $tableName;

        function __construct($_tableName){

            self::$tableName = $_tableName;
        }

        /**
         * 根据主键ID返回详情
         * @param int $_id
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月13日 上午10:31:41
        **/
        function getInfoById(){
            return self::find()->where($id)->asArray()->one();
        }

        /**
         * @param  array
         * @param  string
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月13日 上午10:32:51
        **/
        function getInfoByIds(){
            return self::find()->where(['id'=>$_ids])->all();
        }
    }