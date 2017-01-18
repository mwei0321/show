/**
 * 表单操作js
 * @author MaWei
 * @time 2014-09-08
 */

var mwForm = {};

;(function ($,window,document,underfinded) {
	$.fn.extend(mwForm,{
		//表单不能为空验证
		check : function (fmid,eclass,sclass,check){
			console.log(1111);
			var Obj = check ? check : 'check';
			var i = 0;
			$('.'+check).each(function (e){
				if(! $(this).val()){
					i = 1;
					$(this).addClass('inerror');
					$(this).parent().append('<span class="emsg" style="color:red;">' + $(this).attr('emsg') + '</span>');
//					$(this).blur(function () {
//						$(this).removeClass('inerror').addClass('insuccess');
//					});
				}else{
					$(this).removeClass(eclass).addClass(sclass);
				}
			});
			if(i){
				return false;
			}
			if(fmid){
				$(fmid).submit();
			}else{
				return 1;
			}
		},
		//ajax提交
		ajaxsubmit : function (check,url,param) {
			var ch = mwForm.check(check);
			if(ch){
				var data = '';
				if(param == 'self'){
					$('.'+check).each(function (e){
						data += $(this).attr('name')+'='+$(this).val()+'&';
					});
				}else{
					data = param;
				}
				var redata = null;
				//提交数据
				$.ajax({
					async : false,
					type : 'post',
					url  : url,
					data : data,
					dataType : 'json'
				}).done(function (e) {
					redata = e;
				});
				return redata;
			}
		},
		
		checkemail : function (email) {
			
		},
	});
	
})(jQuery,window,document);
