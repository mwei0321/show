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
	<div class="adver-start-choose">
		<h3>启动页设置</h3>
		<div>
			<div class="start-img-wrap"><img></div>
			<a class="pick-start-banner">更改广告页</a>
		</div>
	</div>
	<div class="adver-table-sort">
		<h3>演出页面顶部广告设置</h3>
		<table width="" border="1">
		  <tbody>
			<tr>
			  <td width="85%">擎动乐享，高圆圆年末巨献</td>
			  <td width="5%"><a href="javascript:void(0)" onclick="moveUp(this)">▲</a></td>
			  <td width="5%"><a href="javascript:void(0)" onclick="moveDown(this)">▼</a></td>
			  <td width="5%"><a class="exchange-adv" href="javascript:void(0)">✎</a></td>
			</tr>
			<tr>
			  <td width="85%">当偶像剧碰上EMOJI</td>
			  <td width="5%"><a href="javascript:void(0)" onclick="moveUp(this)">▲</a></td>
			  <td width="5%"><a href="javascript:void(0)" onclick="moveDown(this)">▼</a></td>
			  <td width="5%"><a class="exchange-adv" href="javascript:void(0)">✎</a></td>
			</tr>
			<tr>
			  <td width="85%">《那年夏天你去了哪里》心劫版预告</td>
			  <td width="5%"><a href="javascript:void(0)" onclick="moveUp(this)">▲</a></td>
			  <td width="5%"><a href="javascript:void(0)" onclick="moveDown(this)">▼</a></td>
			  <td width="5%"><a class="exchange-adv" href="javascript:void(0)">✎</a></td>
			</tr>
			<tr>
			  <td width="85%">自强不吸，抗击雾霾—— 一张表帮你选择空气净化器</td>
			  <td width="5%"><a href="javascript:void(0)" onclick="moveUp(this)">▲</a></td>
			  <td width="5%"><a href="javascript:void(0)" onclick="moveDown(this)">▼</a></td>
			  <td width="5%"><a class="exchange-adv" href="javascript:void(0)">✎</a></td>
			</tr>
			<tr>
			  <td width="85%">FEELUNIQUE助你美美过新年</td>
			  <td width="5%"><a href="javascript:void(0)" onclick="moveUp(this)">▲</a></td>
			  <td width="5%"><a href="javascript:void(0)" onclick="moveDown(this)">▼</a></td>
			  <td width="5%"><a class="exchange-adv" href="javascript:void(0)">✎</a></td>
			</tr>
		  </tbody>
		</table>
		<div class="get-adver">
			<a href="<?= Url::toRoute(['advertisement/advlist']) ?>">查看所有广告>></a>
		</div>
	</div>
	<div class="adver-top-set">
		<h3>详情页面顶部广告设置</h3>
		<div>
			<table width="" border="1">
		  <tbody>
			<tr>
			  <td width="95%">擎动乐享，高圆圆年末巨献</td>
			  <td width="5%"><a href="javascript:void(0)">✎</a></td>
			</tr>
		  </tbody>
		</table>
		</div>
	</div>
	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content adver-list">
			<div class="adv-type">
				<a class="active">广告</a>
				<a>动态</a>
				<a>演出</a>
			</div>
			<ul>
				<li><div class="adver-list-img"><img></div><span style="width:60%;">自强不吸，抗击雾霾—— 一张表帮你选择空气净化器</span><div class="adver-list-btn"><a>选择广告</a></div></li>
				<li><div class="adver-list-img"><img></div><span style="width:60%;">自强不吸，抗击雾霾—— 一张表帮你选择空气净化器</span><div class="adver-list-btn"><a>选择广告</a></div></li>
				<li><div class="adver-list-img"><img></div><span style="width:60%;">自强不吸，抗击雾霾—— 一张表帮你选择空气净化器</span><div class="adver-list-btn"><a>选择广告</a></div></li>
				<li><div class="adver-list-img"><img></div><span style="width:60%;">自强不吸，抗击雾霾—— 一张表帮你选择空气净化器</span><div class="adver-list-btn"><a>选择广告</a></div></li>
				<li><div class="adver-list-img"><img></div><span style="width:60%;">自强不吸，抗击雾霾—— 一张表帮你选择空气净化器</span><div class="adver-list-btn"><a>选择广告</a></div></li>
				<li><div class="adver-list-img"><img></div><span style="width:60%;">自强不吸，抗击雾霾—— 一张表帮你选择空气净化器</span><div class="adver-list-btn"><a>选择广告</a></div></li>
				<li><div class="adver-list-img"><img></div><span style="width:60%;">自强不吸，抗击雾霾—— 一张表帮你选择空气净化器</span><div class="adver-list-btn"><a>选择广告</a></div></li>
				<li><div class="adver-list-img"><img></div><span style="width:60%;">自强不吸，抗击雾霾—— 一张表帮你选择空气净化器</span><div class="adver-list-btn"><a>选择广告</a></div></li>
				<li><div class="adver-list-img"><img></div><span style="width:60%;">自强不吸，抗击雾霾—— 一张表帮你选择空气净化器</span><div class="adver-list-btn"><a>选择广告</a></div></li>
				<li><div class="adver-list-img"><img></div><span style="width:60%;">自强不吸，抗击雾霾—— 一张表帮你选择空气净化器</span><div class="adver-list-btn"><a>选择广告</a></div></li>
				<li><div class="adver-list-img"><img></div><span style="width:60%;">自强不吸，抗击雾霾—— 一张表帮你选择空气净化器</span><div class="adver-list-btn"><a>选择广告</a></div></li>
				<li><div class="adver-list-img"><img></div><span style="width:60%;">自强不吸，抗击雾霾—— 一张表帮你选择空气净化器</span><div class="adver-list-btn"><a>选择广告</a></div></li>
				<li><div class="adver-list-img"><img></div><span style="width:60%;">自强不吸，抗击雾霾—— 一张表帮你选择空气净化器</span><div class="adver-list-btn"><a>选择广告</a></div></li>
				<li><div class="adver-list-img"><img></div><span style="width:60%;">自强不吸，抗击雾霾—— 一张表帮你选择空气净化器</span><div class="adver-list-btn"><a>选择广告</a></div></li>
				<li><div class="adver-list-img"><img></div><span style="width:60%;">自强不吸，抗击雾霾—— 一张表帮你选择空气净化器</span><div class="adver-list-btn"><a>选择广告</a></div></li>
			</ul>
		</div>
	  </div>
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