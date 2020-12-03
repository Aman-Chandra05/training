$(document).ready(function(){
	console.log("hello");
	$(".errmsg").hide();
	$("#result").hide();
	$("#samelocation").hide();
	$("#result button").click(function()
		{
			$("#result").hide();
		});
	$("#sub").click(function(ev)
	{
		ev.preventDefault();
		var pickup=$("#pickup").val();
		var drop=$("#drop").val();
		var cab=$("#cab").val();
		var luggage=Number($("#luggage").val());
		console.log(pickup);
		if(pickup==null || drop==null || cab==null || !(Number.isInteger(luggage)) || luggage<0)
		{
			if(pickup==null)
				$("#pickmsg").show();
			if(drop==null)
				$("#dropmsg").show();
			if(cab==null)
				$("#cabmsg").show();
			if(!(Number.isInteger(luggage)) || luggage<0)
				$("#luggmsg").show();
		}
		else
		{
			if(pickup==drop)
			{
				$("#samelocation").show();
				$("#result").hide();
			}
			else
			{
				$.ajax({
					url: 'fare.php',
					type: 'post',
					data: {pickup,drop,cab,luggage},
					dataType: 'json',
					success: function(result)
					{
						console.log(result);
						$(".errmsg").hide();
						$("#result").show();
						$("#pickuplocation").html(result.pickup);
						$("#droplocation").html(result.drop);
						$("#dist").html(result.dist);
						$("#fare").html(result.price);
					},
					error: function()
					{
						alert("error");
					}
				});
			}
		}
	});
});
function cabtype(ctype)
{
	$("#cabmsg").hide();
	if(ctype=="micro")
	{
		$("#luggage").val('');
		$("#luggage").attr('disabled','disabled');
	}
	else
	{
		$('#luggage').removeAttr('disabled');
	}
}
function droperr()
{
	$("#dropmsg").hide();
	$("#samelocation").hide();
}
function pickuperr()
{
	$("#pickmsg").hide();
	$("#samelocation").hide();
}
function luggerr()
{
	$("#luggmsg").hide();
}