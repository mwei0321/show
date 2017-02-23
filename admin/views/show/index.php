<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  话剧演出管理
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

            <a class="btn btn-small pull-left btn-info" href="<?= Url::toRoute('edit') ?>" style="margin:10px; margin-left:16px;"><i class="icon-plus"></i> 创建新演出</a>
			<div class="search-box" style="margin-top:10px;">
				<i class="icon-search text-muted"></i>
                <input type="text" class="input-small form-control" placeholder="搜索演出" id="search" url="<?= Url::toRoute(['show/index'])?>">
			</div>
		</div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <ul class="nav nav-pills pull-right">
                        <li>
                            <a href="javascript:;" class="panel-toggle text-muted"><i class="icon-caret-down icon-large text-active"></i><i class="icon-caret-up icon-large text"></i></a>
                        </li>
                    </ul>
                    共<span class="label label-large bg-default"><?= $pages->totalCount ?></span>场演出
                </header>
                <section class="panel-content scrollbar scroll-y">
                    <ul class="theatre">
                    <?php foreach ($lists as $k => $v) {?>
                        <li	class="theatre-session" id="show_<?= $v['id'] ?>">
                            <div class="poster"><img src="<?= ImageUrl.$v['cover'] ?>"></div>
                            <div class="session-info">
                                <a class="theatre-name"><?= $v['title'] ?></a>
                                <p class="theatre-time">时间：
                                <?php if($v['stime'] == $v['etime']) {
                                    echo $v['stime'].' (只演一天)';
                                }else{
                                    echo $v['stime'].' 至 '.$v['etime'];
                                }?>
                                <div class="theatre-button-group">
                                    <a class="theatre-button" href="<?= Url::toRoute(['ticket/seat','show_id'=>$v['id']]) ?>">售票情况</a>
                                    <a class="theatre-button" href="<?= Url::toRoute(['show/edit','id'=>$v['id']]) ?>">编辑详情</a>
                                    <a class="theatre-button-red" href="javascript:;" onclick="delshow($(this));" url="<?= Url::toRoute(['del-show','id'=>$v['id']]) ?>" delId="#show_<?= $v['id'] ?>">删除</a>
                                </div>
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
