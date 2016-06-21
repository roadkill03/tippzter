<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>

<div class="container">
	<div class="row">
		<table class="table1 col-sm-12">
			<tbody>
		

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

			$result = mysqli_query($db_connect, $query);
				
			while($row = mysqli_fetch_assoc($result)){

				$game_id = $row["game_id"];
				$home_name = $row["team_home"];
				$away_name = $row["team_away"];
				$home_flag = $row["home_flag"];
				$away_flag = $row["away_flag"];
				$goal_home = $row["result_goal_home"];
				$goal_away = $row["result_goal_away"];
				$home_team_id = $row["home_team_id"];
				$away_team_id = $row["away_team_id"];
				$game_start = $row['game_start'];
				?>
			
				<tr>
					<td style="width:100px;"><?php echo date("d M H:i", strtotime($game_start)); ?></td>
					<td class="mobile_hide" style=" text-align:right;"><?php echo $home_name;?></td>
					<td style=" text-align:center;"><img class="flag" src="img/<?php echo $home_flag; ?>" /></td>
					<td style=" text-align:center;"> VS </td>
					<td style=" text-align:center;"><img class="flag" src="img/<?php echo $away_flag; ?>" /></td>
					<td class="mobile_hide"><?php echo $away_name;?></td>
					<td style="width:20px;"><?php echo $goal_home; ?></td>
					<td style="width:20px;">-</td>
					<td style="width:20px;"><?php echo $goal_away; ?></td>
				</tr>
				<?php							
			}
			?>
			</tbody>
		</table>
	</div><!--#row -->
</div><!-- #container -->
<?php include 'includes/footer.php'; ?>