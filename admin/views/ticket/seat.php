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
    //星期
    $_week = ['周日','周一','周二','周三','周四','周五','周六']

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
        							<li role="presentation" class="<?= $times_id == $v['id'] ? 'active' : '' ?>">
        								<a onclick="timesseat($(this));" url="<?= Url::toRoute(['ticket/timesseat','timesid'=>$v['id']])?>" href="javascript:;" aria-controls="home" role="tab" data-toggle="tab"><?= date('Y-m-d',$v['stime']).' '.$_week[date('w',$v['stime'])].' '.date('H:i',$v['stime']) ?></a>
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
									   $seatId = 0;$seatcode = 0;
									   foreach ($seatNum as $val){
									       echo '<p class="oneset">';
									       $seatcode += $val;
									       $seatId = $seatcode;
									       for ($i = $val;$i > 0;$i--){
                                                echo '<a class="seat ';
                                                if(in_array($seatId, $buyseat)){
                                                    echo 'sold "';
                                                }elseif(in_array($seatId, $reserved)){
                                                    echo ' selected " onclick="lockseat($(this));" url="'.Url::toRoute(['ticket/lock','show_id'=>$show_id,'seat_id'=>$seatId,'tid'=>$times_id]).'"';
                                                }else{
                                                    echo '" onclick="lockseat($(this));" url="'.Url::toRoute(['ticket/lock','show_id'=>$show_id,'seat_id'=>$seatId,'tid'=>$times_id]).'"';
                                                }
	                                            echo ' ></a>';
	                                            $seatId--;
									       }
									       echo '</p>';
									   }
								    ?>
								</div>
							  </div>
							</div>
						</div>
					</div>
					<div class="row col-lg-12" style="text-align:center;"><a class="check-seat" href="<?= Url::toRoute(['show/index'])?>" data-toggle="modal" data-target="#check">查看本场订票人信息</a><a class="confirm-it" href="<?= Url::toRoute(['show/index'])?>">确定</a></div>
				</div>
			</section>
		</div>
		<div class="modal fade bs-example-modal-lg" id="check" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  <div class="modal-dialog modal-lg ticket-table-wrap" role="document">
			<div class="modal-content">
				<h3 class="">订票人信息</h3>
				<p>场次：2016-12-26 周一 19:30 <a class="export-seat">导出列表</a></p>
				<table class="seat-table">
					<tr><th>订单序列号</th><th>座位号</th><th>联系方式</th></tr>
					<tr>
						<td>1</td><td>9排7座 9排8座</td><td>132xxxxxxxx</td>
					</tr>
					<tr>
						<td>1</td><td>9排7座 9排8座</td><td>132xxxxxxxx</td>
					</tr>
					<tr>
						<td>1</td><td>9排7座 9排8座</td><td>132xxxxxxxx</td>
					</tr>
					<tr>
						<td>1</td><td>9排7座 9排8座</td><td>132xxxxxxxx</td>
					</tr>
					<tr>
						<td>1</td><td>9排7座 9排8座</td><td>132xxxxxxxx</td>
					</tr>
					<tr>
						<td>1</td><td>9排7座 9排8座</td><td>132xxxxxxxx</td>
					</tr>
					<tr>
						<td>1</td><td>9排7座 9排8座</td><td>132xxxxxxxx</td>
					</tr>
				</table>
			</div>
		  </div>
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
					return false;
				}
			});
		};

		var lockseat = function (Obj) {
			var url = Obj.attr('url');
				$.ajax({
					url:url,
					success:function (e){
						if(e.status == 1){
							layer.msg('该票已售！');
							windown.location.reload();

						}else if(e.status == 2){
							Obj.removeClass('selected');
						}else{
							Obj.addClass('selected');
						}
					}
				});
			}
    </script>