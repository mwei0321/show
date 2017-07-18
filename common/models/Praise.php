<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  点赞
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年7月13日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.mawei.live
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace common\models;
    use yii\db\ActiveRecord;

    class Praise extends ActiveRecord{
        public static $_tableName;

        static function tableName(){
            return static::$_tableName;
        }

        /**
         * 设置表名
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月14日 上午11:34:19
        **/
        static function setTableName($_tablename){
            return static::$_tableName = $_tablename;
        }

    }