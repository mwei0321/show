<?php
namespace api\controllers;
use api\controllers\CommonController;
use common\models\Member;
use common\models\RandCode;
use yii\base\Behavior;
use yii\base\Event;

class MemberController extends CommonController{

    /**
     * 登录
     */
    function actionLogin(){
        $Member = new Member();
        $cellphone = \yii::$app->request->get('cellphone');
        $pwd       = \yii::$app->request->get('pwd');
        $data = [];
        if ( $cellphone && $pwd ) {
            $re = $Member->getByNamePwd($cellphone,$pwd);
            if ( empty($re) ) {
                $this->_reCode = 440;
                $this->_reMsg = '登录失败，请检查账号或密码!';
            } else {
                $data = ['token'=>$re['member_id'],'username'=>$re['username'],'cellphone'=>$re['cellphone']];
            }
        } else {
            $this->_reCode = 440;
        }
        return $this->_returnJson($data);
    }
    /**
     * 注册
     * @return json
    **/
    function actionRegister(){
        $Member = new Member();
        $Randcode = new RandCode();
        $cellphone = \yii::$app->request->get('cellphone');
        $username  = \yii::$app->request->get('username');
        $code      = \yii::$app->request->get('code');
        $pwd       = \yii::$app->request->get('pwd');
        $data = [];
        if ( $cellphone && $code && $pwd && $username ) {
            if ( ! $Randcode->validateCode($cellphone,$code,11) ) {
                $this->_reCode = 440;
                $this->_reMsg = '验证码错误';
            } elseif ( $Member->ifUsernameExist($username) ) {
                $this->_reCode = 440;
                $this->_reMsg = '该用户名已被注册';
            } elseif ( $Member->ifCellphoneExist($cellphone) ) {
                $this->_reCode = 440;
                $this->_reMsg = '该手机号码已被注册';
            } else {
                $re = $Member->addOne($cellphone,$pwd);
                if ( empty($re) ) {
                    $this->_reCode = 440;
                    $this->_reMsg = '注册失败，请重试!';
                } else {
                    $re = $Member->getByNamePwd($cellphone,$pwd);
                    $data = ['token'=>$re['member_id'],'username'=>$re['username'],'cellphone'=>$re['cellphone']];
                }
            }
        } else {
            $this->_reCode = 440;
        }
        return $this->_returnJson($data);

    }

    /**
     * 获取验证码
     * @return json
     */
    function actionGetverifycode(){
        $cellphone = \yii::$app->request->get('cellphone');
        if ( empty($cellphone) ) {
            $this->_reCode = 440;
            return $this->_returnJson();
        }

        $Randcode = new RandCode();
        $sms = new \yii\HPlugin\SendSMS\Message([]);
        $code_arr = $Randcode->createCode($cellphone,11);
        if ( $code_arr['code']==1 ) {
            $sms->sendRegedistCode( $cellphone,$code_arr['data']['code'],'2' );
            return $this->_returnJson();
        } else {
            $this->_reCode = 440;
            $this->_reMsg = $code_arr['msg'];
            return $this->_returnJson();
        }
    }

    /**
     * 验证验证码
     */
    function actionVerifycode(){
        $cellphone = \yii::$app->request->get('cellphone');
        $code = \yii::$app->request->get('code');

        $Randcode = new RandCode();
        if ( $cellphone && $code ) {
            if ( ! $Randcode->validateCodeOnly($cellphone,$code,11) ) {
                $this->_reCode = 440;
                $this->_reMsg = '验证码错误';
            }
        } else {
            $this->_reCode = 440;
        }
        return $this->_returnJson();
    }

    /**
     * 重置密码
     */
    function actionResetpwd(){
        $Member    = new Member();
        $Randcode  = new RandCode();
        $cellphone = \yii::$app->request->get('cellphone');
        $code      = \yii::$app->request->get('code');
        $pwd       = \yii::$app->request->get('newpwd');
        $pwdre     = \yii::$app->request->get('newpwdre');
        if ( $cellphone && $code && $pwd && $pwdre && ($pwd==$pwdre) ) {
            if ( ! $Randcode->validateCode($cellphone,$code,11) ) {
                $this->_reCode = 440;
                $this->_reMsg = '验证码错误';
            } elseif ( ! $Member->ifExist($cellphone) ) {
                $this->_reCode = 440;
                $this->_reMsg = '该账号不存在';
            } else {
                $re = $Member->resetPwd($cellphone,$pwd);
                if ( empty($re) ) {
                    $this->_reCode = 440;
                    $this->_reMsg = '操作失败，请重试!';
                }
            }
        } else {
            $this->_reCode = 440;
        }
        return $this->_returnJson();
    }

}