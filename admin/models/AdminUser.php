<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  后台管理员模型
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年1月12日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace app\models;

    use Yii;

    /**
     * This is the model class for table "admin_user".
     *
     * @property integer $id
     * @property string $username
     * @property string $passwd
     * @property string $avatar
     * @property integer $last_login_time
     * @property integer $static
     * @property integer $ctime
     */
    class AdminUser extends \yii\db\ActiveRecord
    {
        /**
         * @inheritdoc
         */
        public static function tableName()
        {
            return 'admin_user';
        }

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['last_login_time', 'static', 'ctime'], 'integer'],
                [['username'], 'string', 'max' => 50],
                [['username'], 'unqire', 'max' => 50],
                [['passwd'], 'string', 'max' => 40],
                [['avatar'], 'string', 'max' => 120],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels()
        {
            return [
                'id' => 'ID',
                'username' => '用户名',
                'passwd' => '密码',
                'avatar' => '头像',
                'last_login_time' => '最后登录时间',
                'static' => '状态 （1：启动，0：禁止）',
                'ctime' => '创建时间',
            ];
        }

    }