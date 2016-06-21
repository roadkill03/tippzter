<?php 
/**
This checks what tournaments the user has joined and loops them out.

*/
include 'includes/header.php'; ?>

<?php
//This function loops out the result from the database and puts it in the array $rows.
function resultToArray($result) {
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

$sql = "SELECT tournament_id FROM user_tournaments WHERE user_id = '". $_SESSION['user_id'] ."'"; 
$result = $db_connect->query($sql);
$rows = resultToArray($result);
$result->free();

//loops out the result from the IDs we got from query and puts them in a new array.
$row_id = array();
for ($x = 0; $x < count($rows); $x++) {
    $row_id[] = $rows[$x]['tournament_id'];
} 
//we implode the values from the array $row_id and combine them to a string with "," as a seperator.
$comma_separated = implode(",", $row_id);


$sql = "SELECT tournament_id, tournament_name FROM tournament WHERE tournament_id IN ($comma_separated)";
$result = $db_connect->query($sql);

//loops out the group name that you are in.
while($row = mysqli_fetch_assoc($result)) { ?>
	
	<a href="tournaments_single.php?group=<?php echo $row['tournament_id']; ?>">
		<div>
			<h1><?php echo $row['tournament_name']; ?></h1>
		</div>
	</a>
	

<?php } ?>

<?php include 'includes/footer.php'; ?>