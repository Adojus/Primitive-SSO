<?php
session_start();

include("connection.php");
include("functions.php");

$user_data=check_login($con);
$user_id=$_SESSION['user_id'];


$permission=check_role("Klientas");
//echo $permission;

$payment = check_payment(false);

if($_SERVER['REQUEST_METHOD']=="POST")
{
	
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Vieningo prisijungimo portalas</title>
		
		<style type="text/css">
			body {
 				/*background-image: url("wall.jpg");*/
 				background-color: rgb(248, 248, 248);
				height:1300px;
				padding:0;
				margin:100px 0 0 0;
				font-family:Arial;
			}
			header{
				position:fixed;
				top:0;
				right:0;
				left:0;
				
				display:flex;
				justify-content:space-between;
				border-bottom: solid 1px black;
				
				height:50px;
				background-color:rgb(240,240,240);
				font-size:18px;
				z-index:1;
			}
			p{
			font-family:arial;
			}
			a {
			  color: inherit;
			  text-decoration: inherit;
			  cursor: pointer;
			}
			.logo{
				height:23px;
				margin-right:5px;
			}
			.logout-element{
				display:block;
				width:100%;
				height:100%;
				z-index:1;
				font-family:arial;
			}
			.left-section, .prisijungimai, .pagrindinis{
				cursor:pointer;
				display:flex;
				align-items:center;
				height:50px;
				padding: 0px 10px 0px 10px;
				transition: background-color 0.2s, opacity 0.2s;
				font-family:arial;
				
			}
			.pagrindinis{
				font-weight:bold;
				background-color:rgb(230,230,230);
				cursor:default;
			}
			.left-section:hover, .prisijungimai:hover{
				background-color:rgb(248,248,248);

			}
			.left-section:active, .prisijungimai:active{
				opacity:0.5;
			}
			.right-section{
				display:flex;
				align-items:center;
			}
			.puslapiai{
				height:200px;
			}
			
			.column {
				float: left;
				width: 33.33%;
			}
			.psl-foto{
			 	height:100px;
				width:100px;
				border-radius:50px;
			}
			
			.ataskaita{
				text-align:center;
				background-color:white;
				margin: 100px auto;
				border: solid 1px black;
				border-radius:5px;
				width:30%;
				justify-content:center;
				padding:10px 0px 50px 0px;
			}
			#prisijungimai {
				font-family: Arial;
				border-collapse: collapse;
				width: 70%;
				margin-top: 60px;
			}

			#prisijungimai td {
				border: 1px solid #ddd;
				padding: 8px;
			}

			#prisijungimai tr:nth-child(even) {
				background-color: #f2f2f2;
			}

			#prisijungimai tr:hover {
				background-color: #ddd;
			}

			footer{
				position: fixed; 
				bottom: 0; 
				left: 0; 
				right: 0;
				text-align: center;
				z-index:-1;
			}

			
		</style>
	</head>
	<body>
		<header>
			<a href="logout.php" class="left-section">
				<div>
					<img class="logo" src="./logout.png">
				</div>
				<div>
					<p>Atsijungti</p>
				</div>
				
			</a>
			<div class="right-section">
				<div class="pagrindinis">
					<img class="logo" src="./home.png">
					Pagrindinis
				</div>
				<a href="./list.php" class="prisijungimai">
					<img class="logo" src="./list.png">
					Prisijungimai
				</a>
				<a href="./messages.php" class="prisijungimai">
					<img class="logo" src="./message.png">
					Žinutės
				</a>
			</div>
		</header>
		<center ><h1 style='margin-top:100px;'>Vieningo prisijungimo portalas</h1></center><br>
		<?php echo "<center><h2 style='margin-top:100px; margin-bottom:100px;'>Sveiki, {$user_data['slapyvardis']}!</h2></center>";?>

		<div class="puslapiai">
			<div class="column">
				<center>
					<h2>Puslapis A</h2>
					<a href="http://php.lab/Puslapis_A/redirect.php" target="_blank">
					<img class="psl-foto" src="a.png" alt="Puslapio A foto">
					<br>Eiti</a>
				</center>
			</div>
			<div class="column">
				<center>
					<h2>Puslapis B</h2>
					<a href="http://php.lab/Puslapis_B/redirect.php" target="_blank">
					<img class="psl-foto" src="b.png" alt="Puslapio B foto">
					<br>Eiti</a>
				</center>
			</div>
			<div class="column">
				<center>
					<h2>Puslapis C</h2>
					<a href="http://php.lab/Puslapis_C/redirect.php" target="_blank">
					<img class="psl-foto" src="c.png" alt="Puslapio C foto">
					<br>Eiti</a>
				</center>
			</div>
		</div>

		<footer><p>Justinas Adomaitis IFAi-0, KTU 2022</p></footer>
	</body>
	
</html>