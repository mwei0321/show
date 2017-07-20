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

        /**
         * 演出是否点赞过
         * @param  int $_memberId
         * @param  array $_ids
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月20日 下午2:37:10
        **/
        static function isPraiseByShowIds($_memberId,$_showIds){
            static::$_tableName = 'show_praise';
            $showIds = self::find()->select('show_id')->where([
                'member_id' => $_memberId,
                'show_id'   => $_showIds,
                'status'    => 1,
            ])->asArray()->all();

            return $showIds ? arr2to1($showIds,'show_id') : [];
        }

        /**
         * 动态是否点赞过
         * @param  int $_memberId
         * @param  array $_ids
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月20日 下午2:37:10
        **/
        static function isPraiseByDynamicIds($_memberId,$_dynamicIds){
            static::$_tableName = 'dynamic_praise';
            $dynamicIds = self::find()->select('dynamic_id')->where([
                'member_id' => $_memberId,
                'dynamic_id'=> $_dynamicIds,
                'status'    => 1,
            ])->asArray()->all();

            return $dynamicIds ? arr2to1($dynamicIds,'dynamic_id') : [];
        }

        /**
         * 演员是否点赞过
         * @param  int $_memberId
         * @param  array $_ids
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月20日 下午2:37:10
        **/
        static function isPraiseByActorIds($_memberId,$_actorIds){
            static::$_tableName = 'actor_praise';
            $actorIds = self::find()->select('actor_id')->where([
                'member_id' => $_memberId,
                'actor_id'  => $_actorIds,
                'status'    => 1,
            ])->asArray()->all();

            return $actorIds ? arr2to1($actorIds,'actor_id') : [];
        }
    }