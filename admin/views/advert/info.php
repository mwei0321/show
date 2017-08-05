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

    $this->title = '广告详情';
?>
<section class="main padder">
		<div class="col-lg-12" style="margin-top:30px;">
			<section class="panel">
				<header class="panel-heading">
					<div class="row step-bar">
						<a class="top-step" href="<?= Url::toRoute('banner/index')?>">广告位管理</a><a class="top-step" > - </a>
						<a class="top-step" href="javascript:;">广告详情</a>
					</div>
				</header>
				<div class="row main-info" style="margin-top:20px;">
					<h3 class="advert-info-title"><?= $advertInfo->title ?? '' ?></h3>
					<div class="banner-view"><img src="<?= ImageUrl,$advertInfo->cover??'' ?>"></div>
					<div class="info-button-group">
						<a class="info-btn info-edit-btn" href="<?= Url::toRoute(['edit','advert_id'=>$advertInfo->id??0])?>">编辑</a>
						<a class="info-btn info-delet-btn" href="javascript:;" onclick="deladvert($(this));" url="<?= Url::toRoute(['deladvert','id'=>$advertInfo['id']??0]) ?>">删除</a>
					</div>
				</div>
				<div class="row">
					<article class="dynamic-text"><?= $advertInfo->content??'' ?></article>
				</div>
			</section>
		</div>

    </section>
    <script>
		var deladvert = function (obj) {
    			if(!confirm('你确定要删除吗？')) return false;
    			var url = obj.attr('url');
    			$.ajax({
    				type:'get',
    				url	: url,
    				success:function (e){
    					if(e.status == 200){
    						mwlayer.success('删除成功！');
    						setTimeout(function () {
    							window.location.href='<?= Url::toRoute(['index'])?>';
    						},2000);
    						return false;
    					}
    					mwlayer.error('删除失败！');
    				}
    			});
			}
    </script>