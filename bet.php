<?php
// include 'includes/header.php';

function resultToArray($result) {
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

$query = "SELECT tournament_id FROM user_tournaments WHERE user_id = '". $_SESSION['user_id'] ."'"; 
$result = $db_connect->query($query);
$rows = resultToArray($result);
$result->free();

$row_id = array();
for ($x = 0; $x < count($rows); $x++) {
    $row_id[] = $rows[$x]['tournament_id'];
} 

$comma_separated = implode(",", $row_id);
$hejhej = 0;

$query = "SELECT tournament_name, tournament_id FROM tournament WHERE tournament_id IN ($comma_separated)";

$result = $db_connect->query($query);
if( $result == true){
	$num_rows = mysqli_num_rows($result);
	if($num_rows > 1){ ?>
	
		<h2>Välj turnering</h2>
		<div class="form-inline col-sm-4">
			<select class="form-control" id="tournament_select" name="selected_tournament"> 
				<?php
				while($row = mysqli_fetch_assoc($result)) { 
					?>
					<option value="<?php echo $row['tournament_id']; ?>"><?php echo $row['tournament_name']; ?></option>
				<?php 
				} 
				?>
			</select>
			<button class="btn btn-defult" id="btn_select_tournament">Välj turnering</button>
		</div>
	<?php
	}else{ 
			$row = mysqli_fetch_assoc($result); ?>
			<h2 id="tour_heade"><?php echo $row['tournament_name']; ?></h2>
			<input id="tournament_id" type="hidden" value="<?php echo $row['tournament_id']; ?>"/>
	<?php 
	}
}else{?>
	<h3>Du är inte med i några grupper. <!-- Du kan skapa en genom att klicka --> <!-- <a href="create_group.php">här</a> --></h3>
<?php
}
	
	$db_connect->close();?>

