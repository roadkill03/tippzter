<?php
include 'db_connect.php';
session_start();
//Finlir med isset knapp osv behöver kirras.
if(!is_string($_SESSION["user_id"])){
	$user_id = $_SESSION["user_id"];
}else{
	$user_id = mysqli_real_escape_string($db_connect, $_SESSION["user_id"]);	
}

if(!is_string($_POST['tournament_id'])){
	$tournament_id = $_POST['tournament_id'];
}else{
	$tournament_id = mysqli_real_escape_string($db_connect, $_POST['tournament_id']);	
}
$bets = json_decode($_POST['betts']);

foreach ($bets as $bet) {
	
	$query = "SELECT slutspel_bet_id FROM slutspel_bets WHERE slutspel_id = '". $bet->slut_game_id ."' AND
  	user_id = $user_id AND
    tournament_id = $tournament_id";
	$result = $db_connect->query($query);
	$bet_exist = mysqli_fetch_assoc($result);
	//var_dump($bet_exist);

	if(is_null($bet_exist)){

		$query = "INSERT INTO slutspel_bets (slutspel_id, user_id, tournament_id, goal_home, goal_away) VALUES (". $bet->slut_game_id .", $user_id, $tournament_id, ". $bet->goal_home .", ". $bet->goal_away .")";

	}else{

		$query = "UPDATE slutspel_bets SET goal_home =  ". $bet->goal_home .", goal_away = ". $bet->goal_away ." WHERE slutspel_bet_id = ". $bet_exist['slutspel_bet_id'] ."";

	}
	if(mysqli_query($db_connect, $query)){
		//success

	}else{
		// echo a error message if the query dident work.
	}

}

$db_connect->close();
?>