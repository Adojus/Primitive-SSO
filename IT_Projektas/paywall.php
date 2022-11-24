<?php
session_start();

include("connection.php");
include("functions.php");

$user_data=check_login($con);
$user_id=$_SESSION['user_id'];

$permission=check_role("Klientas");

$payment = check_payment(true);



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
			
			#box{
				border-radius: 5px;
				background-color:#f2f2f2;
				margin:auto;
				width:30%;
				padding:20px;
				border:solid 1px black;
			}
			
			.atrinkti{
				font-family:arial;
				font-size:18px;
				border:none;
				border-radius:3px;
				padding:6px 10px 6px 10px;
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
		</header>
		<center ><h1 style='margin-top:100px;'>Vieningo prisijungimo portalas</h1></center><br>
		<?php echo "<center><h2 style='margin-top:20px; margin-bottom:50px;'>Sveiki, {$user_data['slapyvardis']}!</h2></center>";?>
		<center><h2 style="color:red;">Susimokėkite 10 eurų mokestį, kad galėtumėte pradėti naudotis mūsų sistema.</h2></center>

		<div id="box">
			<form method="post">
				<center>
					
				<h2>Įveskite mokėjimo duomenis</h2>
				<b>Vardas</b><br>
				<input id="text" type="text" name="name" required><br><br>
				<b>Pavardė</b><br>
				<input id="text" type="text" name="surname" required><br><br>
				<b>Banko kortelės nr.</b><br>
				<input id="text" type="text" name="card" required><br><br>
				<b>CVC</b><br>
				<input id="text" type="password" name="cvc" required><br><br>
				<b>Adresas</b><br>
				<input id="text" type="text" name="address" required><br><br>

				
				<input class="atrinkti" id="pay" type="submit" value="Mokėti"><br><br>
					
					
				<?php
					
				$query_2="select * from Mokejimai where naudotojo_id = '$user_id' ORDER BY `id` DESC limit 1";
				$result_2 = mysqli_query($con,$query_2);
				$answer_2 = mysqli_fetch_assoc($result_2);
				if(mysqli_num_rows($result_2)==1){
					if($answer_2['statusas']=="Atmestas"){
						echo "<p style='color:red; font-weight:bold;'>Mokėjimas atliktas $answer_2[data] atmestas, bandykite iš naujo!<p>";
					}
					else{
						echo "<p style='color:orange; font-weight:bold;'>Mokėjimas gautas, laukite patvirtinimo!<p>";
					}
				}
					
				if($_SERVER['REQUEST_METHOD']=="POST")
				{
					$payment_query="SELECT * FROM `Mokejimai` WHERE `naudotojo_id` = $_SESSION[user_id]";
					$result=mysqli_query($con, $payment_query);
					$answer = mysqli_fetch_assoc($result);
					

					//SOMETHING WAS POSTED
					$name=$_POST['name'];
					$surname=$_POST['surname'];
					$card=$_POST['card'];
					$cvc=$_POST['cvc'];
					$address=$_POST['address'];
					
					if(mysqli_num_rows($result)==1 && $_SESSION['has_paid']==0 && $answer['statusas'] == "Pateiktas"){
						echo "<p style='color:red; font-weight:bold;'>Jūsų mokėjimas pateiktas, laukite patvirtinimo!<p>";
					}
					else if(strlen($cvc)==3 && strlen($card)==16 && is_numeric($cvc) &&
						   is_numeric($card))
					{
						$query="insert into Mokejimai (naudotojo_id) values ('$user_id')";

						mysqli_query($con, $query);
						echo "<p style='color:green; font-weight:bold;'>Sėkmingai pateikėt mokėjimą!<p>";

					}
					else
					{
						echo "<p style='color:red; font-weight:bold;'>Įvesti duomenys neteisingi!<p>";
					}

				}
					
				?>
				
					</center>
			</form>
		</div>
		
		<footer><p>Justinas Adomaitis IFAi-0, KTU 2022</p></footer>
	</body>
	
</html>