/**
 * @author MaWei
 * @time 2014-08-26
 * @home http://www.phpyrb.com
 */
var mwlayer = {};
;(function($, window, document, underfined) {
	//
	//浏览器宽度
	var SreenW = $(window).width();
	// //浏览器高度
	var SreenH = $(window).height();
	 //alert(SreenH +'=>'+SreenW);
	
	$.fn.extend(mwlayer, {
		status : 0,
		//初始化配置
		Options : {
			bgOpacity : '0.8',
			bgColor : '#9f9f9f',
			EditW : 400,
			EditH : 600,
			ThumbW : 100,
			ThumbH : 100,
		},
		
		box : function(title,html) {
			mwlayer._html(html,title);
			//close();
		},
		//提示完消息后跳转
		msgjump : function (msg,url,time){
			time = time ? time : 1.5;
			mwlayer._init();
			//拼装HTML
			var msg = '<div id="msgbgw"></div><div id="laymsgmw"><span class="success">' + msg + '</span></div>';
			//添加html
			$('body').prepend(msg);
			//居中
			mwlayer._center('#laymsgmw');
     		var setmsg = setTimeout(function() {
     			//消息关闭
				$('#laymsgmw').fadeOut('1300', function() {
					if(url)
						window.location.herf = url;
					else
						window.location.reload(true);
				});
			}, time * 1000);
			return false;
		},
		//错误提示
		error : function(msg,time,close,rload) {
			time = time ? time : 1.5;
			mwlayer._message(msg,0,time,close,rload);
		},
		//操作成功提示
		success : function(msg,time,close,rload) {
			time = time ? time : 1.5;
			mwlayer._message(msg,1,time,close,rload);
		},
		//消息提示
		msg : function (msg,status,rload,close,time) {
			if(status){
				mwlayer.success(msg,time,close,rload);
			}else{
				mwlayer.error(msg,time,close,rload);
			}
		},
		//可以url加载
		load : function (title,url,parem,_top){
			mwlayer.Options.top = _top;
			mwlayer._load(url,title,parem);
		},
		//关闭窗口
		close : function (time) {
			var t = time ? time : 1;
			var setmsg = setTimeout(function() {
				$('#outsidebox').fadeOut('1000', function() {
					$(this).remove();
					$('#mwbg').remove();
					mwlayer.status = 0;
				});
			}, t * 1000);
		},
		//马上关闭
		_nowClose : function (){
			$('#outsidebox').remove();
			$('#mwbg').remove();
		},
		
		_move : function () {
			$('#outsidebox').mousedown(function (eve) {
				var Obj = $(this);
				var Eve = eve;
				var left = eve.pageX - Obj.offset().left;
				var top = eve.pageY - Obj.offset().top;
				Obj.mousemove(function (){
					Obj.css({'left':(Eve.pageX - left)+'px','top':(Eve.pageY - top)+'px'});
				});
			});
		},
		
		_html : function (cont,title,ajx) {
			mwlayer._init();
			var t = title ? '<div id="lytitle"><h3>'+title+'<a href="javascript:;" onclick="mwlayer.close(0.4);" title="关闭">X</a></h3></div>' : '';
			var html = '<div id="mwbg" show="1"></div>'+
						'<div id="outsidebox">'+ t +
						'<div id="box_content">'+
						'<div></div>';
//			$('body').prepend(html);
			$('body').append(html);
			var h = ajx ? '<iframe>'+cont+'</iframe>' : cont;
			$('#box_content').append(h);
			mwlayer._center();
			mwlayer.status = 1;
		},
		//消息提示
		_message : function (msg,type,time,cle,rload) {
			mwlayer._init();
			var clas = type ? 'success' : 'error';
			var yclose =  cle ? cle : (type ? 1 : 0); 
			//是否要关闭主窗口,如果是成功信息默认关闭
			(yclose && mwlayer.status) ? $('#outsidebox').remove() : false;
			//拼装HTML
			var msg = '<div id="msgbgw"></div><div id="laymsgmw"><span class="' + clas + '">' + msg + '</span></div>';
			//添加html
			$('body').prepend(msg);
			//居中
			mwlayer._center('#laymsgmw',-1);
			//主窗口状态 
			var status = mwlayer.status;
     		var setmsg = setTimeout(function() {
     			yclose ? mwlayer._nowClose() : false;//删除主窗口
     			//消息关闭
				$('#laymsgmw').fadeOut('1000', function() {
					$(this).remove();
					$('#msgbgw').remove();
					rload ? window.location.reload() : false;
				});
			}, time * 1000);
			return false;
		},
		//居中
		_center : function (boxid,_top){
			boxid = boxid ? boxid : '#outsidebox';
			//浏览器宽度
			//var W = $(document).width();
			// //浏览器高度
			//var H = $(document).height();
			var oboxw = $(boxid).width();
			var oboxh = $(boxid).height();
			
			var top = 100;
			if(_top > 1){
				top = _top;
			}else if(_top == -1){
				top = (($(window).height() - oboxh) / 2 - 50);
				console.log(top);
			}
			var oboxl = $(boxid).css({
				'left' : ($(window).width() - oboxw) / 2 + 'px',
//				'top' : (($(window).height() - oboxh) / 2 - 50) + 'px',
				'top' : (top+'px'),
			}).fadeTo('slow',0.99);
		},
		_iframe : function (){
			
		},
		_load : function (url,title,param){
			jQuery.ajax({
				url:url,
	  	   	    type:'post',
	  	   	    data:param,
	  	   	    cache:false,
	  	   	    dataType:'html',
	     	}).done(function (html) {
	  	   		  mwlayer._html(html,title);
	     	});
		},
		_style : function (){
			var style = '<style>#mwbg,#msgbgw{display:block;position:fixed;z-index:900;opacity: 0.8;filter:Alpha(Opacity=90);postion:fixed;background:' + mwlayer.Options.bgColor + ';top:0;left:0;width:100%;height:100%;}' + 
			'#outsidebox,#laymsgmw{border:3px solid #666;box-shadow:0 0 8px #333;background:#fff;border-radius:10px;z-index:910;position:fixed;padding:10px;display:none;} #outsidebox h3{height:35px;line-height:35px;border-bottom:1px solid #ccc;background:#efefef;}' +
			 '#laymsgmw .error{color:red;font-size:14px;} #laymsgmw .success{color:green;font-size:14px;} ' + '#outsidebox .clr{clear:both;padding:0;margin:0;}' + 
			 '#outsidebox #box_content{padding:0 10px;max-height:650px;overflow:hidden;overflow-y:auto;}'+
			 '#outsidebox #lytitle{height:30px;margin-bottom:20px;} #outsidebox #lytitle h3{height:40px;line-height:40px;color:#999;padding:0 15px;border:1px solid #ccc;font-size:18px;margin:0;linear-gradient(to bottom, #f5f5f5 0%, #e8e8e8 100%);border-radius:5px;color:#666;font-family:微软雅黑} '+ 
			 '#outsidebox #lytitle h3 a{display:inline-block;width:20px;height:20px;font-size:18px;color:#333;float:right;cursor:pointer;text-align:center;line-height:40px;font-weight:bold;} #outsidebox #lytitle h3 a:hover{color:#a00;}'+
			 '#laymsgmw{z-index:999;}#msgbgw{z-index:998;}'+
			 '</style>';
			$("head").append(style);
		},
		_init : function (){
			var obj = $('body');
			if(! obj.hasClass('layercss')){
				obj.addClass('layercss');
				mwlayer._style();
			};
		}
	});
	
})(jQuery, window, document)
