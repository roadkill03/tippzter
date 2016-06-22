<?php
include 'db_connect.php';
$home_goal = $_POST['home_goal'];
$away_goal = $_POST['away_goal'];
$home_team_id = $_POST['home_team_id'];
$away_team_id = $_POST['away_team_id'];

/* **************************************** */
/* Sparar in eller uppdaterar slutresultaten på matcherna */
/* **************************************** */



//Kollar om game_id skickat med något
if (isset($_POST['game_id']) && !empty($_POST['game_id'])) {
	$game_id = $_POST['game_id'];
	$result = mysqli_query($db_connect, "SELECT * FROM results WHERE game_id = $game_id ");

	if($result->num_rows > 0) {
	    mysqli_query($db_connect, "UPDATE results SET result_goal_home = '$home_goal', result_goal_away = '$away_goal' 
	    							WHERE game_id = '$game_id' ");
	   
	}
	else {
	    mysqli_query($db_connect, "INSERT INTO results (game_id, result_goal_home, result_goal_away) 
		VALUES ('$game_id', '$home_goal', $away_goal)");

	}
}
//Kollar om slutspel_id skickat med något resultat

else if(isset($_POST['slutspel_id']) && !empty($_POST['slutspel_id'])) {
	
	$slutspel_id = $_POST['slutspel_id'];
	$result = mysqli_query($db_connect, "SELECT * FROM slutspel_result WHERE slutspel_id = $slutspel_id ");

	if($result->num_rows > 0) {
	    mysqli_query($db_connect, "UPDATE slutspel_result SET result_goal_home = '$home_goal', result_goal_away = '$away_goal' 
	    							WHERE slutspel_id = '$slutspel_id' ");
	   
	}
	else {
	    mysqli_query($db_connect, "INSERT INTO slutspel_result (slutspel_id, result_goal_home, result_goal_away) 
		VALUES ('$slutspel_id', '$home_goal', $away_goal)");

	}

}

/* **************************************** */
/* *** Sparar lagens poäng  & mål i db **** */
/* **************************************** */

//sparar returvärdet från funktionen teamPoints i variabler
$points1 = teamPoints("$home_team_id");
$points2 = teamPoints("$away_team_id");

//hämtar funktionen som updaterar lagens aktuella poäng
insertTeamPoints($points1, "$home_team_id");
insertTeamPoints($points2, "$away_team_id");

//sparar returvärden från funktionerna plusGoals och minusGoals i variabler
$plusGoals1 = plusGoals("$home_team_id");
$plusGoals2 = plusGoals("$away_team_id");
$minusGoals1 = minusGoals("$home_team_id");
$minusGoals2 = minusGoals("$away_team_id");

//hämtar funktionerna som updaterar lagens gjorda, insläppta mål och differens
insertPlusGoals($plusGoals1, "$home_team_id");
insertMinusGoals($minusGoals1, "$home_team_id");
insertPlusGoals($plusGoals2, "$away_team_id");
insertMinusGoals($minusGoals2, "$away_team_id");

insertGoalDiff("$home_team_id", $plusGoals1, $minusGoals1);
insertGoalDiff("$away_team_id", $plusGoals2, $minusGoals2);


/* **************************************** */
/* ***** Sparar spelarens poäng i db ****** */
/* **************************************** */

$query2 = "SELECT * FROM user_tournaments";
$result2 = mysqli_query($db_connect, $query2);

//loopar igenom varje rad i user_tournaments
while ( $row = mysqli_fetch_assoc($result2)) {
	$user_id = $row["user_id"];
	$user_name = $row["user_name"];
	$tournament_id = $row["tournament_id"];
	//echo $user_name;

	//sparar returvärdet från funktionen userPoints
	$points = userPoints($user_id, $tournament_id);
	//sparar returvärdet från winnerExtraPoints
	$extra_points = winnerExtraPoints($user_id, $tournament_id);

	//sparar returvärdet från slutspelPoints
	$slutspel_points = slutspelPoints($user_id, $tournament_id);

	//hämtar funktionen som updaterar personens aktuella poäng
	updateUserPoints($points, $extra_points, $slutspel_points, $user_id, $tournament_id);

}

//skickar tillbaka till admin_dash
header("Location: ../admin_dash.php");




/* **************************************** */
/* ************* FUNKTIONER *************** */
/* **************************************** */

//funktionen updaterar lagets poäng
function insertTeamPoints($points, $team_id){
	global $db_connect;
	mysqli_query($db_connect, "UPDATE teams SET team_points = $points WHERE team_id = '$team_id' " );
}

//funktionen räknar ut lagets aktuella poäng.
function teamPoints($team_id){
	global $db_connect;
	$points = 0;

	//hämtar all info från game_match och results.
	$query1 = "SELECT game_match.*, results.* FROM game_match 
			RIGHT JOIN results
			ON results.game_id = game_match.game_id
			WHERE home_team_id = $team_id OR away_team_id = $team_id";

  	$result1 = $db_connect->query($query1);

  	while ($row = mysqli_fetch_assoc($result1)) {

  		if($row["home_team_id"] == $team_id) {
  			if($row["result_goal_home"] > $row["result_goal_away"]){
  				$points = $points +3;
  			}
  		}

  		else if ($row["away_team_id"] == $team_id){
  			if($row["result_goal_away"] > $row["result_goal_home"]){
  				$points = $points +3;
  			}
  		}
  		
  		if($row["result_goal_away"] == $row["result_goal_home"]){
  			$points = $points +1;
  		}

  	} 
    return $points;   
}


//funktionen räknar ut antal gjorda mål
function plusGoals($team_id){
	global $db_connect;
	$plus_goals = 0;
	//hämtar all info från game_match och results.
	//Vill ha alla matchers resultat för att kunna räkna ut hur många mål varje lag har gjort.
	$query1 = "SELECT game_match.*, results.* FROM game_match 
			RIGHT JOIN results
			ON results.game_id = game_match.game_id
			WHERE home_team_id = $team_id OR away_team_id = $team_id";

  	$result1 = $db_connect->query($query1);
  	//var_dump($result);
  	while ($row = mysqli_fetch_assoc($result1)) {

  		if($row["home_team_id"] == $team_id) {
  			$plus_goals = $plus_goals + $row["result_goal_home"];	
  		}
  		if ($row["away_team_id"] == $team_id){
  			$plus_goals = $plus_goals + $row["result_goal_away"];
  		}

  	} 
    return $plus_goals;   
}

//funktionen räknar ut antal insläppta mål
function minusGoals($team_id){
	global $db_connect;
	$minus_goals = 0;
	//hämtar all info från game_match och results.
	//Vill ha alla matchers resultat för att kunna räkna ut hur många mål varje lag har gjort.
	$query1 = "SELECT game_match.*, results.* FROM game_match 
			RIGHT JOIN results
			ON results.game_id = game_match.game_id
			WHERE home_team_id = $team_id OR away_team_id = $team_id";

  	$result1 = $db_connect->query($query1);
  	//var_dump($result);
  	while ($row = mysqli_fetch_assoc($result1)) {

  		if($row["home_team_id"] == $team_id) {
  			$minus_goals = $minus_goals + $row["result_goal_away"];	
  		}
  		if ($row["away_team_id"] == $team_id){
  			$minus_goals = $minus_goals + $row["result_goal_home"];
  		}

  	} 
    return $minus_goals; 
}

//funktionen räknar ut mål differensen och updaterar goal_diff i db
function insertGoalDiff($team_id, $plusGoals, $minusGoals){
	global $db_connect;

	//räknar ut diffen mellan plus och minus målen
	$goal_diff = $plusGoals - $minusGoals;
	//Uppdaterar user_points med den nya $total_points
	mysqli_query($db_connect, "UPDATE teams SET goal_diff = $goal_diff WHERE team_id = $team_id");

	return $goal_diff;
}

//updaterar antal gjorda mål db
function insertPlusGoals($points, $team_id){
	global $db_connect;
	mysqli_query($db_connect, "UPDATE teams SET plus_goals = $points WHERE team_id = '$team_id' " );
}

//updaterar antal insläppta mål i db
function insertMinusGoals($points, $team_id){
	global $db_connect;
	mysqli_query($db_connect, "UPDATE teams SET minus_goals = $points WHERE team_id = '$team_id' " );
}



//funktionen räknar ut poängen för varje användare i grundspelet
function userPoints($user_id, $tournament_id) {
	global $db_connect;

	//hämtar all info från game_match och results.
	$query = "SELECT results.*, bets.* FROM results 
		LEFT JOIN bets
		ON bets.game_id = results.game_id
		WHERE tournament_id = $tournament_id AND user_id = $user_id";

  	$result = $db_connect->query($query);
  	//print_r($result);
    $points = 0;

  	while ($row = mysqli_fetch_assoc($result)) {
  		
  			
  		if($row["goal_home"] == $row["result_goal_home"]) {
  			$points = $points + 5;		
  		}
  		if($row["goal_away"] == $row["result_goal_away"]) {
  			$points = $points + 5;
  		}
	  	
  		if($row["goal_away"] < $row["goal_home"] && $row["result_goal_away"] < $row["result_goal_home"]) {
			$points = $points + 10;  			
  		}
  		else if($row["goal_away"] > $row["goal_home"] && $row["result_goal_away"] > $row["result_goal_home"]) {
  			$points = $points + 10;	
  		}
  		else if($row["goal_home"] == $row["goal_away"] && $row["result_goal_home"] == $row["result_goal_away"]) {
  			$points = $points + 10;
	  	}	
    }

  	return $points;

}

//funktionen räknar ut poängen för varje användare i slutspelet
function slutspelPoints($user_id, $tournament_id) {
	global $db_connect;

	//hämtar all info från slutspel och slutspel_result.
	
	$query = "SELECT slutspel_result.*, slutspel_bets.* FROM slutspel_result 
		LEFT JOIN slutspel_bets
		ON slutspel_bets.slutspel_id = slutspel_result.slutspel_id
		WHERE tournament_id = $tournament_id AND user_id = $user_id";

  	$result = $db_connect->query($query);
  	//print_r($result);
    $slutspel_points = 0;

  	while ($row = mysqli_fetch_assoc($result)) {
  		
	  			
	  		if($row["goal_home"] == $row["result_goal_home"]) {
	  			$slutspel_points = $slutspel_points + 10;		
	  		}
	  		if($row["goal_away"] == $row["result_goal_away"]) {
	  			$slutspel_points = $slutspel_points + 10;
	  		}
		  	
	  		if($row["goal_away"] < $row["goal_home"] && $row["result_goal_away"] < $row["result_goal_home"]) {
				$slutspel_points = $slutspel_points + 30;  			
	  		}
	  		else if($row["goal_away"] > $row["goal_home"] && $row["result_goal_away"] > $row["result_goal_home"]) {
	  			$slutspel_points = $slutspel_points + 30;	
	  		}
	  		else if($row["goal_home"] == $row["goal_away"] && $row["result_goal_home"] == $row["result_goal_away"]) {
	  			$slutspel_points = $slutspel_points + 30;
		  	}
  		
  		
    }
  	//echo $slutspel_points . "slutspelpoäng" . "</br>";
  	return $slutspel_points;
  	
}



function winnerExtraPoints($user_id, $tournament_id) {
  global $db_connect;
  $extra_points = 0;
 
  //hämtar all info från game_match och results.
  //Vill ha alla matchers resultat för att kunna räkna ut hur många poäng varje lag har.
  $query = "SELECT extra_bets.*, results_extra.* FROM extra_bets, results_extra 
  			WHERE tournament_id = $tournament_id AND user_id = $user_id";

    $result = $db_connect->query($query);
 

    while ($row = mysqli_fetch_assoc($result)) {
      if($row['user_id'] == $user_id) {
         if($row["winning_player"] == $row["winner_player"]) {
              $extra_points = $extra_points +200;
            
          }

          if($row["winning_team"] == $row["winner_team"]) {
              $extra_points = $extra_points +200;        
          }
      }
      
    }

    return $extra_points;

}

//funktionen uppdaterar varje persons poäng i varje grupp
function updateUserPoints($points, $extra_points, $slutspel_points, $user_id, $tournament_id){
	global $db_connect;

	//lägger ihop poängen från winnerExtraPoints, userPoints och slutspelPoints
	$total_points = $extra_points + $points + $slutspel_points;
	//Uppdaterar user_points med den nya $total_points
	mysqli_query($db_connect, "UPDATE user_tournaments SET user_points = $total_points 
								WHERE user_id = $user_id AND tournament_id = $tournament_id");

	return $total_points;
}
?>