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
<link rel="stylesheet" href="js/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="css/loaders.css">
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
					<div class="row col-lg-12"><label>姓名</label><input type="text" id="data-cast-name" name="name" value="<?= $ActorInfo['name'] ??null?>" class="check checktitle" emsg="名称不能为空"></input></div>
					<div class="row col-lg-12"><label>性别</label>
						<select class="gender"  name="gender" class="check">
							<?php if(isset($ActorInfo['gender'])){
							    echo '<option value="1" '.($ActorInfo['gender'] ? 'selected="selected"':'').'>男</option>';
							    echo '<option value="0" '.($ActorInfo['gender'] == 0 ? 'selected="selected"':'').'>女</option>';
							}else{?>

							<option value="1">男</option>
							<option value="0">女</option>
							<?php }?>
						<select>
					</div>
					<div class="row col-lg-12"><label>星座</label><input type="text" id="data-cast-sigh"  name="constellation" value="<?= $ActorInfo['constellation'] ??null?>" class="check theatre-data-input"></input></div>
					<div class="row col-lg-12"><label>出生日期</label><input type="text" id="data-cast-birth"  name="birthday" value="<?= $ActorInfo['birthday'] ??null?>" class="check theatre-data-input"></input></div>
					<div class="row col-lg-12"><label>出生地</label><input type="text" id="data-cast-land"  name="address" value="<?= $ActorInfo['address'] ??null?>" class="check theatre-data-input"></input></div>
					<div class="row col-lg-12"><label>上传图片</label>
						<div id="uploader-demo">
							<div class="upload-loading-wrap">
								<div class="loader">
								<div class="loader-inner line-scale">
								  <div></div>
								  <div></div>
								  <div></div>
								  <div></div>
								  <div></div>
								</div>
							  </div>
							</div>
							<!--用来存放item-->
							<div id="fileList" class="uploader-list"></div>
							<div class="file-photo" id="filePicker2">上传图片</div>
							<div id="photolist"></div>
						</div>
					</div>
					<div class="row col-lg-12">
						<label>个人简介</label><textarea id="data-intro"  name="" class="check"><?= $ActorInfo['intro'] ??null?></textarea>
						<input type="hidden" name="intro" value="" id="contedit" class="check"/>
					</div>
					<div class="row col-lg-12" style="text-align:center;">
						<a class="confirm-it" id="confirm-actor" href="javascript:;" isup="1" onclick="actorup($(this));" url="<?= Url::toRoute(['actor/update'])?>">提交修改</a>
					</div>
				</form>
			</div>
		</section>
	</div>
<script type="text/javascript">
	var actorup = function(Obj){
		if(uploader2.getStats().progressNum == 0){
			fromData2(Obj,'#artorSubmit',modifyMsgJump);
		}else{
			alert('照片还没有上传完成！');
			return false;
		}
	}
</script>
</section>
	<script src="/js/webuploader.html5only.js" type="text/javascript" charset="utf-8"></script>
	<script src="/js/daterangepicker/moment.min.js"></script>
	<script src="/js/daterangepicker/daterangepicker.js"></script>

    <script>
    	// 图片上传demo

		window.onbeforeunload=function(e){
			var leave = $('body').attr('leavemsg');
			if(leave=="1"){
		  		return "您创建的演出还未提交，确定要离开吗？";
			}
		};
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
				
				fileSingleSizeLimit: 2*1024*1024 ,
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

		$('#data-cast-birth').daterangepicker({
    		locale: {
    		  format: 'YYYY-MM-DD'
    		},
    		singleDatePicker: true,
		    autoClose:true,
			maxDate: moment(),
			showDropdowns: true,
			// autoUpdateInput: false,
// 		    timePickerIncrement: 30,
		})
    	});
		//相册
		var $ = jQuery,
        $list = $('#fileList');
		var uploader2 = WebUploader.create({

			// 选完文件后，是否自动上传。
			auto: true,

			// swf文件路径
			swf: '/js/Uploader.swf',

			// 文件接收服务端。
			server: '<?= Url::toRoute(['actor/uploadeimg']) ?>',

			// 选择文件的按钮。可选。
			// 内部根据当前运行是创建，可能是input元素，也可能是flash.
			pick: '#filePicker2',
			
			fileSingleSizeLimit: 2*1024*1024 ,

			// 只允许选择图片文件。
			accept: {
				title: 'Images',
				extensions: 'gif,jpg,jpeg,bmp,png',
				mimeTypes: 'image/*'
			},
			//'

		});
		uploader2.on("error",function (type){
			if (type=="Q_TYPE_DENIED"){
				alert("请上传正确格式文件");
			}else if(type=="F_EXCEED_SIZE"){
				alert("文件大小不能超过2M");
			}
		});
	    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
	    uploader2.on( 'uploadSuccess', function( file,respones ) {
	    	if(respones.status == 200){
				$("#confirm-actor").attr("isup","1");
		    	var html = '<input type="hidden" value="'+respones.imgPath+'" name="photo[]" />';
				$('#photolist').append(html);
	    	}



			//上传图片仍队列中的数量，0为上传完成；
			console.log(uploader2.getStats().progressNum);
			if(uploader2.getStats().progressNum == "0"){
				$(".upload-loading-wrap").hide();
			}
	    });
		
		// 文件上传成功，给item添加成功class, 用样式标记上传成功。
	    uploader2.on( 'uploadStart', function( file,respones ) {
	    	$(".upload-loading-wrap").show();
	    });

		// 文件上传中，给item添加成功class, 用样式标记上传成功。
		uploader2.on( 'uploadProgress', function( file,respones ) {
			// $("#confirm-actor").attr("isup","0");
			// $("#confirm-actor").html("正在上传")
		});

		uploader2.on( 'fileQueued', function( file ) {
			var $li = $(
					'<div id="' + file.id + '" class="file-item thumbnail">' +
						'<img>' +
						'<div class="info">' + file.name + '</div>' +
					'</div>'
					),
				$img = $li.find('img');


			// $list为容器jQuery实例
			$list.append( $li );

			// 创建缩略图
			// 如果为非图片文件，可以不用调用此方法。
			// thumbnailWidth x thumbnailHeight 为 100 x 100
			uploader2.makeThumb( file, function( error, src ) {
				if ( error ) {
					$img.replaceWith('<span>不能预览</span>');
					return;
				}

				$img.attr( 'src', src );
			}, 100, 100 );
		});
    </script>

    	<script src="kindeditor-4.1.10/kindeditor-min.js"></script>
  	<script src="kindeditor-4.1.10/lang/zh_CN.js"></script>
	<script>
    	KindEditor.ready(function(K) {
    		window.editor = K.create('#data-intro',{
    			//height : '700px',
    			resizeType: 0,
    			items:['undo','redo','forecolor','bold','italic','removeformat','justifyleft','justifycenter','justifyright','justifyfull'] ,
    		});
    	});
	</script>