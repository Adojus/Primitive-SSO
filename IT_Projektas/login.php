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
					$_SESSION['user_id']=$user_data['naudotojo_id'];
					$_SESSION['role']=$user_data['role'];
					$_SESSION['has_paid']=$user_data['ar_susimokejes'];
					

					
					$user_id = $_SESSION['user_id'];
					$email = $user_data['epastas'];
				
					
					

					
					$ip_address= $_SERVER['REMOTE_ADDR'];
					//$ip_address='127.0.0.1';
					
					$query_insert_login="insert into Prisijungimai (ip_adresas,naudotojo_id,epastas) values ('$ip_address','$user_id','$email')";
					mysqli_query($con,$query_insert_login);
					
					
					$query_activate="UPDATE Naudotojai SET aktyvus = 1 WHERE slapyvardis = '$user_name' limit 1";
					mysqli_query($con,$query_activate);
					
					if($_SESSION['role']=="Klientas"){
						$query_insert_message="insert into Zinutes (naudotojo_id,tekstas) values ('$user_id','$user_name prisijungta is IP adreso: $ip_address')";
						mysqli_query($con,$query_insert_message);
					}
					
					//$_SESSION['user_id']=$user_data['naudotojo_id'];
					if($user_data['role'] == 'Klientas'){
					header("Location: index.php");
					die;
					}
					else if($user_data['role'] == 'Administratorius'){
					header("Location: indexAdmin.php");
					die;
					}
					else{
					header("Location: indexManager.php");
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
		<title>Vieningo prisijungimo portalas</title>
		
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
				<center><div style="font-size: 20px;margin: 15px;color:white;">PRISIJUNGTI</div></center>
				
				<center>
					<b>Slapyvardis</b><br>
				<input id="text" type="text" name="user_name" required><br><br>
					<b>Slaptažodis</b><br>
				<input id="text" type="password" name="password" required><br><br>
				<aa><input class="atrinkti" type="submit" value="Patvirtinti"></aa><br><br>
				<a href="signup.php">Registruotis</a><br><br>
				</center>
			</form>
		</div>
	</body>
	
</html>