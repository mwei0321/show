<?php
namespace yii\HPlugin\SendSMS;
use yii\base\Component;
use yii\HPlugin\SendSMS\Alidayu;

class Message extends Component
{
    private $vendor='alidayu';
    private $SMS;
    public  $message = [];

    function __construct(array $config)
    {
        parent::__construct($config);
        if ( isset($config['verdor']) && !empty($config['verdor']) ) {
            $this->vendor = $config['verdor'];
        }
        if ( $this->vendor=='alidayu' ) {
            // todo
            $this->SMS = new Alidayu\SMSMessage();
        } else {
            // todo
            $this->message = [ 'code'=>100400,'msg'=>'vendor error' ];
            return false;
        }
    }

    function sendRegedistCode($cellphone,$code,$time){
        $re = $this->SMS->sendMail_verify( $cellphone,$code,$time );
        return $re;
    }
}