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
		echo "Įvesti duomenys netinkami!";
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
			body {
 				/*background-image: url("wall.jpg");*/
 				background-color: rgb(248, 248, 248);
				height:1300px;
				padding:0;
				margin:100px 0 0 0;
				font-family:Arial;
			}
			p{
			font-family:arial;
			}
			a {
			  color: inherit;
			  
			  cursor: pointer;
			}
			
						.ataskaita{
				position:relative;
				text-align:center;
				background-color:white;
				margin: 100px auto;
				border: solid 1px black;
				border-radius:5px;
				width:20%;
				justify-content:center;
				padding:10px 0px 50px 0px;
				min-width:230px;
			}
			
			.atrinkti{
				font-family:arial;
				font-size:18px;
				border:none;
				border-radius:3px;
				padding:6px 10px 6px 10px;
				margin: 5px 0px 15px 0px;
				background-color:#ddd;
				cursor:pointer;
				transition: opacity 0.2s,box-shadow 0.2s;
			}
			.atrinkti:hover{
				box-shadow:2px 2px 4px rgba(0,0,0,0.2);
			}
			.atrinkti:active{
				opacity:0.5;
			}
			
			#text{
			height: 25px;
			border-radius: 5px;
			padding: 4px;
			border: solid thin #aaa;
			}
			
			#button{
			border-radius: 3px;
			padding: 10px;
			width:100px;
			color: black;
			background-color: lightblue;
			border: none;
			}
			
			#box{
				border-radius: 25px;
				background-color:grey;
				margin:auto;
				width:300px;
				padding:20px;
				border-style:solid;
			}
		</style>
		<center><h1>Vieningo prisijungimo portalas</h1></center><br>
		<div class="ataskaita">
			<form method="post">
				<center>
					
				<div style="font-size: 20px;margin: 15px;color:white;">REGISTRUOTIS</div>
				<b>Slapyvardis</b><br>
				<input id="text" type="text" name="user_name" required><br><br>
				<b>Slaptažodis</b><br>
				<input id="text" type="password" name="password" required><br><br>
				<b>Vardas</b><br>
				<input id="text" type="text" name="name" required><br><br>
				<b>Pavardė</b><br>
				<input id="text" type="text" name="surname" required><br><br>
				<b>El. Paštas</b><br>
				<input id="text" type="email" name="email" required><br><br>

				
				<input class="atrinkti" type="submit" value="Patvirtinti"><br><br>
				
				<a href="login.php">Prisijungti</a><br><br>
					</center>
			</form>
		</div>
	</body>
	
</html>