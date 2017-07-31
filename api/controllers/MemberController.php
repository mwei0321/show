<?php
namespace api\controllers;
use api\controllers\CommonController;
use common\models\Member;
use common\models\RandCode;

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
                $this->_reMsg = $this->_showMsg = '登录失败，请检查账号或密码!';
            } else {
                $data = ['token'=>$re['member_id'],'username'=>$re['username'],'cellphone'=>$re['cellphone'],'avatar'=>$re['avatar']];
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
            if ( $Member->ifUsernameExist($username) ) {
                $this->_reCode = 440;
                $this->_showMsg =$this->_reMsg = '该用户名已被注册';
            } elseif ( strlen($pwd)<6 || strlen($pwd)>12 ) {
                $this->_reCode = 440;
                $this->_showMsg =$this->_reMsg = '密码格式不对';
            } elseif ( ! $Randcode->validateCode($cellphone,$code,11) ) {
                $this->_reCode = 440;
                $this->_showMsg =$this->_reMsg = '验证码错误';
            } elseif ( $Member->ifCellphoneExist($cellphone) ) {
                $this->_reCode = 440;
                $this->_showMsg =$this->_reMsg = '该手机号码已被注册';
            } else {
                $re = $Member->addOne($cellphone,$username,$pwd);
                if ( empty($re) ) {
                    $this->_reCode = 440;
                    $this->_showMsg =$this->_reMsg = '注册失败，请重试!';
                } else {
                    $re = $Member->getByNamePwd($cellphone,$pwd);
                    $data = ['token'=>$re['member_id'],'username'=>$re['username'],'cellphone'=>$re['cellphone'],'avatar'=>$re['avatar']];
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
            $re = $sms->sendRegedistCode( $cellphone,$code_arr['data']['code'],'2' );
            echo json_decode($re);
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
                $this->_showMsg =$this->_reMsg = '验证码错误';
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
            if ( ! $Member->ifCellphoneExist($cellphone) ) {
                $this->_reCode = 440;
                $this->_showMsg =$this->_reMsg = '该账号不存在';
            } elseif ( ! $Randcode->validateCode($cellphone,$code,11) ) {
                $this->_reCode = 440;
                $this->_showMsg =$this->_reMsg = '验证码错误';
            } else {
                $re = $Member->resetPwd($cellphone,$pwd);
                if ( $re===false ) {
                    $this->_reCode = 440;
                    $this->_reMsg = '操作失败，请重试!';
                }
            }
        } else {
            $this->_reCode = 440;
        }
        return $this->_returnJson();
    }

    // 上传图片
    function actionUploadeimg(){
        $fileInfo = (new \common\models\Uploade('avatar'))->uploadeImg();
        $reArray = [
            'path'      =>  ImageUrl.$fileInfo['path'],
            'imgPath'   =>  $fileInfo['path'],
            'status'    =>  200,
        ];

        return $this->_returnJson($reArray);
    }

    function actionUpdate(){
        $token = \yii::$app->request->get('token');
        $avatar = \yii::$app->request->get('avatar');
        $uname  = \yii::$app->request->get('username');
        if ( empty($token) || empty($avatar) || empty($uname) ) $this->_reCode = 440;
        else {
            $Member    = new Member();
            $re = $Member->updateOne( ['avatar'=>$avatar,'username'=>$uname],$token );
            if ( empty($re) ) {
                $this->_reCode = 440;
                $this->_reMsg = '操作失败，请重试!';
            }
        }
        return $this->_returnJson();
    }

}