<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-form">
    <img src="images/logo.png">
</div>
<div class="site-login">
    <div class="form-box">
        <div class="login-control">
            <p class="login-hint">用户名</p>
            <input class="password-input" type="text" placeholder="输入账户名">
        </div>
        <div class="login-control">
            <p class="login-hint">密码</p>
            <input class="password-input" type="password" placeholder="输入密码">
            <p class="login-tips" id="password-tips">*输入密码错误*</p>
        </div>
        <a class="login">登录</a>
    </div>
</div>