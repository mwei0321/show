<?php
namespace yii\HPlugin\SendSMS\Alidayu;

include "TopSdk.php";

class SMSMessage
{
    private $c,$req;
    private $msg = [
        'SEND_SMS_SUCCESS'    => '已发送',
        'VERIFY_CODE_RE'    => '已发送验证码，请90秒后再重新请求',
        'VERIFY_CODE_ERROR' => '验证码错误',
        'SEND_SMS_FAILD' => '发送失败，请重试',
        'SEND_SMS_FAILD_15' => '验证码发送超出限制，请一个小时后重试',
    ];

    function __construct()
    {
        $this->c = new \TopClient;
        $this->c->appkey = '23271436';
        $this->c->secretKey = '57b9bcacd9cd661cc5fb4702ee8c8698';
        $this->req = new \AlibabaAliqinFcSmsNumSendRequest;
        $this->req->setSmsType("normal");
        $this->req->setSmsFreeSignName("社团+");

    }

    function repos($send_re){
        if ( isset($send_re->result) && isset($send_re->result->err_code) && ($send_re->result->err_code==0) ) {
            $re = array('code'=>1,'msg'=>$this->msg['SEND_SMS_SUCCESS']);
        } elseif ( isset($send_re->code) && ($send_re->code==15) ) {
            $re = array('code'=>4,'msg'=>$this->msg['SEND_SMS_FAILD_15']);
        } else {
            $re = array('code'=>3,'msg'=>L('SEND_SMS_FAILD'));
        }
        return $re;
    }

//  短信验证码
    function sendMail_verify( $cel,$code,$time ) {
        $this->req->setSmsParam("{'code':'{$code}','time':'{$time}'}");
        $this->req->setRecNum($cel);
        $this->req->setSmsTemplateCode("SMS_11010315");
        $re = $this->c->execute($this->req);
        return $this->repos($re);
    }
}