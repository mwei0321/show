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

    $this->title = '广告管理';

?>
<section class="main padder">
	<div class="col-lg-12" style="margin-top:30px;">
			<section class="panel">
				<header class="panel-heading">
					<div class="row step-bar">
						<a class="top-step" href="<?= Url::toRoute(['advertisement/manager']) ?>">广告位设置</a><a class="top-step"> - </a>
						<a class="top-step" href="javascript:;">广告编辑</a>
					</div>
				</header>
				<div class="adv-edit-wrap">
					<div class="edit-item">
						<label>广告标题</label><input id="adv-title">
					</div>
					<div class="edit-item">
						<label>广告封面</label>
						<div class="adv-cover-wrap">
							<div class="adv-cover-show"><img src=""></div>
						</div>
						<div class="adv-cover-operation">
							<p>图片小于2M你可以上传JPG、JPEG、GIF、PNG或BMP文件。</p>
							<div style="margin-top:26px;"><input type="file" value="上传封面"></div>
						</div>
					</div>
					<div class="edit-item">
						<label>广告详情</label>
						<textarea id="adv-detail" ></textarea>
					</div>
				</div>
			</section>
		</div>
</section>
<script>
	function moveUp(_a){
	var _row = _a.parentNode.parentNode;
	//如果不是第一行，则与上一行交换顺序
	var _node = _row.previousSibling;
	while(_node && _node.nodeType != 1){
	_node = _node.previousSibling;
	}
	if(_node){
	swapNode(_row,_node);
	}
	}
	function moveDown(_a){
	var _row = _a.parentNode.parentNode;
	//如果不是最后一行，则与下一行交换顺序
	var _node = _row.nextSibling;
	while(_node && _node.nodeType != 1){
	_node = _node.nextSibling;
	}
	if(_node){
	swapNode(_row,_node);
	}
	}
	function swapNode(node1,node2){
	//获取父结点
	var _parent = node1.parentNode;
	//获取两个结点的相对位置
	var _t1 = node1.nextSibling;
	var _t2 = node2.nextSibling;
	//将node2插入到原来node1的位置
	if(_t1)_parent.insertBefore(node2,_t1);
	else _parent.appendChild(node2);
	//将node1插入到原来node2的位置
	if(_t2)_parent.insertBefore(node1,_t2);
	else _parent.appendChild(node1);
	}
	
	$(".exchange-adv").click(function(){
		$('.bs-example-modal-lg').modal('show');
	})
	$(".adver-top-set a").click(function(){
		$('.bs-example-modal-lg').modal('show');
	})
</script>