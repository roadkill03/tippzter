<?php 
require "db_connect.php";

session_start();
$user_id = $_SESSION["user_id"];
$tournament_id = $_GET['tour_id'];

$tournament_started = hasDateExpired("2016-06-10 21:00:00");

/* REGISTRERING AV SLUTVINNARE OCH SKYTTEKUNG */
$query1 = "SELECT team_name, team_id FROM teams";
$result1 = $db_connect->query($query1);
$result3 = $db_connect->query($query1);

$result = mysqli_query($db_connect, "SELECT * FROM extra_bets WHERE user_id = '$user_id' AND tournament_id = '$tournament_id'");

while($row = mysqli_fetch_assoc($result)) {

	$team = $row["winning_team"];
	$player = $row["winning_player"];
}

while($row = mysqli_fetch_assoc($result3)) { 

	if($team == $row['team_id']){
		$teamName = $row['team_name'];
		break;
	}
}
$betsRows = array();

$betsQuery = "SELECT bets.game_id, user_name, goal_home, goal_away FROM bets 
						INNER JOIN (users, game_match) 
						ON (bets.user_id = users.user_id AND bets.game_id = game_match.game_id) 
						WHERE tournament_id = $tournament_id
						AND game_start < DATE_SUB(NOW(), INTERVAL 10 MINUTE) 
						ORDER BY bets.game_id, user_name ASC";

$betsResult = $db_connect->query($betsQuery);

while ($betsRow = mysqli_fetch_row($betsResult)) {
	$betsRows[] = $betsRow;
}

?>
<input id="tour_id" type="hidden" value="<?php echo $tournament_id ?>">
<div class="container">
	<div class="row">
		<div class="extra_bet_box">
<? if($tournament_started){
					?>
			<form action="includes/save_extra_bet.php" class="form-inline" method="post" role="form">
				<div class="form-group">
					<label for="player">Målkung:</label>
					<input class="form-control" type="text" name="player" value="<?php echo $player; ?>"/>
				</div>
				<div class="form-group">
					<label for="winning_team">EM-vinnare 2016:</label>
					<select class="form-control" name="selected_team"> 
						<option value="-1">Välj lag</option>
						<?php
						while($row = mysqli_fetch_assoc($result1)) { 
							$output = '<option '
								.($team == $row['team_id'] ? 'selected=selected' : '')
								. 'value='
								. $row['team_id']
								. '>'
								. $row['team_name']
								. '</option>';

								echo $output;
						} 
						?>
					</select>
				</div>
				

						<input class="btn btn-default" type="submit" value="Spara"/>
						<input type="hidden" name="prev_team" value="<?php echo $team; ?>" />
				<input type="hidden" name="tournament_id" value="<?php echo $tournament_id; ?>" />
				
			</form>	
				<?php
				} else {
				?>
					<div class="form-group">
					<label for="player">Tippad målkung:</label>
					<?php echo $player; ?>
				</div>
				<div class="form-group">
					<label for="winning_team">Tippad EM-vinnare 2016:</label>
					<?php echo $teamName; ?>								
				</div>
				<?php
				}
				?>
				
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="team_bet">
			<table class="table1 col-sm-12">
				<tbody>
			
		<?php
		//lägg till _id efter home_team och away_team ^_^!
		/* REGISTRERING AV RESULTAT */

		$ultimateQuery = "SELECT bigtable.*, results.result_goal_home, results.result_goal_away FROM (SELECT allGames.*, bets.goal_home, bets.goal_away FROM 
			(SELECT T1.team_name AS team_home, T2.team_name AS team_away, T1.team_flag 
			AS home_flag, T2.team_flag AS away_flag, game_match.* 
			FROM game_match, teams T1, teams T2 
			WHERE T1.team_id=game_match.home_team_id AND T2.team_id=game_match.away_team_id) AS allGames 

			LEFT OUTER JOIN 
			(SELECT * FROM bets 
			WHERE user_id = $user_id AND tournament_id = $tournament_id ) AS bets 
			ON allGames.game_id = bets.game_id
			ORDER BY allGames.game_id) AS bigtable LEFT JOIN (SELECT * FROM results) as results ON bigtable.game_id = results.game_id";


		$result = $db_connect->query($ultimateQuery);
		$numRows = mysqli_num_rows($result);
		$counter = 0;
		while($row = mysqli_fetch_assoc($result)) {

			$game_id = $row["game_id"];
			$home_name = $row["team_home"];
			$away_name = $row["team_away"];
			$home_flag = $row["home_flag"];
			$away_flag = $row["away_flag"];
			$goal_home = $row["goal_home"];
			$goal_away = $row["goal_away"];
			$game_start = $row["game_start"];
			$result_goal_home = $row["result_goal_home"];
			$result_goal_away = $row["result_goal_away"];

			$betOpen = hasDateExpired($game_start);


			
			if($betOpen){ 
				?>
				<!-- YOU CAN BET -->
				<tr id="betGames" class="betGames">
					<td style="text-align:center;"><?php echo date("d M H:i", strtotime($game_start));?></td>
					<td class="mobile_hide" style="text-align:right;"><?php echo $home_name;?></td>
					<td style="text-align:center;"><img class="flag" src="img/<?php echo $home_flag; ?>" /></td>
					<td style="text-align:center;"> VS </td>
					<td style="text-align:center;" ><img class="flag" src="img/<?php echo $away_flag; ?>" />
					<td style="text-align:left;" class="mobile_hide"><?php echo $away_name;?></td>
					<td style="text-align:right;"><input class="goal_home" original="<?php echo $goal_home; ?>" type="number" gameID="<?php echo $game_id; ?>" value="<?php echo $goal_home; ?>" /></td>
					<td style="text-align:center;">-</td>
					<td style="text-align:left;"><input class="goal_away" original="<?php echo $goal_away; ?>" type="number" gameID="<?php echo $game_id; ?>" value="<?php echo $goal_away; ?>"/></td>
					<td>
						<div class="error">
							Du måste fylla i båda fälten
						</div>
						
						<input class="game_id" type="hidden" name="game_id[]" value="<?php echo $game_id; ?>" />
					</td>
				</tr>
				<?php 
				}
				else{ 

					
					?>
					<tr class="toggleTr" rel="<?php echo $game_id; ?>">
						<td style="text-align:center;" class="locked"><?php echo date("d M H:i", strtotime($game_start));?></td>
						<td style="text-align:right;" class="locked mobile_hide"><?php echo $home_name;?>
						<td style="text-align:center;" class="locked"><img class="flag" src="img/<?php echo $home_flag; ?>" /></td>
						<td style="text-align:center;" class="locked"> VS </td>
						<td style="text-align:center;" class="locked"><img class="flag" src="img/<?php echo $away_flag; ?>" /></td>
						<td style="text-align:left;" class="locked mobile_hide"><?php echo $away_name;?></td>
						<td style="text-align:center;" class="locked" colspan="3"><?php echo $goal_home; ?> - <?php echo $goal_away; ?></td>
						<td style="text-align:center;" class="locked">Resultat </br>(<?php echo $result_goal_home; ?> - <?php echo $result_goal_away; ?>)</td>
					</tr>
					<tr class="togglable" id="togglable_<?php echo $game_id; ?>" style="display:none;background-color:#E6E86C">
					
						<td colspan="10">
							<table width="100%" >
									<?php
										foreach ($betsRows as $key => $value) {
											//print_r($key);
											if($value[0] == $game_id){
												?>
												<tr>
													<td style="text-align:left;">
														<?php
															echo $value[1];
														?>
													</td>
													<td style="text-align:right;">
														<?php
															echo $value[2];
														?>
														-
														<?php
															echo $value[3];
														?>
													</td>
												</tr>
												<?php
											}
										}
										//print_r($betsRows);
									?>
							</table>

						</td>
					</tr>
				<?php } //slut på else
				$counter++;
		} // end while 
		?>
			</tbody>
		</table>
		</br>
		<h1 style="padding-top: 20px;">Slutspelsmatcher</h1>
			<?php 

		/* REGISTRERING AV SLUTSPELRESULTAT */


		$query1 = "SELECT allGames.*, slutspel_bets.goal_home, slutspel_bets.goal_away FROM 
			(SELECT T1.team_name AS team_home, T2.team_name AS team_away, T1.team_flag 
			AS home_flag, T2.team_flag AS away_flag, slutspel.* 
			FROM slutspel, teams T1, teams T2 
			WHERE T1.team_id=slutspel.home_team_id AND T2.team_id=slutspel.away_team_id) AS allGames 

			LEFT OUTER JOIN 
			(SELECT * FROM slutspel_bets 
			WHERE user_id = $user_id AND tournament_id = $tournament_id ) AS slutspel_bets 
			ON allGames.slutspel_id = slutspel_bets.slutspel_id
			ORDER BY allGames.slutspel_id";


		  // die($query1);

		$result1 = $db_connect->query($query1);

		while($row = mysqli_fetch_assoc($result1)) {

			$slutspel_id = $row["slutspel_id"];
			$home_name = $row["team_home"];
			$away_name = $row["team_away"];
			$home_flag = $row["home_flag"];
			$away_flag = $row["away_flag"];
			$goal_home = $row["goal_home"];
			$goal_away = $row["goal_away"];
			$game_start = $row["game_date"];

			$betOpen = hasDateExpired($game_start);

			?>
			
			<!-- <div class="bet_boxes"> -->
			
			<table class="table1 col-sm-12">
				<tbody>

				<?php 
				if($betOpen){ 
				?>
				<!-- YOU CAN BET -->
				<tr id="betGames" class="betGames">
					<td style="text-align:center;"><?php echo date("d M H:i", strtotime($game_start));?></td>
					<td class="mobile_hide" style="text-align:right;"><?php echo $home_name;?></td>
					<td style="text-align:center;"><img class="flag" src="img/<?php echo $home_flag; ?>" /></td>
					<td style="text-align:center;"> VS </td>
					<td style="text-align:center;" ><img class="flag" src="img/<?php echo $away_flag; ?>" />
					<td style="text-align:left;" class="mobile_hide"><?php echo $away_name;?></td>
					<td style="text-align:right;"><input class="goal_home" original="<?php echo $goal_home; ?>" type="number" gameID="<?php echo $game_id; ?>" value="<?php echo $goal_home; ?>" /></td>
					<td style="text-align:center;">-</td>
					<td style="text-align:left;"><input class="goal_away" original="<?php echo $goal_away; ?>" type="number" gameID="<?php echo $game_id; ?>" value="<?php echo $goal_away; ?>"/></td>
					<td>
						<div class="error">
							Du måste fylla i båda fälten
						</div>
						
						<input class="game_id" type="hidden" name="game_id[]" value="<?php echo $game_id; ?>" />
					</td>
				</tr>
				<?php 
				}
				else{ 

					
					?>
					<tr class="toggleTr" rel="<?php echo $game_id; ?>">
						<td style="text-align:center;" class="locked"><?php echo date("d M H:i", strtotime($game_start));?></td>
						<td style="text-align:right;" class="locked mobile_hide"><?php echo $home_name;?>
						<td style="text-align:center;" class="locked"><img class="flag" src="img/<?php echo $home_flag; ?>" /></td>
						<td style="text-align:center;" class="locked"> VS </td>
						<td style="text-align:center;" class="locked"><img class="flag" src="img/<?php echo $away_flag; ?>" /></td>
						<td style="text-align:left;" class="locked mobile_hide"><?php echo $away_name;?></td>
						<td style="text-align:center;" class="locked" colspan="3"><?php echo $goal_home; ?> - <?php echo $goal_away; ?></td>
						<td style="text-align:center;" class="locked">Resultat </br>(<?php echo $result_goal_home; ?> - <?php echo $result_goal_away; ?>)</td>
					</tr>
					<tr class="togglable" id="togglable_<?php echo $game_id; ?>" style="display:none;background-color:#E6E86C">
					
						<td colspan="10">
							<table width="100%" >
									<?php
										foreach ($betsRows as $key => $value) {
											//print_r($key);
											if($value[0] == $game_id){
												?>
												<tr>
													<td style="text-align:left;">
														<?php
															echo $value[1];
														?>
													</td>
													<td style="text-align:right;">
														<?php
															echo $value[2];
														?>
														-
														<?php
															echo $value[3];
														?>
													</td>
												</tr>
												<?php
											}
										}
										//print_r($betsRows);
									?>
							</table>

						</td>
					</tr>
				<?php } //slut på else ?>
			</tbody>
		</table><?php 
		} // end while ?>
		<button id="check" class="col-sm-12 btn btn-default" name="save_bets" data-toggle="modal" data-target="#myModal" value="Spara Bets">spara bets</button>
		</div><!-- team_bet -->
	</div>
</div>

<script src="js/bet_checker.js"></script>
<script src="js/toggleTableRow.js"></script>


