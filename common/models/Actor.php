<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  演员数据操作模型
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年1月12日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace common\models;

    use yii\db\ActiveRecord;

    class Actor extends ActiveRecord{

        /**
         * 获取演员详情
         * @param  int $_id
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月12日 下午4:30:48
        **/
        function getActorInfoById($_id){
            return self::find()->where(['id'=>$_id])->asArray()->one();
        }

        /**
         * 获取多个演员详情
         * @param  array $_ids
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月12日 下午4:35:11
        **/
        function getActorInfoByIds($_ids){
            return self::find()->where(['id'=>$_ids])->asArray()->all();
        }

        /**
         * 获取所有的演员
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月13日 下午5:32:18
        **/
        function getActorInfoAll(){
            $actorLists = self::find()->asArray()->all();
            return fieldtokey($actorLists);
        }

        /**
         * 返回职务列表
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月13日 下午5:43:02
        **/
        function getActorDutyLists(){
            return [
                '演员',
                '编剧',
                '导演',
                '灯光',
                '音响',
                '舞美',
                '道具',
                '剧务',
                '后勤',
            ];
        }
    }