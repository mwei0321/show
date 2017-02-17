  /**
 * @date:2017-01-08
 * @author:MaWei
 * @后台共用js
 */

var delshow = function (obj){
	var url = obj.attr('url');
	var delid = obj.attr('delid');
	$.ajax({
		type:'get',
		url	: url,
		success:function (e){
			if(e.status == 200){
				mwlayer.success('删除成功！');
				$(delid).remove();
				return false;
			}
			mwlayer.error('删除失败！');
		}
	});
}

//删除动态
var deldynamic = function (e){
	mwlayer.msg(e.msg,e.status);
	setTimeout(function () {
		window.location.href=e.url;
	},2000);
}

//删除
var delById = function (Obj,callback,data){
	var url = Obj.attr('url');
	ajaxRequest(url,data,callback);
}

//ajax
var ajaxRequest = function (url,data,callback){
	$.ajax({
		type : 'post',
		url  : url,
		data : data,
		dataType : 'json'
	}).done(function (reData) {
			callback(reData);
	});
}

//from提交
var fromData = function(Obj,from,callback){
	var data = $(from).serialize();
	var url = Obj.attr('url');
	ajaxResquest(url,data,callback);
}

//动态添加、修改回调函数
var dynamic = function (e){
	mwlayer.msg(e.msg,e.status);
	if(e.status == 200){
		setTimeout(function () {
			window.location.href=e.url;
		},2000);
	}
}

/**
 * 演出节目编辑-添加时间输入框
 */
var addTimes = function (){
	var timesHtml = '<input type="text" class="check" id="data-start-time" name="time" />'
	$('#showtimes').append(timesHtml);
}
