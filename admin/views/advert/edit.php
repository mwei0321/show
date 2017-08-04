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
				<!--<form id="advertf">-->

					<div class="edit-item">
						<label>广告标题</label>
						<input id="adv-title" type="text" name="title" class="checktitle" emsg="标题不能为空" value="<?php echo $advertInfo->title??'' ?>">
					</div>
					<div class="edit-item">
						<label>广告封面</label>
					
						<input type="hidden" name="cover" value="<?= $advertInfo->cover??'' ?>" id="adv-cover"/>
						<div class="container" id="crop-avatar">

            <!-- Current avatar -->
            <div style="color:red;">提示：点击图片上传</div>
            <div class="avatar-view" title="Change the avatar">
                <img src="<?= ImageUrl,$advertInfo->cover??'' ?>" alt="Avatar"/>
            </div>

            <!-- Cropping modal -->
            <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form class="avatar-form" action="<?= Url::toRoute('upcropimg')?>" enctype="multipart/form-data" method="post">
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

            <!-- Loading state -->
            <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
        </div>
					</div>

					<div class="edit-item">
						<label>广告详情</label>
						<textarea id="adv-detail" ><?php echo $advertInfo->content??'' ?></textarea>
						<input type="hidden" name="content" value="" id="contedit" class="check" />
					</div>
					<div class="row col-lg-12" style="text-align:center;">
						<input type="hidden" name="advert_id" id="adv-id" value="<?php echo $advertInfo->id?? '' ?>"/>
						<a class="confirm-it draft-it" href="javascript:;" onclick="advertsubmit($(this));" url="<?= Url::toRoute(['advert/updata'])?>">发布</a>
					</div>
				<!--</form>-->

			</div>
		</section>
		</div>
		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	  <div class="modal-dialog modal-lg banner-window" role="document">
		<div class="modal-content adver-list">

		</div>
	  </div>
            <!-- Loading state -->
            <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
        </div>
		<div class="modal fade" id="banner-window" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-lg">
				 <div class="modal-content">
					<form class="avatar-form" action="crop.php" enctype="multipart/form-data" method="post">
						<div class="modal-header">
							<button class="close" data-dismiss="modal" type="button">&times;</button>
							<h4 class="modal-title" id="avatar-modal-label">更换图片</h4>
						</div>
						<div class="modal-body">
							<div class="avatar-body">

								<!-- Upload image and data -->
								<div class="avatar-upload">
									<input class="avatar-src" name="avatar_src" type="hidden"/>
									<input class="avatar-data" name="avatar_data" type="hidden"/>
									<label for="avatarInput">图片上传</label>
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
<script type="text/javascript">

</script>

<script src="/js/webuploader.custom.min.js" type="text/javascript" charset="utf-8"></script>
<script>
	// 图片上传demo
var advertsubmit = function (Obj){
	var title = $('#adv-title').val();
	if(!title){
		mwlayer.error(checkObj.attr('emsg'));
		return false
	}
	var id = $('#adv-id').val();
	var cover = $('#adv-cover').val();
	var content = editor.html();
	$.ajax({
		type:'post',
		url : Obj.attr('url'),
		data:'title='+title+'&cover='+cover+'&content='+content+'&advert_id='+id,
		success:function(e){
			mwlayer.msg(e.msg,e.status);
			if(e.status == 200){
				$('body').attr('leaveMsg',0);
				setTimeout(function () {
					window.location.href='<?= Url::toRoute('index') ?>';
				},2000);
			}
		}
	});
}

		window.onbeforeunload=function(e){
			var leave = $('body').attr('leaveMsg');
			if(leave=="1"){
		  		return "您创建的演出还未提交，确定要离开吗？";
			}
		};
	
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