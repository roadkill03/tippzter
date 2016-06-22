$(document).ready(function(){

	$(".toggleTr").click(function(){
		var gameId = $(this).attr("rel");
		$("#togglable_" + gameId).toggle("fast");//.css("display","block");
	});

	$(".s_toggleTr").click(function(){
		var gameId = $(this).attr("rel");
		$("#s_togglable_" + gameId).toggle("fast");//.css("display","block");
	});


});