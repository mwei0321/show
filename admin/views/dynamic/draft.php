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

    $this->title = '动态草稿主页';
?>

<section class="main padder">
	<div class="row">
		<div class="m-t-small">
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					<div class="step-bar">
						<a class="top-step" href="<?= Url::toRoute(['dynamic/index']) ?>">动态管理</a>
						<a class="top-step" > - </a>
						<a class="top-step" href="javascript:;">草稿箱</a>
					</div>
				</header>
				<section class="panel-content scrollbar scroll-y">
					<ul class="dynamic-list">
							<?php foreach ($list as $k => $v){?>
    						<li	class="dynamic-block" id="dynamic_<?= $v['id'] ?>">
    							<div class="dt-poster"> <a href="<?= Url::to('dynamic/info',['dyid'=>$v['id']]) ?>"><img src="<?= ImageUrl,$v['cover'] ?>"></a></div>
    							<div class="dynamic-info">
    								<a class="dynamic-title" href="<?= Url::to('dynamic/info',['dyid'=>$v['id']]) ?>"><?= $v['title'] ?></a>
    								<p class="dynamic-time">保存时间：<?= date('Y-m-d H:i')?></p>
									<div class="draft-operation"><a class="draft-edit" href="<?= Url::toRoute(['edit','dyid'=>$v['id']]) ?>">编辑</a>
									<a class="draft-release" href="javascript:;" onclick="issue($(this));" url="<?= Url::toRoute(['issue','dyid'=>$v['id']]) ?>" delId="#dynamic_<?= $v['id'] ?>">发布</a>
									<a class="draft-del" href="javascript:;" onclick="delshow($(this));" url="<?= Url::toRoute(['deldynamic','dyid'=>$v['id']]) ?>" delId="#dynamic_<?= $v['id'] ?>">删除</a></div>
    							</div>
    						</li>
    						<?php } ?>
					</ul>
				</section>
			</section>
		</div>
	</div>
	<script>
		var issue = function (obj) {
			if(!confirm('你确定要发布吗？')) return false;
			var url = obj.attr('url');
			var delid = obj.attr('delid');
        	$.ajax({
        		type:'get',
        		url	: url,
        		success:function (e){
        			if(e.status == 200){
        				mwlayer.success('发布成功！');
        				$(delid).remove();
        				return false;
        			}
        			mwlayer.error('发布失败！');
        		}
        	});
		}
	</script>
</section>
