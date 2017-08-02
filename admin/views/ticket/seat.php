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

    $this->title = '节目演出信息';
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
        								<a onclick="timesseat($(this));" url="<?= Url::toRoute(['ticket/timesseat','timesid'=>$v['id']])?>" timesid="<?= $v['id'] ?>" href="javascript:;" aria-controls="home" role="tab" data-toggle="tab"><?= date('Y-m-d',$v['stime']).' '.$_week[date('w',$v['stime'])].' '.date('H:i',$v['stime']) ?></a>
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
					<div class="row col-lg-12" style="text-align:center;">
						<a class="check-seat" href="javascript:;" url="<?= Url::toRoute(['ticket/timesorder'])?>" timesid = "<?= $times[0]['id'] ?>" onclick="timesorderlist($(this));">查看本场订票人信息</a><a class="confirm-it" href="<?= Url::toRoute(['show/index'])?>">确定</a></div>
				</div>
			</section>
		</div>
		<div class="modal fade bs-example-modal-lg" id="check" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  <div class="modal-dialog modal-lg ticket-table-wrap" role="document">
			<div class="modal-content">
				<h3 class="">订票人信息</h3>
				<p>场次：<span id="timestime"><?= date('Y-m-d',$times[0]['stime']).' '.$_week[date('w',$times[0]['stime'])].' '.date('H:i',$times[0]['stime']) ?></span>
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
			var downurl = '<?= Url::toRoute(['ticket/excel'])?>'+'&times_id='+timesid+'&times='+<?= $times[0]['stime'] ?>+'&show_id=<?= $show_id ?>';
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

		var downloadorder = function (Obj){
			var url = Obj.attr('url');
			var timesid = Obj.attr('timesid');
			var time = Obj.attr('times');
			$.ajax({
				url:url,
				data:'times_id='+timesid+'&time='+time+'&show_id=<?= $show_id ?>',
				success:function (e){
					$('#tiemsorders').html(e.html);
					return false;
				}
			});
		}

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