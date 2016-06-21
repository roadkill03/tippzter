<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>

<div class="container-fluid">
	<div class="row">
		<?php
$groups= array('A', 'B', 'C', 'D', 'E', 'F');

$grouplength = count($groups);

for($x = 0; $x < $grouplength; $x++) {
	?>
	<div class="group col-sm-12">
		<h3>Group <?php echo $groups[$x]; ?></h3>
		<div class="tabell col-sm-4 col-md-3">
    		<?php echo groupTeams($groups[$x]); ?>
    	</div>


	    <div class="games col-sm-8 col-md-9">
			<?php echo games($groups[$x]); ?>	
	    </div>
	</div><!-- group -->
	<div class="line col-xs-12"></div>

    <?php
}
?>
	</div><!-- #Container -->
</div><!-- #row -->

<?php

//funktionen hämtar slutresultatet i matchen
function results($game_id) {
	global $db_connect;
	$query = "SELECT * FROM results WHERE game_id = $game_id";

	$result = mysqli_query($db_connect, $query);
	$row = mysqli_fetch_assoc($result);

	return $row["result_goal_home"] . " - " . $row["result_goal_away"];
}	

//funktion som hämtar ut matcherna
function games($groupGames){
	
	global $db_connect;
	$query = "SELECT T1.team_name as team_home, T2.team_name as team_away, 
	  				T1.team_flag as home_flag, T2.team_flag as away_flag, 
	  				T1.group_nr as home_team_number, T2.group_nr as away_team_number, 
	  				game_match.*
					FROM game_match, teams T1, teams T2
					WHERE T1.team_id=game_match.home_team_id AND T2.team_id=game_match.away_team_id ";

	$result = mysqli_query($db_connect, $query);
	
	while($row = mysqli_fetch_assoc($result)){

		// print_r($row);
		$game_id = $row["game_id"];
		$group_nr = $row["home_team_number"];
		$home_name = $row["team_home"];
		$away_name = $row["team_away"];
		$home_flag = $row["home_flag"];
		$away_flag = $row["away_flag"];	
		$game_start = $row['game_start'];
		

		if ( $group_nr == $groupGames){
			?>
			<table>
				<tbody>
					<tr>
						<td style="width:100px"><?php echo date("d M H:i", strtotime($game_start)); ?></td>
						<td class="mobile_hide tablet_hide" style="width:100px; text-align:right;"><?php echo $home_name;?></td>
						<td style="width:30px; text-align:right;"><img class="flag" src="img/<?php echo $home_flag; ?>" /></td>
						<td style="width:40px; text-align:center;"> VS </td>
						<td style="width:30px"><img class="flag" src="img/<?php echo $away_flag; ?>" /></td>
						<td class="mobile_hide tablet_hide" style="width:100px"><?php echo $away_name;?></td>
						<td style="width:120px"><?php echo results($game_id) ?> </td>
					</tr>
				</tbody>
			</table>
		<?php
		}				
	}
}

//function that prints out every group ordered by letter
function groupTeams($teamGroup){
	global $db_connect;

	$query = 'SELECT * FROM teams ORDER BY team_points DESC, goal_diff DESC';
	$result = mysqli_query($db_connect, $query);
	?>

	
	<table>
		<thead>
			<tr>
				<td></td>
				<td style="width:100px;"></td>
				<td>h</td>
				<td>b</td>
				<td>+/-</td>
				<td>poäng</td>
			</tr>
		</thead>
		<tbody>
			<?php
			//for each row that exist with a specific letter, print table
			while($row = $result->fetch_assoc()) {
				
				if ( "{$row['group_nr']}"  == $teamGroup){
					?>
					<tr>
						<td><img class="flag" src="img/<?php echo "{$row['team_flag']}"; ?>" /></td>
						<td><?php echo "{$row['team_name']}"; ?></td>
						<td><?php echo "{$row['plus_goals']}"; ?></td>
						<td><?php echo "{$row['minus_goals']}"; ?></td>
						<td><?php echo "{$row['goal_diff']}"; ?></td>
						<td><?php echo "{$row['team_points']}";  ?></td>
					</tr>
					<?php
				}
			}	
			?>
		</tbody>
	</table>
<?php
}
?>
	
<?php include 'includes/footer.php'; ?>