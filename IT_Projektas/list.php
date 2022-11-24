<?php
session_start();

include("connection.php");
include("functions.php");

$user_data=check_login($con);
$user_id=$_SESSION['user_id'];
$permission=check_role("Klientas");

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
			.prisijungimai{
				font-weight:bold;
				background-color:rgb(230,230,230);
				cursor:default;
			}
			.left-section:hover, .pagrindinis:hover{
				background-color:rgb(248,248,248);

			}
			.left-section:active, .pagrindinis:active{
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
				position:relative;
				text-align:center;
				background-color:white;
				margin: 100px auto;
				border: solid 1px black;
				border-radius:5px;
				width:40%;
				justify-content:center;
				padding:10px 0px 50px 0px;
				min-width:400px;
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
			
			.container{
				border: solid 1px black;
				border-radius: 3px;
			}
			
			.date-picker{
				margin-top:5px;
				font-family:arial;
				font-size:14px;
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
			
			.prisijungimai_intervale p{
				color:red;
				font-weight:bold;
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
				<a href="./index.php" class="pagrindinis">
					<img class="logo" src="./home.png">
					Pagrindinis
				</a>
				<div class="prisijungimai">
					<img class="logo" src="./list.png">
					Prisijungimai
				</div>
				<a href="./messages.php" class="pagrindinis">
					<img class="logo" src="./message.png">
					Žinutės
				</a>
			</div>
		</header>
		<center ><h1 style='margin-top:100px;'>Vieningo prisijungimo portalas</h1></center><br>
		
		<div class="ataskaita">
			<h2>Ataskaita</h2>
			<div>
				<?php
				
				$query="SELECT laikas, ip_adresas FROM Prisijungimai WHERE naudotojo_id = '$user_id' AND aktyvus = 1";
				$result = mysqli_query($con, $query);
				$row = mysqli_fetch_assoc($result);
				echo "<p> Šį seansą prisijungta <strong>$row[laikas]</strong> 
				<br>iš IP adreso: <strong>$row[ip_adresas]</strong></p>"
				?>
			</div>
			<div >
				<h3>5 dažniausi IP adresai</h3>
				<?php
				
				$query="SELECT ip_adresas, count(ip_adresas) 
				AS `counter` FROM `Prisijungimai` WHERE `naudotojo_id` 
				= $user_id GROUP BY `ip_adresas` ORDER BY `counter` DESC limit 5";
				$result = mysqli_query($con, $query);
				
				echo "<table style='margin: 0px auto;' id='prisijungimai'>";
				echo "<tr> <th>Prisijungimų sk.</th>
				<th>IP adresas</th></tr>";
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>
				<td>" . $row['counter'] . "</td>
				<td>" . $row['ip_adresas'] . "</td>
				</tr>";
					}
				echo "</table>";
				?>
			</div>
		</div>
		
	
			<div class="ataskaita">
				<h2>Prisijungimai laiko intervale</h2>
				<form method="post">
					<div style="margin-top:10px;">
					<label for="from_time">Pasirinkite laiką nuo: </label>
					<br>
					<input class="date-picker" type="datetime-local" id="from_time" name="from_time" required>
					</div>
					<div style="margin-top:15px;">
					<label for="to_time" >Pasirinkite laiką iki: </label>
					<br>
					<input class="date-picker" type="datetime-local" id="to_time" name="to_time" required>
					</div>
						<br>
					<input class="atrinkti" type="submit" name="atrinkti" value="Atrinkti" >
				</form>
				<div class="prisijungimai_intervale"style="margin-top:20px;">
					<?php
					if (isset($_POST["atrinkti"]))
					//if ($_POST != null ) 
					{
						$from_time = $_POST['from_time'];
						$from_time = date("Y-m-d\TH:i", strtotime($from_time));

						$to_time = $_POST['to_time'];
						$to_time = date("Y-m-d\TH:i", strtotime($to_time));

						$sql = "SELECT `laikas`, `ip_adresas` FROM `Prisijungimai` WHERE `naudotojo_id`=
						$user_id AND `laikas` > '$from_time' AND `laikas` <
						'$to_time'";

						$result = mysqli_query($con, $sql);
						if(mysqli_num_rows($result)>0){

							echo "<table style='margin: 0px auto;' id='prisijungimai'>";
							echo "<tr> <th>Laikas</th>
							<th>IP adresas</th></tr>";
								while ($row = mysqli_fetch_assoc($result)) {
									echo "<tr>
							<td>" . $row['laikas'] . "</td>
							<td>" . $row['ip_adresas'] . "</td>
							</tr>";
								}
							echo "</table>";
						}
						else{
							echo "<p>Pasirinktame laiko intervale prisijungimų nėra.</p>";
						}

					}
					
					
					?>
				</div>
			</div>

		<footer><p>Justinas Adomaitis IFAi-0, KTU 2022</p></footer>
	</body>
	
</html>