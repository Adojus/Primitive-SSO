<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD']=="POST")
{
	//SOMETHING WAS POSTED
	$user_name=$_POST['user_name'];
	$password=$_POST['password'];
	$name=$_POST['name'];
	$surname=$_POST['surname'];
	$email=$_POST['email'];
	
	if(!empty($user_name) && !empty($password) && !is_numeric($user_name) &&
		!empty($name) && !empty($surname) && !empty($email))
	{
		$hashed_password = password_hash($password,PASSWORD_DEFAULT);
		//save to database
		$user_id = random_num(20);
		$query="insert into Naudotojai (vardas,pavarde,slaptazodis,epastas,slapyvardis,naudotojo_id) values ('$name','$surname','$hashed_password','$email','$user_name','$user_id')";
		
		mysqli_query($con, $query);
		
		header("Location: login.php");
		die;
	}
	else
	{
		echo "Įveskite tinkamus duomenis.";
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
	</head>
	<body>
		<style type="text/css">
			#text{
			height: 25px;
			border-radius: 5px;
			padding: 4px;
			border: solid thin #aaa;
			}
			
			#button{
			padding: 10px;
			width:100px;
			color: white;
			background-color: lightblue;
			border: none;
			}
			
			#box{
				background-color:grey;
				margin:auto;
				width:300px;
				padding:20px;
			}
		</style>
		
		<div id="box">
			<form method="post">
				<div style="font-size: 20px;margin: 10px;color:white;">Signup</div>
				Slapyvardis
				<input id="text" type="text" name="user_name"><br><br>
				Slaptazodis
				<input id="text" type="password" name="password"><br><br>
				Vardas
				<input id="text" type="text" name="name"><br><br>
				Pavarde
				<input id="text" type="text" name="surname"><br><br>
				El. Paštas
				<input id="text" type="email" name="email"><br><br>

				
				<input id="button" type="submit" value="Signup"><br><br>
				
				<a href="login.php">Click to login</a><br><br>
			</form>
		</div>
	</body>
	
</html>