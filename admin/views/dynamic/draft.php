<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  动态管理
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
	<div class="row">
		<div class="m-t-small">

		<div class="search-box" style="margin-top:10px;">
		<i class="icon-search text-muted"></i>
				<input type="text" class="input-small form-control" placeholder="搜索动态" id="search" url="<?= Url::toRoute(['dynamic/index'])?>">
		</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<section class="panel-content scrollbar scroll-y">
					<ul class="dynamic-list">
    						<li	class="dynamic-block">
    							<div class="dt-poster"> <a href=""><img src=""></a></div>
    							<div class="dynamic-info">
    								<a class="dynamic-title" href="">大风说的是发顺丰</a>
    								<p class="dynamic-time">发布时间：3423</p>
    							</div>
    						</li>
					</ul>
				</section>
			</section>
			<div class="page">
				<?= LinkPager::widget([
				    'pagination'=>$pages
				]); ?>
            </div>
		</div>
	</div>
</section>
