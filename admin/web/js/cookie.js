document.write("<script src='jquery.cookie.js'></script>")
document.write("<script src='jquery.min.js'></script>")
if($("#loginform-rememberme").is(":checked")){
	var username = $("#loginform-username").val();
	var password = $("#loginform-password").val();
	$.cookie("username",username);
	$.cookie("password",password);
	
}
if( $.cookie(COOKIE_NAME) ){  
   $("#loginform-username").val( $.cookie(username) );  
 }  
if( $.cookie(password) ){  
   $("#loginform-password").val( $.cookie(password) );  
 }  