$(document).ready(function(){

	$(".toggleTr").click(function(){

		var gameId = $(this).attr("rel");

		console.log("KLICK" + gameId);
		$("#togglable_" + gameId).toggle("fast");//.css("display","block");
	});
});