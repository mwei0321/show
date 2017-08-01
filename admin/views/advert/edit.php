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
    						<div class="adv-cover-wrap">
    							<div class="adv-cover-show"><img id="thumbImgCover" src="<?php echo ImageUrl,$advertInfo->cover??'' ?>" style="width:320px;"></div>
    							<input type="hidden" name="cover" id="cover" value="<?php echo $advertInfo->cover??'' ?>"/>
    						</div>
    						<div class="adv-cover-operation">
    							<p>图片小于2M你可以上传JPG、JPEG、GIF、PNG或BMP文件。</p>
    							<a class="pick-start-banner post-change" id="filePicker">上传封面</a>
    						</div>
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
  	<script src="kindeditor-4.1.10/lang/zh_CN.js"></script>
	<script>
    	KindEditor.ready(function(K) {
    		window.editor = K.create('#adv-detail',{
    			//height : '700px',
    			resizeType: 0,
    			items:['undo','redo','forecolor','bold','italic','removeformat','justifyleft','justifycenter','justifyright','justifyfull','image'] ,
    		});
    	});
	</script>