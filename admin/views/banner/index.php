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
    $this->title = '广告首页';
?>
<section class="main padder">
	<div class="adver-start-choose">
		<h3>启动页设置</h3>
		<div>
			<div class="start-img-wrap"><img id="thumbImgCover" src="<?= ImageUrl.$startlogo->path ?>" style="width:240px"></div>
			<a class="pick-start-banner post-change" id="filePicker">更改广告页</a>
			<p class="avatar-tips">图片小于2M你可以上传JPG、JPEG、GIF、PNG或BMP文件。</p>
		</div>
	</div>
	<div class="adver-table-sort">
		<h3>演出页面顶部广告设置</h3>
		<table width="" border="1">
		  <tbody id="bannerlist">
		    <?php foreach ($banner as $k => $v){?>
    			<tr banid="<?= $v['banner_id'] ?>">
    			  <td width="85%"><?= $v['title'] ?></td>
    			  <td width="5%"><a href="javascript:void(0)" onclick="moveUp(this)">▲</a></td>
    			  <td width="5%"><a href="javascript:void(0)" onclick="moveDown(this)">▼</a></td>
    			  <td width="5%"><a class="exchange-adv" banner_id="<?= $v['banner_id'] ?>" href="javascript:void(0)">✎</a></td>
    			</tr>
			<?php }?>
		  </tbody>
		</table>
		<div class="get-adver">
			<a href="<?= Url::toRoute(['banner/advlist']) ?>">查看所有广告>></a>
		</div>
	</div>
	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content adver-list">
			<ul class="adv-type" role="tablist">
				<li role="presentation" class="active"><a class="active"  href="#adv" aria-controls="adv" role="tab" data-toggle="tab">广告</a></li>
				<li role="presentation"><a href="#dynamic" aria-controls="profile" role="tab" data-toggle="tab">动态</a></li>
				<li role="presentation"><a href="#show" aria-controls="profile" role="tab" data-toggle="tab">演出</a></li>
			</ul>
			<div class="tab-content">
				<!-- 广告 -->
				<div role="tabpanel" class="tab-pane active" id="adv">
				<ul>
					<?php foreach ($advert as $k => $v){?>
						<li><div class="adver-list-img"><img src="<?= ImageUrl,$v['cover'] ?>"></div><span style="width:60%;"><?= $v['title'] ?></span><div class="adver-list-btn">
						<a onclick="changebanner($(this),1,<?= $v['id'] ?>)" class="replacebanner" replaceid = "2">选择广告</a></div></li>
					<?php }?>
				</ul>
				</div>
				<!-- 动态 -->
				<div role="tabpanel" class="tab-pane" id="dynamic">
				<ul role="tabpanel" id="dynamic">
					<?php foreach ($dynamic as $k => $v){?>
						<li><div class="adver-list-img"><img src="<?= ImageUrl,$v['cover'] ?>"></div><span style="width:60%;"><?= $v['title'] ?></span><div class="adver-list-btn">

						<a onclick="changebanner($(this),2,<?= $v['id'] ?>)" class="replacebanner" replaceid = "2">选择广告</a></div></li>
					<?php }?>
				</ul role="tabpanel" id="show">
				</div>
				<!-- 演出 -->
				<div role="tabpanel" class="tab-pane" id="show">
				<ul>
					<?php foreach ($show as $k => $v){?>
						<li><div class="adver-list-img"><img src="<?= ImageUrl,$v['cover'] ?>"></div><span style="width:60%;"><?= $v['title'] ?></span><div class="adver-list-btn">

						<a onclick="changebanner($(this),3,<?= $v['id'] ?>)" class="replacebanner" replaceid = "2">选择广告</a></div></li>
					<?php }?>
				</ul>
				</div>
			</div>
		</div>
	  </div>
	</div>

</section>

<script src="/js/webuploader.custom.min.js" type="text/javascript" charset="utf-8"></script>
    <script>
    	// 图片上传demo
    	jQuery(function() {
    	    var $ = jQuery,
    	        $list = $('#fileList'),
    	        // 优化retina, 在retina下这个值是2
    	        ratio = window.devicePixelRatio || 1,

    	        // 缩略图大小
    	        thumbnailWidth = 100 * ratio,
    	        thumbnailHeight = 100 * ratio,

    	        // Web Uploader实例
    	        uploader;

    	    // 初始化Web Uploader
    	    uploader = WebUploader.create({

    	        // 自动上传。
    	        auto: true,

    	        // swf文件路径
    	        swf: '/js/Uploader.swf',

    	        // 文件接收服务端。
    	        server: '<?= Url::to(['banner/upstartlogo']) ?>',

    	        // 选择文件的按钮。可选。
    	        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
    	        pick: '#filePicker',
    	        //文件下标名
    	        fileVal:'file',

    	        // 只允许选择文件，可选。
    	        accept: {
    	            title: 'Images',
    	            extensions: 'gif,jpg,jpeg,bmp,png',
    	            mimeTypes: 'image/*'
    	        }
    	    });

    	    // 当有文件添加进来的时候
    	    uploader.on( 'fileQueued', function( file ) {

    	    });


    	    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    	    uploader.on( 'uploadSuccess', function( file,respones ) {
    	    	if(respones.status == 200){
        	    	$("#thumbImgCover").attr('src',respones.path);
        	    	$("#cover").val(respones.imgPath);
    	    	}
    	    	console.log(respones);
    	    });

    	    // 文件上传失败，现实上传出错。
    	    uploader.on( 'uploadError', function( file ) {
    	        var $li = $( '#'+file.id ),
    	            $error = $li.find('div.error');

    	        // 避免重复创建
    	        if ( !$error.length ) {
    	            $error = $('<div class="error"></div>').appendTo( $li );
    	        }

    	        $error.text('上传失败');
    	    });
    	});
    </script>
<script>
	function setSort(){
		var sort = '0';
		$('#bannerlist > tr').each(function (e){
			sort = sort+','+$(this).attr('banid');
		});
    	$.ajax({
    		type:"GET",
    		data:'sort='+sort,
    		url :'<?= Url::to(['banner/sort']) ?>',
    		success:function(e){
    			if(e.status == 200){
					return 1;
    			}else
        			return 0;
    		}
    	});
	}

	var changebanner = function (obj,type,id){
			var replayId = obj.attr('replaceid');
			$.ajax({
				type:'post',
				data:'type='+type+'&id='+id+'&replayid='+replayId,
				url :'<?= Url::to(['banner/changebanner']) ?>',
				success:function (e){
					window.location.reload();
				}
			});
		}
</script>
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

	setSort();
	}

	$(".exchange-adv").click(function(){
		$('.bs-example-modal-lg').modal('show');
		var banner_id = $(this).attr('banner_id');
		$('.replacebanner').attr('replaceid',banner_id);
	})
	$(".adver-top-set a").click(function(){
		$('.bs-example-modal-lg').modal('show');
	})
	$(".adv-type a").click(function(){
		$(".adv-type a").removeClass("active");
		$(this).addClass("active");
	})
</script>
