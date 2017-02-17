<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  演员管理
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年1月11日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    use yii\helpers\Url;
    use yii\widgets\LinkPager;

?>
<section class="main padder">
		<div class="col-lg-12" style="margin-top:30px;">
			<div class="row">
				<div class="top-operation">
					<a class="btn btn-small btn-info" style="margin-left:11px;margin-bottom:2px;" href="<?= Url::toRoute(['actor/edit'])?>"><i class="icon-plus"></i> 添加演职员</a>
					<form class="navbar-form search-cast shift" action="" data-toggle="shift:appendTo" data-target=".nav-primary">
						<i class="icon-search text-muted"></i>
						<input type="text" class="input-small form-control" placeholder="Search">
					</form>
				</div>
			</div>
			<div class="row">
				<section class="" id="a-block">
					<ul class="cast-list">
						<?php foreach ($actorList as $k => $v){ ?>
    						<li class="cast-display">
    							<div class="actor-display">
    								<img src="<?= ImageUrl.$v['avatar'] ?>">
    							</div>
    							<a class="cast-list-name" href="cast-detail.html"><?= $v['name'] ?></a>
    						</li>
						<?php }?>
					</ul>
				</section>
			</div>
		</div>

    </section>