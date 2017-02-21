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
			<a class="btn btn-small pull-left btn-info" href="<?= Url::toRoute(['dynamic/edit']) ?>" style="margin:10px; margin-left:16px;"><i class="icon-plus"></i> 创建新动态</a>
		
		<div class="search-box" style="margin-top:10px;">
		<i class="icon-search text-muted"></i>
				<input type="text" class="input-small form-control" placeholder="搜索演出" id="search" url="<?= Url::toRoute(['dynamic/index'])?>">
		</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<section class="panel-content scrollbar scroll-y">
					<ul class="dynamic-list">
						<?php foreach ($lists as $k => $v){?>
    						<li	class="dynamic-block">
    							<div class="poster"><img src="<?= ImageUrl.$v['cover'] ?>"></div>
    							<div class="dynamic-info">
    								<a class="dynamic-title" href="<?= Url::toRoute(['dynamic/info','dyid'=>$v['id']]) ?>"><?= $v['title'] ?></a>
    								<p class="dynamic-time">发布时间：<?= date('Y-m-d H:i',$v['ctime']) ?></p>
    							</div>
    						</li>
						<?php }?>
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
