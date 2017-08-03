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
<link href="/css/cropper.min.css" rel="stylesheet"/>
<link href="/css/main.css" rel="stylesheet"/>
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
				<form id="advertf">
					<div class="edit-item">
						<label>广告标题</label>
						<input id="adv-title" type="text" name="title" class="checktitle" emsg="标题不能为空" value="<?php echo $advertInfo->title??'' ?>">
					</div>
					<div class="edit-item">
						<label>广告封面</label>
						<!--<div class="adv-cover-wrap">
							<div class="adv-cover-show"><img id="thumbImgCover" src="<?php echo ImageUrl,$advertInfo->cover??'' ?>" style="width:320px;"></div>
							<input type="hidden" name="cover" id="cover" value="<?php echo $advertInfo->cover??'' ?>"/>
						</div>
						<div class="adv-cover-operation">
							<p>图片小于2M你可以上传JPG、JPEG、GIF、PNG或BMP文件。</p>
							<a class="pick-start-banner post-change" id="" data-toggle="modal" data-target="#banner-window">上传封面</a>
						</div>-->
						
					</div>
					<div class="edit-item">
						<label>广告详情</label>
						<textarea id="adv-detail" ><?php echo $advertInfo->content??'' ?></textarea>
						<input type="hidden" name="content" value="" id="contedit" class="check" />
					</div>
					<div class="row col-lg-12" style="text-align:center;">
						<input type="hidden" name="advert_id" value="<?php echo $advertInfo->id?? '' ?>"/>
						<a class="confirm-it draft-it" href="javascript:;" onclick="fromData2($(this),'#advertf',modifyMsgJump);" url="<?= Url::toRoute(['advert/updata'])?>">发布</a>
					</div>
				</form>
			</div>
		</section>
	</div>
		<div class="container" id="crop-avatar">
            
            <!-- Current avatar -->
            <div style="text-align:center;color:red;margin:50px 0">提示：点击头像上传</div>
            <div class="avatar-view" title="Change the avatar">
                <img src="img/picture.jpg" alt="Avatar"/>
            </div>

            <!-- Cropping modal -->
            <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form class="avatar-form" action="crop.php" enctype="multipart/form-data" method="post">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal" type="button">&times;</button>
                                <h4 class="modal-title" id="avatar-modal-label">更换头像</h4>
                            </div>
                            <div class="modal-body">
                                <div class="avatar-body">

                                    <!-- Upload image and data -->
                                    <div class="avatar-upload">
                                        <input class="avatar-src" name="avatar_src" type="hidden"/>
                                        <input class="avatar-data" name="avatar_data" type="hidden"/>
                                        <label for="avatarInput">头像上传</label>
                                        <input class="avatar-input" id="avatarInput" name="avatar_file" type="file"/>
                                    </div>

                                    <!-- Crop and preview -->
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="avatar-wrapper"></div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="avatar-preview preview-lg"></div>
                                            <div class="avatar-preview preview-md"></div>
                                            <div class="avatar-preview preview-sm"></div>
                                        </div>
                                    </div>

                                    <div class="row avatar-btns">
                                        <div class="col-md-9">
                                            <div class="btn-group">
                                                <button class="btn btn-primary" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees">Rotate Left</button>
                                                <button class="btn btn-primary" data-method="rotate" data-option="-15" type="button">-15deg</button>
                                                <button class="btn btn-primary" data-method="rotate" data-option="-30" type="button">-30deg</button>
                                                <button class="btn btn-primary" data-method="rotate" data-option="-45" type="button">-45deg</button>
                                            </div>
                                            <div class="btn-group">
                                                <button class="btn btn-primary" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees">Rotate Right</button>
                                                <button class="btn btn-primary" data-method="rotate" data-option="15" type="button">15deg</button>
                                                <button class="btn btn-primary" data-method="rotate" data-option="30" type="button">30deg</button>
                                                <button class="btn btn-primary" data-method="rotate" data-option="45" type="button">45deg</button>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-primary btn-block avatar-save" type="submit">Done</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="modal-footer">
                              <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                            </div> -->
                        </form>
                    </div>
                </div>
            </div><!-- /.modal -->

            <!-- Loading state -->
            <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
        </div>
	<div class="modal fade" id="banner-window" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-lg">
				 <div class="modal-content">
					<form class="avatar-form" action="crop.php" enctype="multipart/form-data" method="post">
						<div class="modal-header">
							<button class="close" data-dismiss="modal" type="button">&times;</button>
							<h4 class="modal-title" id="avatar-modal-label">更换头像</h4>
						</div>
						<div class="modal-body">
							<div class="avatar-body">

								<!-- Upload image and data -->
								<div class="avatar-upload">
									<input class="avatar-src" name="avatar_src" type="hidden"/>
									<input class="avatar-data" name="avatar_data" type="hidden"/>
									<label for="avatarInput">头像上传</label>
									<input class="avatar-input" id="avatarInput" name="avatar_file" type="file"/>
								</div>

								<!-- Crop and preview -->
								<div class="row">
									<div class="col-md-9">
										<div class="avatar-wrapper"></div>
									</div>
									<div class="col-md-3">
										<div class="avatar-preview preview-lg"></div>
									</div>
								</div>

								<div class="row avatar-btns">
									<div class="col-md-3">
										<button class="btn btn-primary btn-block avatar-save" type="submit">Done</button>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="modal-footer">
						  <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
						</div> -->
					</form>
				</div>
			</div>
		</div><!-- /.modal -->
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
	        server: '<?= Url::to(['advert/uploadeimg']) ?>',

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
    	<script src="kindeditor-4.1.10/kindeditor.js"></script>
        <script src="/js/cropper.min.js"></script>
        <script src="/js/main.js"></script>
  	<script src="kindeditor-4.1.10/lang/zh_CN.js"></script>
	<script>
    	KindEditor.ready(function(K) {
    		window.editor = K.create('#adv-detail',{
    			//height : '700px',
    			resizeType: 0,
    			items:['undo','redo','forecolor','bold','italic','removeformat','justifyleft','justifycenter','justifyright','justifyfull','image','link'] ,
    		});
    	});
		
	</script>