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
<link rel="stylesheet" href="kindeditor-4.1.10/themes/default/default.css">
<section class="main padder">
		<div class="col-lg-12" style="margin-top:30px;">
			<section class="panel">
				<header class="panel-heading">
					<div class="row step-bar">
						<?= Html::a('演出管理', ['index'], ['class' => 'top-step']) ?> -
						<a class="top-step" href="javascript::">编辑演出</a>
					</div>
				</header>
				<div class="row main-info">
					<div class="poster intro-post uploader-list" id="fileList">
						<img src="<?= ImageUrl ?><?= $showInfo['cover']??null ?>" id="thumbImgCover">
					</div>
					<a class="post-change" id="filePicker" style="">更改图片</a>
					<style>
					   #filePicker .webuploader-element-invisible{display:none;}
					</style>
				</div>
				<div class="row">
					<form class="theatre-data" id="addshow" action="<?= Url::toRoute(['show/updata']) ?>" method="post">
						<input type="hidden" name="_csrf-admin" id='csrf' value="<?= Yii::$app->request->csrfToken ?>">
						<input type="hidden" name="id" value="<?= $showInfo['id']??null ?>" />
						<input type="hidden" name="cover" value="<?= $showInfo['cover']??null ?>" id="cover"  class="check" emsg="请选择节目封面"/>
						<div class="row col-lg-12">
							<label>演出名称</label><input type="text" class="check theatre-data-input checktitle" emsg="标题不能为空" id="data-name" name="title" value="<?php echo $showInfo['title'] ??null; ?>"></input>
						</div>
						<div class="row col-lg-12"><label>演出时间</label>
							<div class="time-group">
								<?php $timesids = ''; if(isset($showTimes) && $showTimes){?>
    								<?php foreach ($showTimes as $k => $v) { $timesids .= $v['id'].',';?>
    									<div><input type="text" class="time-input-length " name="times_<?= $v['id']?>" value="<?= date('Y-m-d H:i',$v['stime']) ?>" style="margin-bottom:10px;"></input></div>
    								<?php }}else {?>
								<?php }?>
								<input type="hidden" name="timesids" value="<?= $timesids ?>"/>
							</div>
							<div class="add-time-btn">+</div>
							<?php if(!isset($showTimes) || !$showTimes){?>
							<a class="indeterminate">时间待定</a>
							<?php }?>
						</div>
						<div class="row col-lg-12">
							<label>演出时长</label><input type="text"  class="check theatre-data-input" emsg="请填写演出时长" id="data-during" name="duration" value="<?= $showInfo['duration']??null ?>"></input>
							<span>（分钟）</span>
						</div>
						<div class="row col-lg-12">
							<label>演出简介</label><textarea id="data-intro" name=""><?= $showInfo['intro']??null ?></textarea>
							<input type="hidden" name="intro" value="" id="contedit" />
						</div>
						<div class="row col-lg-12">
							<label>演职人员</label>
							<div class="add-cast-list">
								<?php if ($showActors??null) {?>
    								<?php foreach ($showActors as $key => $val){?>
            							<div class="pull-group addActor">
            								<select class="position-one cast-select" name="actor[]">
            									<?php foreach ($actors as $k => $v) {
            									    if($k == $val['actor_id'])
            									        echo '<option value="'.$k.'" selected="true" >'.$v['name'].'</option>';
            									    else
            									        echo '<option value="'.$k.'">'.$v['name'].'</option>';
            									}?>
            								</select>
            								<select class="position-one cast-position" name="duty[]"  onchange="actorshow($(this));">
            									<?php foreach ($dutys as $k => $v){
            									    if($k == $val['duty'])
            									        echo '<option value="'.$k.'" selected="true">'.$v.'</option>';
            									    else
            									        echo '<option value="'.$k.'">'.$v.'</option>';
            									}?>
            								</select>
            								<?php if($val['duty'] == 2){?>
        										<span class='play' style="visibility: visible" >饰&nbsp;<input type="text" class="theatre-data-input" name="act[]" value="<?= $val['act'] ?>"></span>
        									<?php }else {?>
        										<span class='play'><input type="text" class="theatre-data-input" name="act[]" value="<?= $val['act'] ?>">
        									<?php }?>
            							</div>
    							<?php }}else{?>
    								<div class="pull-group addActor">
        								<select class="position-one cast-select" name="actor[]">
        									<option value="0">请选择</option>
        									<?php foreach ($actors as $k => $v) {
        									   echo '<option value="'.$k.'">'.$v['name'].'</option>';
        									}?>
        								</select>
        								<select class="position-one cast-position" name="duty[]" onchange="actorshow($(this));">
        									<option value="0">请选择</option>
        									<?php foreach ($dutys as $k => $v){
        									   echo '<option value="'.$k.'">'.$v.'</option>';
        									}?>
        								</select>
        								<span class="play" style="visibility: visible" ></span>
        							</div>
    							<?php }?>
							</div>
							<div style="padding-left:92px;"><a class="btn btn-small btn-info" onclick="addActor();" style="margin-left:11px;margin-bottom:2px;"><i class="icon-plus"></i> 添加新成员</a></div>
						</div>
					</form>
					<div class="row col-lg-12" style="text-align:center;"><span class="confirm-it" onclick="if(confirm('你确定要发布吗？')){submit();}" href="javascript:;">发布</span></div>
				</div>
			</section>
		</div>
		<script>
			var actorshow = function (Obj){
				if(Obj.val()==2){
					Obj.parent().find(".play").html(' 饰 <input type="text" class=" theatre-data-input" name="act[]">');
					Obj.parent().find(".play").css("visibility","visible");
				}
				else{
					Obj.parent().find(".play").css("visibility","hidden");
					Obj.parent().find(".play").html(' <input type="text" class=" theatre-data-input" name="act[]">');
				}
			};

			var addActor = function () {
				$('.add-cast-list').append($('.add-cast-list div:first-child').clone());
			}
			var submit = function () {
				var title = $('.checktitle').val();
				if(title){
    				$('#contedit').val(editor.html());
    				$("#addshow").submit();
				}else{
					mwlayer.error('标题不能为空！');
					return false;
				}
				//mwForm.check('#addShow');
			}

// 			$(".cast-position").click(function(){
// 				if($(this).val()==0){
// 					$(this).parent().find(".play").css("visibility","visible");
// 				}
// 				else{
// 					$(this).parent().find(".play").css("visibility","hidden");
// 				}
// 			});
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
	
		window.onbeforeunload=function(e){
			var leave = $('body').attr('leaveMsg');
			if(leave=="1"){
		  		return "您创建的演出还未提交，确定要离开吗？";
			}
		};
		$('.data-start-time').daterangepicker({
    		locale: {
    		  format: 'YYYY-MM-DD HH:mm'
    		},
    		singleDatePicker: true,
		    timePicker: true,
		    autoClose:true,
			minDate: moment(),
// 		    timePickerIncrement: 30,
		});
		var inputset = '<div class="one-time-set" ><input type="text" name="time[]" class="time-input-length theatre-data-input" style="margin-bottom:10px;"><a class="del-time">删除</a></div>'
		$(".add-time-btn").click(function(){
    		var len = "time" + $(".time-group input").length;
    		$(".time-group").append(inputset);
		$(".del-time").click(function(){
			$(this).parent().remove();
		})
    		$(".time-group input:last").attr("id",len);
    		$('.time-group input:last').daterangepicker({
    			locale: {
    			  format: 'YYYY-MM-DD HH:mm'
    			},
    			   singleDatePicker: true,
    			   timePicker: true,
				minDate: moment(),
//     			   timePickerIncrement: 30,
    			});
		});
		$(".indeterminate").toggle(
		function(){
			$(this).addClass("indeterminate-sure");
			$(".time-group").hide();
			$(".add-time-btn").hide();
		},
		function(){
			$(this).removeClass("indeterminate-sure");
			$(".time-group").show();
			$(".add-time-btn").show();
		}
		)
		$(".del-time").click(function(){
			$(this).parent().remove();
		})

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
</section>