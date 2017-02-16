<?php

namespace common\models;
use yii\db\ActiveRecord;

class Member extends ActiveRecord{
    private $M;
    function __construct(array $config=[])
    {
        parent::__construct($config);
        $this->M = $this->find();
    }
    static function tableName(){
        return 'member';
    }

    function ifCellphoneExist($useranme){
        return $this->M->where(['cellphone'=>$useranme])->count();
    }
    function ifUsernameExist($useranme){
        return $this->M->where(['username'=>$useranme])->count();
    }

    function getByNamePwd($useranme,$pwd){
        $haveS = $this->M->where(['cellphone'=>$useranme,'status'=>1])->asArray()->one();
        if ( empty($haveS) ) $haveS = $this->M->where(['username'=>$useranme,'status'=>1])->asArray()->one();
        if ( $haveS && $this->encodePwd($pwd)==$haveS['passwd'] ) {
            return ['member_id'=>$haveS['id'],'username'=>$haveS['username'],'cellphone'=>$haveS['cellphone']];
        }
        else return false;
    }

    function addOne($username,$pwd){
        if ( $this->ifCellphoneExist($username) || $this->ifUsernameExist($username) ) return false;
        $this->username = $this->cellphone = $username;
        $this->passwd = $this->encodePwd($pwd);
        $this->ctime = time();
        return $this->insert();
    }

    function resetPwd($cellphone,$pwd){
        if ( empty($cellphone) || empty($pwd) ) return false;
        $M = $this->findOne(['cellphone'=>$cellphone]);
        if ( empty($M) ) return false;
        $M->passwd = $this->encodePwd($pwd);
        return $M->update();
    }

    function encodePwd($pwd){
        if ( ! is_string($pwd) ) return false;
        return md5( md5($pwd) );
    }

}

