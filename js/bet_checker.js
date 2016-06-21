$(document).ready(function(){

	$('.error').hide();
	
	var post_values = [];
	var slut_post_values = [];

	//loops trough all the input values again and and matches them with the old ones 'variabel inputs' to se if any have changed.
	function check_values(){
		post_values = [];
		$('.betGames').each(function() {
			var game_id = $(this).children('td').children('input.game_id');
			var goal_home = $(this).children('td').children('input.goal_home');
			var goal_away = $(this).children('td').children('input.goal_away');

			if(goal_home.attr('original') !== goal_home.val() || goal_away.attr('original') !== goal_away.val()){
				if (goal_home.val() == '' || goal_away.val() == '') {
					$(this).children('td.error').show();
				}else{
					$(this).children('td.error').hide();
					var post_value = {game_id:game_id.val(), goal_home:goal_home.val(), goal_away:goal_away.val()};
					post_values.push(post_value);
				}
			}

	    });
	}

	function slut_check_values(){
		slut_post_values = [];
		$('.slutBetGames').each(function() {

			//var slutspel_id = $(this).children('td').children('input.slutspel_id');
			var slut_game_id = $(this).children('td').children('input.slutspel_id');
			var goal_home = $(this).children('td').children('input.goal_home');
			var goal_away = $(this).children('td').children('input.goal_away');


			if(goal_home.attr('original') !== goal_home.val() || goal_away.attr('original') !== goal_away.val()){
				if (goal_home.val() == '' || goal_away.val() == '') {
					$(this).children('td.error').show();
				}else{
					$(this).children('td.error').hide();
					var slut_post_value = {slut_game_id:slut_game_id.val(), goal_home:goal_home.val(), goal_away:goal_away.val()};
					slut_post_values.push(slut_post_value);
				}
			}

	    });
	}
	var tour_id = $('#tour_id').val()
 	$('#check').click(function(){
	    check_values();
	    slut_check_values();
	    if(post_values.length > 0) {
		    $.ajax({
		        type:"post",
		        url:"includes/save_bet.php",
		        data:"tournament_id="+tour_id+"&bets="+JSON.stringify(post_values),
		        	success:function(data){
		        		console.log(data);
		        		$('#myModal').appendTo("body").modal('show');
		        		$('.modal-title').html("Spara");
		        		$('.modal-body').html("Dina bets är nu sparade");
		        	}
	   		});
		}
		if(slut_post_values.length > 0){
		    $.ajax({
		        type:"post",
		        url:"includes/save_slut_spel.php",
		        data:"tournament_id="+tour_id+"&betts="+JSON.stringify(slut_post_values),
		        	success:function(data){
		        		console.log(data);
		        		$('#myModal').appendTo("body").modal('show');
		        		$('.modal-title').html("Spara");
		        		$('.modal-body').html("Dina bets är nu sparade");
		        	}
	   		});
		}
	});
});