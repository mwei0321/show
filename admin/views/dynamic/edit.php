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

    $this->title = '动态编辑修改';
?>
<section class="main padder">
		<div class="col-lg-12" style="margin-top:30px;">
			<section class="panel">
				<header class="panel-heading">
					<div class="row step-bar">
						<a class="top-step" href="cast.html">剧场动态管理</a><a class="top-step" > - </a><a class="top-step" >编辑动态</a>
					</div>
				</header>
				<div class="row main-info">
					<div class="poster intro-post"><img src="<?= ImageUrl ?><?= $dynamicInfo['cover']??null ?>" id="thumbImgCover"></div>
					<div class="avatar-btn-group">
						<p class="avatar-tips">图片小于2M你可以上传JPG、JPEG、GIF、PNG或BMP文件。</p>
						<a class="post-change" id="filePicker" style="">上传封面</a>
					</div>
					<input type="hidden" value="<?= $dynamicInfo['cover']??null ?>" id="cover" name="cover" class="check"/>
				</div>
				<div class="row">
					<form class="dynamic-data">
						<input type="hidden" name="_csrf-admin" id='csrf' value="<?= Yii::$app->request->csrfToken ?>" class="check">
						<input type="hidden" name="dyid" value="<?= $dynamicInfo['id'] ?? null ?>" class="check"/>
						<div class="row col-lg-12"><label>标题</label><input type="text" id="dynamic-title" name="title" class="check"></input></div>
						<div class="row col-lg-12">
							<label>详情</label><textarea id="data-intro" name="content" class="check"></textarea>
						</div>
						<div class="row col-lg-12" style="text-align:center;">
						<a class="confirm-it" href="javascript:;" onclick="fromData($(this),'.check',dynamic);" url="<?= Url::toRoute(['dynamic/update'])?>">发布</a></div>
					</form>
				</div>
			</section>
		</div>

    </section>
	<script type="text/javascript">

	</script>
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
    	        server: '<?= Url::to(['dynamic/uploadeimg']) ?>',

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