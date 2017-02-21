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
        							<li role="presentation" class="<?= $times_id == $v['id'] ? 'active' : '' ?>">
        								<a onclick="timesseat($(this));" url="<?= Url::toRoute(['ticket/timesseat','timesid'=>$v['id']])?>" href="javascript:;" aria-controls="home" role="tab" data-toggle="tab"><?= date('Y-m-d H:i',$v['stime']) ?></a>
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
                                                echo '<a class="seat ';
                                                if(in_array($seatId, $buyseat)){
                                                    echo 'sold "';

                                                }elseif(in_array($seatId, $reserved)){
                                                    echo ' selected " onclick="lockseat($(this));" ';
                                                }else{
                                                    echo '" onclick="lockseat($(this));" ';
                                                }
	                                            echo 'url="'.Url::toRoute(['ticket/lock','show_id'=>$show_id,'seat_id'=>$seatId,'tid'=>$times_id]).'" href="javascript:;"></a>';
									       }
									       echo '</p>';
									   }
								    ?>
								</div>
							  </div>
							</div>
						</div>
					</div>
					<div class="row col-lg-12" style="text-align:center;"><a class="confirm-it" href="<?= Url::toRoute(['show/index'])?>">确定</a></div>
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