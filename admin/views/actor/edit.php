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
					<a class="top-step" href="<?= Url::toRoute(['actor/index'])?>">演职员管理</a><a class="top-step" > - </a>
					<a class="top-step" href="javascript:;">编辑资料</a>
				</div>
			</header>
			<div class="row main-info">
				<div class="poster intro-post"><img src="<?= ImageUrl.($ActorInfo['avatar']??null) ?>" id="thumbImgCover"></div>
				<div class="avatar-btn-group">
					<p class="avatar-tips">图片小于2M你可以上传JPG、JPEG、GIF、PNG或BMP文件。</p>
					<a class="post-change" id="filePicker" style="">上传封面</a>
				</div>
			</div>
			<div class="row">
				<form class="cast-data" id="artorSubmit">
					<input type="hidden" value="<?= $ActorInfo['avatar']??null ?>" id="avatar" name="avatar" class="check"/>
					<input type="hidden" name="_csrf-admin" id='csrf' value="<?= Yii::$app->request->csrfToken ?>" class="check">
					<input type="hidden" name="actor_id" value="<?= $ActorInfo['id'] ?? null ?>" class="check"/>
					<div class="row col-lg-12"><label>姓名</label><input type="text" id="data-cast-name" name="name" value="<?= $ActorInfo['name'] ??null?>" class="check"></input></div>
					<div class="row col-lg-12"><label>性别</label>
						<select class="gender"  name="gender" class="check">
							<?php if(isset($ActorInfo['gender'])){
							    echo '<option value="1" '.($ActorInfo['gender'] ? 'select="selected"':'').'>男</option>';
							    echo '<option value="0" '.($ActorInfo['gender'] == 0 ? 'select="selected"':'').'>女</option>';
							}else{?>

							<option value="1">男</option>
							<option value="0">女</option>
							<?php }?>
						<select>
					</div>
					<div class="row col-lg-12"><label>星座</label><input type="text" id="data-cast-sigh"  name="constellation" value="<?= $ActorInfo['constellation'] ??null?>" class="check theatre-data-input"></input></div>
					<div class="row col-lg-12"><label>出生日期</label><input type="text" id="data-cast-birth"  name="birthday" value="<?= $ActorInfo['birthday'] ??null?>" class="check theatre-data-input"></input></div>
					<div class="row col-lg-12"><label>出生地</label><input type="text" id="data-cast-land"  name="address" value="<?= $ActorInfo['address'] ??null?>" class="check theatre-data-input"></input></div>
					<div class="row col-lg-12">
						<label>个人简介</label><textarea id="data-intro"  name="" class="check"><?= $ActorInfo['content'] ??null?></textarea>
						<input type="hidden" name="intro" value="<?= $ActorInfo['content'] ??null?>" id="contedit" />
					</div>
					<div class="row col-lg-12" style="text-align:center;">
						<a class="confirm-it" href="javascript:;" onclick="fromData2($(this),'#artorSubmit',modifyMsgJump);" url="<?= Url::toRoute(['actor/update'])?>">提交修改</a>
					</div>
				</form>
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
    	        server: '<?= Url::toRoute(['actor/uploadeimg']) ?>',

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
        	    	$("#avatar").val(respones.imgPath);
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

    	<script src="kindeditor-4.1.10/kindeditor-min.js"></script>
  	<script src="kindeditor-4.1.10/lang/zh_CN.js"></script>
	<script>
    	KindEditor.ready(function(K) {
    		window.editor = K.create('#data-intro',{
    			//height : '700px',
    			resizeType: 0,
    			items:['undo','redo','forecolor','bold','italic','removeformat','justifyleft','justifycenter','justifyright','justifyfull','image'] ,
    		});
    	});
	</script>