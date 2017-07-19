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

    class CommonM extends ActiveRecord{
        public static $_tableName;

        static function tableName(){
            return static::$_tableName;
        }

        static function setTabelName($_tableName){
            return static::$_tableName = $_tableName;
        }

        static function getInfoById($_id){
            return self::find()->where($_id)->asArray()->one();
        }

    }