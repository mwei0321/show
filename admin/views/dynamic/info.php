<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  动态编辑修改显示页
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

    $this->title = '动态详情';
?>
<section class="main padder">
		<div class="col-lg-12" style="margin-top:30px;">
			<section class="panel">
				<header class="panel-heading">
					<div class="row step-bar">
						<a class="top-step" href="dynamic.html">剧团动态管理</a><a class="top-step" > - </a><a class="top-step" >动态详情</a>
					</div>
				</header>
				<div class="row main-info">
					<div class="poster intro-post"><img src="<?= ImageUrl.$info['cover'] ?>"></div>
					<div class="session-info">
						<a class="info-name"><?= $info['title']??null ?></a>
						<p class="info-time">发布时间：<?= date('Y-m-d H:i',$info['ctime']) ?></p>
					</div>
					<div class="info-button-group">
						<a class="info-btn info-edit-btn" href="<?= Url::toRoute(['dynamic/edit','dyid'=>$info['id']]) ?>">编辑</a>
						<a class="info-btn info-delet-btn" href="javascript:;" onclick="delById($(this),delmsgJump);" url="<?= Url::toRoute(['dynamic/deldynamic','dyid'=>$info['id']]) ?>">删除</a>
					</div>
				</div>
				<div class="row">
					<article class="dynamic-text"><?= $info['content'] ?></article>
				</div>
			</section>
		</div>

    </section>