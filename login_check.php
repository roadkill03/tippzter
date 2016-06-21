<?php
	include "includes/db_connect.php"; 
	session_start();

	//Om man har klickat på logga in knappen, kontrollera mot db
	//if(isset($_POST["login_btn"])) {
		//Initiering av variabler
		$email = $_POST["login_email"];
		$password = md5($_POST["login_password"]);

		$sql = "SELECT * FROM users WHERE user_email = '$email' AND user_password = '$password'";
		$result = mysqli_query($db_connect, $sql);
		$row = mysqli_fetch_assoc($result);
		if($row == 0){

			header("Location: index.php?logerror=1");

		}else{
			if($row['admin'] == 'false'){
				$_SESSION['user_loggedin'] = 'true';
				$_SESSION['user_name'] = $row['user_name'];
				$_SESSION['user_id'] = $row['user_id'];
				header("Location: user_dash.php");
			}else{
				$_SESSION['admin_loggedin'] = 'true';
				$_SESSION['user_name'] = $row['user_name'];
				$_SESSION['user_id'] = $row['user_id'];
				header("Location: admin_dash.php");
			}
		}

	$db_connect->close();
?>