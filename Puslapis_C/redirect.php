<?php
//buvo uzkomentuotas
session_start();

include("connection.php");
include("connectiontomain.php");

$user_ip=$_SERVER['REMOTE_ADDR'];

$query_main="select * from Prisijungimai where ip_adresas = '$user_ip' AND aktyvus = 1 limit 1";
$result_main = mysqli_query($con_main,$query_main);
if($result_main && mysqli_num_rows($result_main) > 0)
{
	$user_data_main = mysqli_fetch_assoc($result_main);
	$email = $user_data_main['epastas'];
	
	$query="select * from Naudotojai where epastas = '$email' limit 1";
	$result = mysqli_query($con,$query);
	
	if($result && mysqli_num_rows($result) > 0)
	{
		$_SESSION['role']=$user_data['role'];
		
		$user_data = mysqli_fetch_assoc($result);
		$_SESSION['user_id']=$user_data['naudotojo_id'];
		
		$user_id=$user_data['naudotojo_id'];
		
		$query_activate="UPDATE Naudotojai SET aktyvus = 1 WHERE naudotojo_id = '$user_id' limit 1";
		mysqli_query($con,$query_activate);
		
		if($user_data['role'] == 'Klientas'){
		header("Location: index.php");
		die;
		}
		else if($user_data['role'] == 'Administratorius'){
		header("Location: indexAdmin.php");
		die;
		}
	}
	else
	{
	header("Location: signup.php");
	die;
	}
}
else
{
	echo "Klaida.";
}
