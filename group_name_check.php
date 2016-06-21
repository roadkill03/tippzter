<?php
/**
This file gets information from ajax.js with ajax post, about what value username has. Then it will check aginst the database if the value allready exists or not and will return some of the values below.
Returns:
	1+ - Username unavailable
	0 - Username available
	-1 - Wrong request
**/
include 'includes/db_connect.php';
//Checks first if $_POST['username'] exists and if it exists if it has a value and in that case gives it do $username.
if(isset($_POST['groupName']) && $groupName = $_POST['groupName']){
	//Checks if the the value of $username is allready saved in the database with a mysqli query.
	$query=mysqli_query($db_connect, "SELECT * FROM tournament WHERE tournament_name='$groupName' ");
	//return how many rows it finds with the given value, if it finds 1 or more i means the value/username allready //exists and if it is a 0 it dident find a match and the value/username is avalible.
	$find=mysqli_num_rows($query);
	//echos the number of rows it found so ajax.js can make use of it.
	echo $find;
}else{
	//echos -1 if something with the request is wrong.
	echo -1;
}
?>