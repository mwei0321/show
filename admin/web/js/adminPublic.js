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

/**
 * 演出节目编辑-添加时间输入框
 */
var addTimes = function (){
	var timesHtml = '<input type="text" class="check" id="data-start-time" name="time" />'
	$('#showtimes').append(timesHtml);
}
