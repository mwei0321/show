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

    $this->title = '节目编辑修改';

?>
<section class="main padder">
		<div class="col-lg-12" style="margin-top:30px;">
			<section class="panel">
				<header class="panel-heading">
					<div class="row step-bar">
    					<a class="top-step" href="<?= Url::toRoute(['show/index']) ?>">演出管理</a>
    					<a class="top-step" > - </a>
    					<a class="top-step" href="<?= Url::toRoute(['show/edit','id'=>$show_id]) ?>">编辑演出</a>
					</div>
				</header>
				<div class="row">
					<div class="row col-lg-12">
						<div class="left-list">
							<ul class="nav theatre-arrange" role="tablist">
								<?php foreach ($times as $k => $v){?>
        							<li role="presentation" class="active">
        								<a href="javascript:;" aria-controls="home" role="tab" data-toggle="tab"><?= date('Y-m-d H:i',$v['stime']) ?></a>
        							</li>
    							<?php }?>
							</ul>
						</div>
						<div class="right-form">
							<div class="stage-block">
								舞台
							</div>
							<div class="tab-content">
							  <div role="tabpanel" class="tab-pane active" id="1-set" data="1">
								<div class="field" style="text-align:center;">

								<p class="oneset"><a class="seat sold" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a></p><p class="oneset"><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a></p><p class="oneset"><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a></p><p class="oneset"><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a></p><p class="oneset"><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a></p><p class="oneset"><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a></p><p class="oneset"><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a></p><p class="oneset"><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a></p><p class="oneset"><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a></p><p class="oneset"><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a></p><p class="oneset"><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a></p><p class="oneset"><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a></p><p class="oneset"><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a></p><p class="oneset"><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a></p><p class="oneset"><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a><a class="seat" data=""></a></p></div>
							  </div>
							  <div role="tabpanel" class="tab-pane" id="2-set" data="2">
								<div class="field" style="text-align:center;">

								</div>
							  </div>
							  <div role="tabpanel" class="tab-pane" id="3-set" data="3">
								<div class="field" style="text-align:center;">

								</div>
							  </div>
							  <div role="tabpanel" class="tab-pane" id="4-set" data="4">
								<div class="field" style="text-align:center;">

								</div>
							  </div>
							</div>
						</div>
					</div>
					<div class="row col-lg-12" style="text-align:center;"><a class="confirm-it">发布</a></div>
				</div>
			</section>
		</div>

    </section>