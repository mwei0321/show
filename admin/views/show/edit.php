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
<link rel="stylesheet" href="js/daterangepicker/daterangepicker.css">
<section class="main padder">
		<div class="col-lg-12" style="margin-top:30px;">
			<section class="panel">
				<header class="panel-heading">
					<div class="row step-bar">
						<?= Html::a('演出管理', ['index','id'=>1], ['class' => 'top-step']) ?> -
						<?= Html::a('编辑演出', ['edit', 'id' =>1], ['class' => 'top-step']) ?>
					</div>
				</header>
				<div class="row main-info">
					<div class="poster intro-post uploader-list" id="fileList">
						<img src="<?= $showInfo['cover']??null ?>" id="thumbImgCover">
						<input type="hidden" name="avatar" value="<?= $showInfo['cover']??null ?>" id="cover"/>
					</div>
					<a class="post-change" id="filePicker" style="">更改图片</a>
				</div>
				<div class="row">
					<form class="theatre-data">
						<div class="row col-lg-12">
							<label>演出名称</label><input type="text" id="data-name" name="title" value="<?php echo $showInfo['title'] ??null; ?>"></input>
						</div>
						<div class="row col-lg-12"><label>演出时间</label>
							<div class="input-group">
								<input type="text" id="data-start-time" name="stime" value="<?= $showInfo['stime']??null ?>" id="data-start-time"></input>
							</div>
						</div>
						<div class="row col-lg-12">
							<label>演出时长</label><input type="text" id="data-during" name="duration" value="<?= $showInfo['duration']??null ?>"></input>
						</div>
						<div class="row col-lg-12">
							<label>演出简介</label><textarea id="data-intro" name="intro"><?= $showInfo['intro']??null ?></textarea>
						</div>
						<div class="row col-lg-12">
							<label>演职人员</label>
							<div class="pull-group" id="showActor">
								<select class="position-one cast-select" name="actor[]">
									<?php foreach ($actors as $k => $v) {
									   echo '<option value="'.$k.'">'.$v['name'].'</option>';
									}?>
								</select>
								<select class="position-one cast-position" name="duty[]">
									<?php foreach ($dutys as $k => $v){
									   echo '<option value="'.$k.'">'.$v.'</option>';
									}?>
								</select>
							</div>
							<a class="btn btn-small btn-info" style="margin-left:11px;margin-bottom:2px;"><i class="icon-plus"></i> 添加新成员</a>
						</div>
					</form>
				</div>
			</section>
		</div>
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
    	        server: '<?= Url::to(['show/uploadeimg']) ?>',

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
//     		        var $li = $(
//     		                '<div id="' + file.id + '" class="file-item thumbnail">' +
//     		                    '<img>' +
//     		                    '<div class="info">' + file.name + '</div>' +
//     		                '</div>'
//     		                ),
//     		            $img = $li.find('img');

//     		        $list.html( $li );
//     		        $('#authoravatar').val(respones.filename);

    		        // 创建缩略图
//     		        uploader.makeThumb( file, function( error, src ) {
//     		            if ( error ) {
//     		                $img.replaceWith('<span>不能预览</span>');
//     		                return;
//     		            }
//     		            $img.attr( 'src', src );
//     		        }, thumbnailWidth, thumbnailHeight );
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
	<script src="/js/daterangepicker/moment.min.js"></script>
	<script src="/js/daterangepicker/daterangepicker.js"></script>
	<script charset="utf-8" src="/kindeditor-4.1.10/kindeditor.js"></script>
	<script>
		$('#data-start-time').daterangepicker({
    		locale: {
    		  format: 'YYYY-MM-DD HH:mm'
    		},
		   timePicker: true,
		   timePickerIncrement: 30,
		});
	</script>
	<script>

	</script>
</section>