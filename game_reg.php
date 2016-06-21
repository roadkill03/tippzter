<?php
include 'includes/db_connect.php';
//Saves the values from the registration form into the database.
$sql = "INSERT INTO games (home_team, away_team, game_date, game_time)
VALUES ('".$_POST['home_team']."', '".$_POST['away_team']."', '".$_POST['game_date']."', '".$_POST['game_time']."' )";

if(mysqli_query($db_connect, $sql)){
	//success
	echo 'Bean Bag';
}else{
	// echo a error message if the query dident work.
	echo "Error: ". $sql . "<br>" . mysqli_error($db_connect);
}
?>
