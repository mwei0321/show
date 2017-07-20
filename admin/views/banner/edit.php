<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  动态编辑修改显示页
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年2月14日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    use yii\helpers\Html;
    use yii\helpers\Url;

    $this->title = '广告Banner编辑修改';
?>
<section class="main padder">
	<div class="col-lg-12" style="margin-top:30px;">
			<section class="panel">
				<header class="panel-heading">
					<div class="row step-bar">
						<a class="top-step" href="<?= Url::toRoute(['banner/index']) ?>">广告位设置</a><a class="top-step"> - </a>
						<a class="top-step" href="javascript:;">广告编辑</a>
					</div>
				</header>
				<div class="adv-edit-wrap">
					<div class="edit-item">
						<label>广告标题</label><input id="adv-title" type="text" name="title" value="<?php echo $bannerInfo->title??'' ?>">
					</div>
					<div class="edit-item">
						<label>类型</label>
						<select class="banner-type">
							<option value="1">广告</option>
							<option value="1">动态</option>
							<option value="1">演出</option>
						</select>
					</div>
					<div class="edit-item">
						<label>广告封面</label>
						<div class="adv-cover-wrap">
							<div class="adv-cover-show"><img id="thumbImgCover" src="<?php echo ImageUrl,$bannerInfo->imgUrl??'' ?>" style="width:320px;"></div>
							<input type="hidden" name="cover" value="<?php echo $bannerInfo->imgUrl??'' ?>"/>
						</div>
						<div class="adv-cover-operation">
							<p>图片小于2M你可以上传JPG、JPEG、GIF、PNG或BMP文件。</p>
							<a class="pick-start-banner post-change" id="filePicker">上传封面</a>
						</div>
					</div>
					<div class="edit-item">
						<label>广告详情</label>
						<textarea id="adv-detail" ><?php echo $bannerInfo->content??'' ?></textarea>
					</div>
				</div>
			</section>
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
	        server: '<?= Url::to(['banner/uploadeimg']) ?>',

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