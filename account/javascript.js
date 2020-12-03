$(document).ready(function(){
	$(".errmsg").hide();

});
function validate()
{
	var username=$("#username").val();
	var name=$("#name").val();
	var password=$("#password").val();
	var password=$("#password").val();
	var mobile=Number($("#mobile").val());
	if(username==null || name==null || password==null || mobile==null)
	{
		if(username==null)
			$("#usrmsg").show();
		if(name==null)
			$("#namemsg").show();
		if(password==null)
			$("#passmsg").show();
		if(mobile==null)
			$("#mobmsg").show();
	}
	else 
		return true;
}