<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  话剧演出详情
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

    $this->title = "话剧演出详情";
?>

<section class="main padder">
		<div class="col-lg-12" style="margin-top:30px;">
			<section class="panel">
				<header class="panel-heading">
					<div class="row step-bar">
						<a class="top-step" href="<?= Url::toRoute(['show/index']) ?>">演出管理</a><a class="top-step" > - </a><a class="top-step" href="javascript:;">演出详情</a>
					</div>
				</header>
				<div class="row main-info">
					<div class="poster intro-post"><img src=""></div>
					<div class="session-info">
						<a class="info-name"><?= $showInfo['title']?></a>
						<p class="info-time">时间：
    						<?php if($showInfo['stime'] == $showInfo['etime']) {
                                echo $showInfo['stime'];
                            }else{
                                echo $showInfo['stime'].' 至 '.$showInfo['etime'];
                            }?>
                        </p>
						<p class="info-time">时长：<?= $showInfo['duration']?>分钟左右</p>
					</div>
					<div class="info-button-group">
						<a class="info-btn info-edit-btn" href="<?= Url::toRoute(['show/edit','id'=>$showInfo['id']]) ?>">编辑</a>
						<a class="info-btn info-delet-btn" href="javascript:;" onclick="delshow($(this));" url="<?= Url::toRoute(['del-show','id'=>$showInfo['id']]) ?>" delId="#show_<?= $showInfo['id'] ?>">删除</a>
					</div>
				</div>
				<div class="row">
					<article class="intro-text">
						<p class="intro-title">演出简介</p>
						<p class="intro-main"><?= $showInfo['intro'] ?></p></article>
					<div class="cast-bar">
						<ul class="cast-slider">
						<?php foreach ($showActors as $k => $v){?>
							<li class="cast">
								<div class="actor-heading">
									<img src="<?= ImageUrl.$v['avatar'] ?>">
								</div>
								<p class="actor-name"><?= $v['name']?></p>
								<p class="position"><?= $v['dutyName'] ?></p>
							</li>
						<?php }?>
						</ul>
					</div>
				</div>
				<div class="row" style="padding: 60px;">
					<p class="" style="font-size:24px;">售票情况</p>
					<div class="row col-lg-12" style="margin-top:40px;">
						<div class="left-list">
							<ul class="nav theatre-arrange" role="tablist">
								<?php foreach ($showTimes as $k => $v){?>
        							<li role="presentation" class="<?= $times_id == $v['id'] ? 'active' : '' ?>">
        								<a onclick="timesseat($(this));" url="<?= Url::toRoute(['ticket/timesseat','timesid'=>$v['id']])?>" href="" aria-controls="home" role="tab" data-toggle="tab"><?= date('Y-m-d H:i',$v['stime']) ?></a>
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
    								<div class="field" style="text-align:center;" id="seatmap">
    									<?php
    									   $seatId = 0;
    									   foreach ($seatNum as $val){
    									       echo '<p class="oneset">';
    									       for ($i = 0;$i <= $val;$i++){
    									            $seatId++;
                                                    echo '<a class="seat '.(in_array($seatId,$reserved) ? 'selected' : null).' href="javascript:;"></a>';
    									       }
    									       echo '</p>';
    									   }
    								    ?>
    								</div>
							 </div>
							</div>
						</div>
						<p style="margin:10px auto;text-align:center;"><a class="seat"></a>为可选座位&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="seat sold"></a>为已预订座位&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="seat selected"></a>为已锁定座位</p>
					</div>
				</div>
			</section>
		</div>

    </section>
<script>
		var timesseat = function (Obj){
			var url = Obj.attr('url');
			$.ajax({
				url:url,
				success:function (e){
					$('#seatmap').html(e.html);
					Obj.parent('li').addClass('active').siblings().removeClass('active');

				}
			});
		};

    </script>