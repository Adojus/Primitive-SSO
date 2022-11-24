<?php

session_start();

include("connection.php");

$user_id=$_SESSION['user_id'];

	//visi 4 uzcommentinti
	//$query_deactivate="UPDATE Naudotojai SET aktyvus = 0 WHERE naudotojo_id = '$user_id' limit 1";
	//mysqli_query($con,$query_deactivate);
	
	//$query_deactivate_login="UPDATE Prisijungimai SET aktyvus = 0 WHERE naudotojo_id = '$user_id' AND aktyvus = 1  limit 1";
	//mysqli_query($con,$query_deactivate_login);

if(isset($_SESSION['user_id']))
{
	$query_deactivate="UPDATE Naudotojai SET aktyvus = 0 WHERE naudotojo_id = '$user_id' limit 1";
	mysqli_query($con,$query_deactivate);
	
	$query_deactivate_login="UPDATE Prisijungimai SET aktyvus = 0 WHERE naudotojo_id = '$user_id' AND aktyvus = 1  limit 1";
	mysqli_query($con,$query_deactivate_login);
	
	unset($_SESSION['user_id']);
}
	unset($_SESSION['user_id']);
header("Location: login.php");
die;