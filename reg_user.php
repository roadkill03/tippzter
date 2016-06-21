
<?php
include 'includes/db_connect.php';
//Saves the values from the registration form into the database.
$username = mysqli_real_escape_string($db_connect,$_POST['username']);
$password = md5(mysqli_real_escape_string($db_connect,$_POST['password']));
$email = mysqli_real_escape_string($db_connect,$_POST['email']);
echo $email;
$premisson = 'false';
$sql = "INSERT INTO users (user_name, user_password, user_email, admin)
VALUES ('$username', '$password', '$email', '$premisson')";

if(mysqli_query($db_connect, $sql)){
	//success
	header("Location: index.php");

}else{
	// echo a error message if the query dident work.
	echo "Error: ". $sql . "<br>" . mysqli_error($db_connect);
}
?>

