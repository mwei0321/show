<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  节目操作模型
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年1月11日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    /**
     * This is the model class for table "show".
     *
     * @property integer $id
     * @property string $title
     * @property string $cover
     * @property string $intro
     * @property string $actor
     * @property integer $stime
     * @property integer $etime
     * @property integer $ctime
     */

    namespace admin\models;

    use yii\db\ActiveRecord;

    class Show extends ActiveRecord{

        /**
         * 定义表对象
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月12日 上午11:50:13
        **/
        static function tableName(){
            return 'show';
        }

        /**
         * 获取节目详情
         * @param  int $_id
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月12日 下午3:35:59
        **/
        function getShowInfoById($_id){
            return self::findOne($_id);
            return self::find()->where($_id)->asArray()->one();
        }


        /**
         * 表单验证规则定义
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月12日 上午11:50:35
         **/
        function rules(){
            return [
                [['title', 'cover', 'intro'], 'required'],
                [['intro'], 'string'],
                [['stime', 'etime', 'ctime'], 'integer'],
                [['title', 'cover'], 'string', 'max' => 120],
                [['actor'], 'string', 'max' => 200],
            ];
        }

        /**
         * 表字段在表单显示
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月12日 上午11:50:59
         **/
        function attributeLabels(){
            return [
                'id' => 'ID',
                'title' => '演出名称',
                'cover' => '封面',
                'intro' => '简介',
                'actor' => '演员 （多个用，隔开）',
                'stime' => '开始时间',
                'etime' => '结束时间',
                'ctime' => '创建时间',
            ];
        }
    }

