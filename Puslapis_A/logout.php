<?php

session_start();

include("connection.php");

$user_id=$_SESSION['user_id'];

if(isset($_SESSION['user_id']))
{
	
	$query_activate="UPDATE Naudotojai SET aktyvus = 0 WHERE naudotojo_id = '$user_id' limit 1";
	mysqli_query($con,$query_activate);
	
	//unset($_SESSION['user_id']);
}
//header("Location: http://php.lab/IT_Projektas/logout.php");
header("Location: login.php");
die;