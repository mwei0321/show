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
		<i class="icon-search text-muted" style="left:20px;"></i>
				<input type="text" class="input-small form-control" style="margin-left:15px;" placeholder="搜索动态" id="search" url="<?= Url::toRoute(['dynamic/index'])?>">
		</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					<div class="step-bar">
						<a class="top-step" href="<?= Url::toRoute(['show/index']) ?>">演出管理</a>
						<a class="top-step" > - </a>
						<a class="top-step" href="">编辑演出</a>
					</div>
				</header>
				<section class="panel-content scrollbar scroll-y">
					<ul class="dynamic-list">
    						<li	class="dynamic-block">
    							<div class="dt-poster"> <a href=""><img src=""></a></div>
    							<div class="dynamic-info">
    								<a class="dynamic-title" href="">22222</a>
    								<p class="dynamic-time">发布时间：</p>
									<div class="draft-operation"><a class="draft-edit">编辑</a><a class="draft-release">发布</a><a class="draft-del">删除</a></div>
    							</div>
    						</li>
    						<li	class="dynamic-block">
    							<div class="dt-poster"> <a href=""><img src=""></a></div>
    							<div class="dynamic-info">
    								<a class="dynamic-title" href="">22222</a>
    								<p class="dynamic-time">发布时间：</p>
									<div class="draft-operation"><a class="draft-edit">编辑</a><a class="draft-release">发布</a><a class="draft-del">删除</a></div>
    							</div>
    						</li>
    						<li	class="dynamic-block">
    							<div class="dt-poster"> <a href=""><img src=""></a></div>
    							<div class="dynamic-info">
    								<a class="dynamic-title" href="">22222</a>
    								<p class="dynamic-time">发布时间：</p>
									<div class="draft-operation"><a class="draft-edit">编辑</a><a class="draft-release">发布</a><a class="draft-del">删除</a></div>
    							</div>
    						</li>
    						<li	class="dynamic-block">
    							<div class="dt-poster"> <a href=""><img src=""></a></div>
    							<div class="dynamic-info">
    								<a class="dynamic-title" href="">22222</a>
    								<p class="dynamic-time">发布时间：</p>
									<div class="draft-operation"><a class="draft-edit">编辑</a><a class="draft-release">发布</a><a class="draft-del">删除</a></div>
    							</div>
    						</li>
					</ul>
				</section>
			</section>
		</div>
	</div>
</section>
