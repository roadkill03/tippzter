<?php 
 	include 'includes/header.php';

/*
* Kolla om användaren är inloggad som admin, om inte, skicka till index.php 
*/
if($_SESSION['admin_loggedin'] != 'true') {
	header("Location: index.php");
}
?>
<div class="container">
<a href="logout.php">Logga Ut</a>
	<div class="row">
		
		<!-- REGISTERING AV LAG -->
<!-- 		<div id='team_reg' class="col-sm-12">
			<h1>Registrate teams</h1>
			<form enctype="multipart/form-data" action='team_reg.php' method='post'>
				<label>Team:</label></br>
				<input type='text' name='country' placeholder='country'></br>
				<label>Team-flag:</label>
				<input type='file' name='country_flag' accept='image/*' multiple></br>
				<label>Group:</label></br>
				<input type='text' name='group_reg' placeholder='group'></br>
				<input type='submit' name='team_reg_btn' value='Registrate'>
			</form>	
		</div> --><!-- #team_reg -->

		<!-- REGISTERING AV MATCHER -->
<!-- 		<div id='game_reg'>
			<h1>Registrate games</h1>
			<form action='game_reg.php' method='post'>
				<label>Home-team:</label></br>
				<input type='text' name='home_team' placeholder='home_team'></br>
				<label>Away-team:</label></br>
				<input type='text' name='away_team' placeholder='away_team'></br>
				<label>Game date:</label></br>
				<input type='date' name='game_date' placeholder='game_date'></br>
				<label>Game time:</label></br>
				<input type='time' name='game_time' placeholder='game_time'></br>
				<input type='submit' name='game_reg_btn' value='Registrate'>
			</form>	
		</div> -->
		

		<!-- REGISTERING AV VINNARE -->		
		
		<div class="result_winner col-sm-12">
			<h1>Registrate winner</h1>

			<?php
			$query1 = "SELECT team_name, team_id FROM teams";
			$result1 = $db_connect->query($query1);
			?>

			<form action="includes/save_result.php" method="post">
				<label for="player">Målkung:</label></br>
				<input type="text" name="player" /></br>

				<label for="winning_team">EM-vinnare 2016:</label></br>
				<select name="selected_team"> 
					<?php
					while($row = mysqli_fetch_assoc($result1)) { 
						?>
						<option value="<?php echo $row['team_id']; ?>"><?php echo $row['team_name']; ?></option>
					<?php 
					} 
					?>
				</select></br>
				<input type="submit" value="Spara"/>
			</form>	
		</div>



		<!-- REGISTERING AV RESULTAT -->
		<div class="result_reg col-sm-12">
			<h1>Registrate results</h1>
			
			<?php
			$query = "SELECT allGames.*, results.result_goal_home, results.result_goal_away FROM
					  (SELECT T1.team_name as team_home, T2.team_name as team_away, 
					  			T1.team_flag as home_flag, T2.team_flag as away_flag, game_match.* 
					  FROM game_match, teams T1, teams T2
					  WHERE T1.team_id=game_match.home_team_id AND
					  		T2.team_id=game_match.away_team_id) as allGames
					  
					  LEFT OUTER JOIN 
					  (SELECT * FROM results) as results
					  ON allGames.game_id = results.game_id
					  ORDER BY allGames.game_id";

			$result = $db_connect->query($query);

			while($row = mysqli_fetch_assoc($result)) {

				$game_id = $row["game_id"];
				$home_name = $row["team_home"];
				$away_name = $row["team_away"];
				$home_flag = $row["home_flag"];
				$away_flag = $row["away_flag"];
				$goal_home = $row["result_goal_home"];
				$goal_away = $row["result_goal_away"];
				$home_team_id = $row["home_team_id"];
				$away_team_id = $row["away_team_id"];
				
				?>
				<form method="post" action="includes/save_result.php">
					<table class="table1 col-sm-12">
						<tbody>
							<tr>
								<td style="width:25%; text-align:right;"><?php echo $home_name;?>
									<input type="hidden" name="home_team_id" value="<?php echo $home_team_id; ?>"></td>
								<td style="width:10%; text-align:center;"><img class="flag" src="img/<?php echo $home_flag; ?>" /></td>
								<td style="width:10%; text-align:center;"> VS 
									<input type="hidden" name="game_id" value="<?php echo $game_id; ?>"></td>
								<td style="width:10%; text-align:center;"><img class="flag" src="img/<?php echo $away_flag; ?>" />
									<input type="hidden" name="away_team_id" value="<?php echo $away_team_id; ?>"/></td>
								<td style="width:25%"><?php echo $away_name;?></td>
								<td><input type="number" name="home_goal" value="<?php echo $goal_home; ?>" /></td>
								<td>-</td>
								<td><input type="number" name="away_goal" value="<?php echo $goal_away; ?>"/></td>
								<td><input type='submit' style="float:right;" id="<?php echo $game_id ?>" name="save_result" value="Spara"/></td>
							</tr>
						</tbody>
					</table>
				</form>
				<?php
			}
			?>
		</div><!-- result_reg -->

		<!-- REGISTERING AV SLUTSPELRESULTAT -->
		<div class="result_reg col-sm-12">
			<h1>Registrate playoff-results</h1>
			
			<?php
			$query1 = "SELECT allGames.*, slutspel_result.result_goal_home, slutspel_result.result_goal_away 
					FROM (SELECT T1.team_name as team_home, T2.team_name as team_away, 
						T1.team_flag as home_flag, T2.team_flag as away_flag, slutspel.* 
						FROM slutspel, teams T1, teams T2 
						WHERE T1.team_id=slutspel.home_team_id AND T2.team_id=slutspel.away_team_id) 
						as allGames 

						LEFT OUTER JOIN 
						(SELECT * FROM slutspel_result) as slutspel_result 
						ON allGames.slutspel_id = slutspel_result.slutspel_id 
						ORDER BY allGames.slutspel_id";

			$result1 = $db_connect->query($query1);

			while($row = mysqli_fetch_assoc($result1)) {

				$slutspel_id = $row["slutspel_id"];
				$home_name = $row["team_home"];
				$away_name = $row["team_away"];
				$home_flag = $row["home_flag"];
				$away_flag = $row["away_flag"];
				$goal_home = $row["result_goal_home"];
				$goal_away = $row["result_goal_away"];
				$home_team_id = $row["home_team_id"];
				$away_team_id = $row["away_team_id"];
				
				?>
				<form method="post" action="includes/save_result.php">
					<table class="table1 col-sm-12">
						<tbody>
							<tr>
								<td style="width:25%; text-align:right;"><?php echo $home_name;?>
									<input type="hidden" name="home_team_id" value="<?php echo $home_team_id; ?>"></td>
								<td style="width:10%; text-align:center;"><img class="flag" src="img/<?php echo $home_flag; ?>" /></td>
								<td style="width:10%; text-align:center;"> VS 
									<input type="hidden" name="slutspel_id" value="<?php echo $slutspel_id; ?>"></td>
								<td style="width:10%; text-align:center;"><img class="flag" src="img/<?php echo $away_flag; ?>" />
									<input type="hidden" name="away_team_id" value="<?php echo $away_team_id; ?>"/></td>
								<td style="width:25%"><?php echo $away_name;?></td>
								<td><input type="number" name="home_goal" value="<?php echo $goal_home; ?>" /></td>
								<td>-</td>
								<td><input type="number" name="away_goal" value="<?php echo $goal_away; ?>"/></td>
								<td><input type='submit' style="float:right;" id="<?php echo $slutspel_id ?>" name="save_result" value="Spara"/></td>
							</tr>
						</tbody>
					</table>
				</form>
				<?php
			}
			?>
		</div><!-- result_reg -->

	</div><!-- #row -->
</div><!-- #container -->
<?php include 'includes/footer.php'; ?>