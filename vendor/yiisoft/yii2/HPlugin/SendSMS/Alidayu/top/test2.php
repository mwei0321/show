<?php
echo '123';
$c = new TopClient;
$c->appkey = $appkey;
$c->secretKey = $secret;
$req = new AlibabaAliqinFcSmsNumSendRequest;
$req->setExtend("123456");
$req->setSmsType("normal");
$req->setSmsFreeSignName("社团家");
$req->setSmsParam("{'code':'123456','product':'654321','item':'456789'}");
$req->setRecNum("18665857320");
$req->setSmsTemplateCode("SMS_2106046");
$resp = $c->execute($req);