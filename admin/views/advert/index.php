<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  节目编辑修改显示页
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年1月12日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    use yii\helpers\Html;
    use yii\helpers\Url;

    $this->title = '广告管理';

?>
<section class="main padder">
	<div class="col-lg-12" style="margin-top:30px;">
			<section class="panel">
				<header class="panel-heading">
					<div class="row step-bar">
						<a class="top-step" href="<?= Url::toRoute(['banner/index']) ?>">广告位设置</a><a class="top-step"> - </a>
						<a class="top-step" href="javascript:;">所有广告</a>
					</div>
				</header>
				<div class="all-adv-wrap">
					<div style="width: 100%;height: 60px;padding-left: 25px;padding-top:12px;"><a class="btn btn-small pull-left btn-info" href="<?= Url::toRoute(['advert/edit']) ?>" style="margin:10px; margin-left:16px;"><i class="icon-plus"></i> 新增广告</a></div>
					<ul>
						<?php foreach ($lists as $k => $v){?>
    						<li class="adv-block" id="advert_<?= $v['id'] ?>">
    							<div class="adv-poster"><img src="<?= ImageUrl,$v['cover']?>"></div>
    							<div class="adv-info">
    								<p class="adv-word" href=""><?= $v['title'] ?></p>
    								<div><a class="adv-edit" href="<?= Url::toRoute(['advert/edit','advert_id'=>$v['id']]) ?>">编辑</a>
    								<a class="adv-del" href="javascript:;" onclick="delshow($(this));" url="<?= Url::toRoute(['deladvert','id'=>$v['id']]) ?>" delId="#advert_<?= $v['id'] ?>">删除</a></div>
    							</div>
    						</li>
						<?php }?>
					</ul>
				</div>
			</section>
		</div>
</section>
