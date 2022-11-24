<?php


function check_role($role){
	if($_SESSION['role']==$role)
	{
		return $_SESSION['role'];
	}
	else if ($_SESSION['role']=="Klientas"){
		header("Location: index.php");
		die;
	}
	else if ($_SESSION['role']=="Administratorius"){
		header("Location: indexAdmin.php");
		die;
	}
}

function check_login($con)
{
	if(isset($_SESSION['user_id']))
	{
		$id=$_SESSION['user_id'];
		$query="select * from  Naudotojai where naudotojo_id = '$id' limit 1";
		
		$result=mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}
	//back to login
	header("Location: login.php");
	die;
}

//create naudotojo_id
function random_num($length)
{
	$text = "";
	if($length < 5)
	{
		$length=5;
	}
	
	$len = rand(4,$length);
	for($i=0;$i<$len;$i++)
	{
		$text .= rand(0,9);
	}
	return $text;
}