<?php include "includes/header.php"; ?>
<?php include "includes/menu.php"; ?>

<?php $query = "SELECT * FROM teams ORDER BY group_nr ASC, team_points DESC, goal_diff DESC";

$result = mysqli_query($db_connect, $query);

$groupA = array();
$groupB = array();
$groupC = array();
$groupD = array();
$groupE = array();
$groupF = array();

while($row = mysqli_fetch_assoc($result)){

	$team_id = $row["team_id"];
	$team_name = $row["team_name"];
	$team_flag = $row["team_flag"];
	$group_nr = $row["group_nr"];

	if ($group_nr == "A") {
	 	array_push($groupA, $row);
	}
	if ($group_nr == "B") {
		array_push($groupB, $row);
	}
	if ($group_nr == "C") {
		array_push($groupC, $row);
	}
	if ($group_nr == "D") {
		array_push($groupD, $row);
	}
	if ($group_nr == "E") {
		array_push($groupE, $row);
	}
	if ($group_nr == "F") {
		array_push($groupF, $row);
	}
}

	?>
	<div class="container">
		<div class="row">
			<div class="slutspel">
				<h1>Slutspelet</h1>
				<h3>Åttondelsfinaler: ( Just nu... )</h3>
				</br>
				<div>
					<h4> Åttondelsfinal 1 </h4>
					<p>25/6 15.00: (Match 37) 2A-2C </p> 
					<?php echo "<p>" . $groupA[1]['team_name'] . " - " . $groupC[1]['team_name'] . "</p>"; ?> 
				</div>
				</br>
				<div>
					<h4> Åttondelsfinal 2 </h4>
					<p>25/6 18.00: (Match 38) 1B-3A/C/D </p>
					<?php echo "<p>" . $groupB[0]['team_name'] . " - " . $groupA[2]['team_name'] . ", " .  $groupC[2]['team_name'] . " eller " . $groupD[2]['team_name'] . "</p>"; ?> 
				</div>
				</br>
				<div>
					<h4> Åttondelsfinal 3 </h4>
					<p>25/6 21.00: (Match 39) 1D-3B/E/F </p>
					<?php echo "<p>" . $groupD[0]['team_name'] . " - " . $groupB[2]['team_name'] . ", " .  $groupE[2]['team_name'] . " eller " . $groupF[2]['team_name'] . "</p>"; ?> 
				</div>
				</br>
				<div>
					<h4> Åttondelsfinal 4 </h4>
					<p>26/6 15.00: (Match 40) 1A-3C/D/E </p>
					<?php echo "<p>" . $groupA[0]['team_name'] . " - " . $groupC[2]['team_name'] . ", " .  $groupD[2]['team_name'] . " eller " . $groupE[2]['team_name'] . "</p>"; ?> 
				</div>
				</br>
				<div>
					<h4> Åttondelsfinal 5 </h4>
					<p>26/6 18.00: (Match 41) 1C-3A/B/F </p>
					<?php echo "<p>" . $groupC[0]['team_name'] . " - " . $groupA[2]['team_name'] . ", " .  $groupB[2]['team_name'] . " eller " . $groupF[2]['team_name'] . "</p>"; ?> 
				</div>
				</br>
				<div>
					<h4> Åttondelsfinal 6 </h4>
					<p>26/6 21.00: (Match 42) 1F-2E </p>
					<?php echo "<p>" . $groupF[0]['team_name'] . " - " . $groupE[1]['team_name'] . "</p>"; ?>
				</div>
				</br>
				<div>
					<h4> Åttondelsfinal 7 </h4>
					<p>27/6 18.00: (Match 43) 1E-2D </p>
					<?php echo "<p>" . $groupE[0]['team_name'] . " - " . $groupD[1]['team_name'] . "</p>"; ?>
				</div>
				</br>
				<div>
					<h4> Åttondelsfinal 8 </h4>
					<p>27/6 21.00: (Match 44) 2B-2F </p>
					<?php echo "<p>" . $groupB[1]['team_name'] . " - " . $groupF[1]['team_name'] . "</p>"; ?>
				</div>
				</br>
				

				<h3>Kvartsfinaler:</h3>
				<p>30/6 21.00: (Match 45) Segrare match 37-Segrare match 39 </p>
				<p>1/7 21.00: (Match 46) Segrare match 38-Segrare match 42 </p>
				<p>2/7 21.00: (Match 47) Segrare match 41-Segrare match 43 </p>
				<p>3/7 21.00: (Match 48) Segrare match 40-Segrare match 44 </p>

				<h3>Semifinaler:</h3>
				<p>6/7 21.00: (Match 49) Segrare match 45-Segrare match 46 </p>
				<p>7/7 21.00: (Match 50) Segrare match 47-Segrare match 48 </p>

				<h3>Final:</h3>
				<p>10/7 21.00: Segrare match 49-Segrare match 50</p>
			</div>
			
		</div>
	</div>

<?php


//funktionen updaterar hemmalagen i slutspelet
function insertHomeTeam($home_team_id, $slutspel_id){
	global $db_connect;
	mysqli_query($db_connect, "UPDATE slutspel SET home_team_id = $home_team_id WHERE slutspel_id = $slutspel_id " );
}
//funktionen updaterar bortalagen i slutspelet
function insertAwayTeam($away_team_id, $slutspel_id){
	global $db_connect;
	mysqli_query($db_connect, "UPDATE slutspel SET awat_team_id = $away_team_id WHERE slutspel_id = $slutspel_id " );
}
?>

<?php include "includes/footer.php"; ?>