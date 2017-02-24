var checkbox = document.getElementById('loginform-rememberme');
$("#loginform-username").blur(function(){
	if($("#loginform-username") && $("#loginform-password") && checkbox.checked){
		var username = $("#loginform-username").val();
		var password = $("#loginform-password").val();
		$.cookie("username",username);
		$.cookie("password",password);
	}
	if(!checkbox.checked){
		$.cookie("username","");
		$.cookie("password","");
	}
})
$("#loginform-password").blur(function(){
	if($("#loginform-username") && $("#loginform-password" ) && checkbox.checked){
		var username = $("#loginform-username").val();
		var password = $("#loginform-password").val();
		$.cookie("username",username);
		$.cookie("password",password);
	}
	if(!checkbox.checked){
		$.cookie("username","");
		$.cookie("password","");
	}
})
$("#loginform-username").val( $.cookie("username") );  
$("#loginform-password").val( $.cookie("password") );  
$("#loginform-rememberme").click(function(){
	if($("#loginform-username") && $("#loginform-password" ) && checkbox.checked){
		var username = $("#loginform-username").val();
		var password = $("#loginform-password").val();
		$.cookie("username",username);
		$.cookie("password",password);
	}
	if(!checkbox.checked){
		$.cookie("username","");
		$.cookie("password","");
	}
})