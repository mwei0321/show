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
        protected static $_tableName;

        function __construct($_tableName){
            self::$_tableName = $_tableName;
        }

        /**
         * 表名
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月13日 下午2:26:06
        **/
        static function tableName(){
            return self::$_tableName;
        }

        /**
         * 根据主键ID返回详情
         * @param int $_id
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月13日 上午10:31:41
        **/
        static function getInfoById($_id){
            return self::find()->where($_id)->asArray()->one();
        }

        /**
         * @param  array
         * @param  string
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月13日 上午10:32:51
        **/
        static function getInfoByIds($_ids){
            return self::find()->where(['id'=>$_ids])->all();
        }

        /**
         * 获取详情
         * @param  array $_where
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月18日 下午2:18:12
        **/
        static function getInfoByWhere($_where = 1){
            return self::find()->where($_where)->asArray()->all();
        }
    }