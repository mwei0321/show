<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  演员编辑修改显示页
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年2月14日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    use yii\helpers\Html;
    use yii\helpers\Url;

    $this->title = '演员详情';
?>
<section class="main padder">
		<div class="col-lg-12" style="margin-top:30px;">
			<section class="panel" style="min-height:820px;">
				<header class="panel-heading">
					<div class="row step-bar">
						<a class="top-step" href="<?= Url::toRoute(['actor/index'])?>">演职员管理</a><a class="top-step" > - </a>
						<a class="top-step" href="javascript:;">演职员详情</a>
					</div>
				</header>
				<h1 class="cast-name"><?= $ActorInfo['name'] ?></h1>
				<div class="row main-cast-info">
					<div class="poster intro-post"><img src="<?= ImageUrl.$ActorInfo['avatar'] ?>"></div>
					<div class="session-info">
						<p class="cast-info-details" id="gender">性别：<?= $ActorInfo['gender'] ? '男' : '女' ?></p>
						<p class="cast-info-details" id="signs">星座：<?= $ActorInfo['constellation']?></p>
						<p class="cast-info-details" id="birth">出生日期：<?= $ActorInfo['birthday'] ?></p>
						<p class="cast-info-details" id="land">出生地：<?= $ActorInfo['address']?></p>
					</div>
					<div class="info-button-group">
						<a class="info-btn info-edit-btn" href="<?= Url::toRoute(['actor/edit','actor_id' => $ActorInfo['id']]) ?>">编辑</a>
						<a class="info-btn info-delet-btn" href="javascript:;" onclick="delById($(this),delmsgJump);" url="<?= Url::toRoute(['actor/delactor','actor_id' => $ActorInfo['id']]) ?>">删除</a>
					</div>
				</div>
				<div class="row">
					<article class="intro-text">
						<p class="intro-title">个人简介</p>
						<p class="intro-main"><?= $ActorInfo['intro'] ?></p>
					</article>
				</div>
			</section>
		</div>

    </section>