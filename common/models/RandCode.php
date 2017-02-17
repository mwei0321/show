<?php

namespace common\models;
use yii\db\ActiveRecord;

class RandCode extends ActiveRecord{
    private $M;
    function __construct(array $config=[])
    {
        parent::__construct($config);
        $this->M = $this->find();
    }

    static function tableName(){
        return 'verify_code';
    }

    function createCode($cellphone,$type){

//        $haveS = $this->findOne(['cellphone'=>$cellphone,'type'=>$type,'status'=>1]);
        $haveS = $this->M->where(['cellphone'=>$cellphone,'type'=>$type,'status'=>1])->asArray()->one();
//        var_dump($haveS);die();
        if ( $haveS && $haveS['create_time']>(time()-120) ) return ['code'=>'22','msg'=>'has send','data'=>['ctime'=>$haveS['create_time']]];

        $this->deleteAll(['cellphone'=>$cellphone]);
        $code = rand(1000,9999);

        $this->cellphone = $cellphone;
        $this->code = $code;
        $this->type = 11;
        $this->create_time = time();
        $re = $this->insert();
        if ( $re ) $re = ['code'=>1,'data'=>['code'=>$code]];
        else $re = ['code'=>3,'msg'=>'Error'];
        return $re;
    }

    function validateCode($cellphone,$code,$type){
        $haveS = $this->M->where(['cellphone'=>$cellphone,'type'=>$type,'status'=>1,'code'=>$code])->asArray()->one();
        if ( empty($haveS) ) $re = ['code'=>'3','msg'=>'code error'];
        else {
            $this->deleteAll(['cellphone'=>$cellphone]);
            $re = ['code'=>'1'];
        }
        return $re['code']==1?true:false;
    }

    function validateCodeOnly($cellphone,$code,$type){
        $haveS = $this->M->where(['cellphone'=>$cellphone,'type'=>$type,'status'=>1,'code'=>$code])->asArray()->one();
        if ( empty($haveS) ) $re = false;
        else $re = true;
        return $re;
    }

}

