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
    //星期
    $_week = ['周日','周一','周二','周三','周四','周五','周六']
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
					<div class="poster intro-post"><img src="<?= ImageUrl.$showInfo['cover']?>"></div>
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
						<a class="info-btn info-delet-btn" href="javascript:;" onclick="delshow3($(this));" url="<?= Url::toRoute(['del-show','id'=>$showInfo['id']]) ?>" delId="#show_<?= $showInfo['id'] ?>">删除</a>
					</div>
				</div>
				<div class="row">
					<article class="intro-text">
						<p class="intro-title">演出简介</p>
						<p class="intro-main"><?= $showInfo['intro'] ?></p></article>
					<div class="cast-bar">
						<p class="intro-title">演职人员</p>
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
        								<a onclick="timesseat($(this));" timesid="<?= $v['id'] ?>"  url="<?= Url::toRoute(['ticket/timesseat','timesid'=>$v['id']])?>" href="" aria-controls="home" role="tab" data-toggle="tab"><?= date('Y-m-d H:i',$v['stime']) ?></a>
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
    									       for ($i = 0;$i < $val;$i++){
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
					<div class="row col-lg-12" style="text-align:center;">
						<a class="check-seat" href="javascript:;" url="<?= Url::toRoute(['ticket/timesorder'])?>" timesid = "<?= $showTimes[0]['id'] ?>" onclick="timesorderlist($(this));">查看本场订票人信息</a></div>
				</div>
			</section>
		</div>
		<div class="modal fade bs-example-modal-lg" id="check" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  <div class="modal-dialog modal-lg ticket-table-wrap" role="document">
			<div class="modal-content">
				<h3 class="">订票人信息</h3>
				<p>场次：<span id="timestime"><?= date('Y-m-d',$showTimes[0]['stime']).' '.$_week[date('w',$showTimes[0]['stime'])].' '.date('H:i',$showTimes[0]['stime']) ?></span>
				<a href="" target="_link" id="downorder" class="export-seat" >导出列表</a></p>
				<table class="seat-table">
					<tr><th>订单序列号</th><th>座位号</th><th>联系方式</th></tr>
					<tbody id="tiemsorders">
					</tbody>
				</table>
			</div>
		  </div>
		</div>
    </section>
<script>
        var timesseat = function (Obj){
        	var url = Obj.attr('url');
        	$('#timestime').text(Obj.text());
        	var timesid = Obj.attr('timesid');
        	$(".check-seat").attr('timesid',timesid);
        	$.ajax({
        		url:url,
        		success:function (e){
        			$('#seatmap').html(e.html);
        			Obj.parent('li').addClass('active').siblings().removeClass('active');
        			return false;
        		}
        	});
        };

        var timesorderlist = function (Obj) {
        	var url = Obj.attr('url');
        	var timesid = Obj.attr('timesid');
        	var downurl = '<?= Url::toRoute(['ticket/excel'])?>'+'&times_id='+timesid+'&times='+<?= $showTimes[0]['stime'] ?>+'&show_id=<?= $showInfo['id'] ?>';
        	$('#downorder').attr('href',downurl);
        	$.ajax({
        		url:url,
        		data:'times_id='+timesid,
        		success:function (e){
        			$('#tiemsorders').html(e.html);
        			$('#check').modal('show');
        			return false;
        		}
        	});
        };

		var delshow3 = function (obj){
			if(!confirm('你确定要删除吗？')) return false;
			var url = obj.attr('url');
			var delid = obj.attr('delid');
			$.ajax({
				type:'get',
				url	: url,
				success:function (e){
					if(e.status == 200){
						mwlayer.success('删除成功！');
						setTimeout(function () {
							window.location.href="<?= Url::toRoute(['show/index'])?>";
						},2000);

						return false;
					}
					mwlayer.error('删除失败！');
				}
			});
		}
    </script>