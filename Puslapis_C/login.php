<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD']=="POST")
{
	//SOMETHING WAS POSTED
	$user_name=$_POST['user_name'];
	$password=$_POST['password'];

	
	if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
	{
		
		//read from database
		$query="select * from Naudotojai where slapyvardis = '$user_name' limit 1";
		$result = mysqli_query($con,$query);
		
		
		if($result)
		{
			if($result && mysqli_num_rows($result) > 0)
			{
				$user_data = mysqli_fetch_assoc($result);
				if(password_verify($password,$user_data['slaptazodis']))
				//if($user_data['slaptazodis'] === $password)
				{
					$_SESSION['role']=$user_data['role'];
					
					$query_activate="UPDATE Naudotojai SET aktyvus = 1 WHERE slapyvardis = '$user_name' limit 1";
					mysqli_query($con,$query_activate);
					$_SESSION['user_id']=$user_data['naudotojo_id'];
					
					if($user_data['role'] == 'Klientas'){
					header("Location: index.php");
					die;
					}
					else if($user_data['role'] == 'Administratorius'){
					header("Location: indexAdmin.php");
					die;
					}
				}
			}
		}
		echo "Neteisingas slapyvardis arba slaptažodis.";
	}
	else
	{
		echo "Neteisingas slapyvardis arba slaptažodis.";
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Puslapis A</title>
	</head>
	<body style = "background-color: yellow;">
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
		
		
		<center><h1>Puslapis A</h1></center>
		<div id="box">
			<form method="post">
				<center>
					
					<div style="font-size: 20px;margin: 10px;color:white;">Prisijungti prie A</div>

					<input id="text" type="text" name="user_name"><br><br>
					<input id="text" type="password" name="password"><br><br>

					<input id="button" type="submit" value="Patvirtinti"><br><br>

					<a href="signup.php">Prisiregistruoti</a><br><br>
				</center>
			</form>
		</div>
	</body>
	
</html>