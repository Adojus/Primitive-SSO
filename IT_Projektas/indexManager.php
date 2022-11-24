<?php
session_start();

include("connection.php");
include("functions.php");

$user_data=check_login($con);

$permission=check_role("Vadybininkas");
//echo $permission;

$user_id=$_SESSION['user_id'];

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
			
			.duomenys{
				display: inline-block;
				margin: 0px 5px 10px 0px;
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
				<a href="./listManager.php" class="prisijungimai">
					<img class="logo" src="./list.png">
					Mokėjimai
				</a>
			</div>
		</header>
		<center ><h1 style='margin-top:100px;'>Vieningo prisijungimo portalas</h1></center><br>
		<?php echo "<center><h2 style='margin-top:100px; margin-bottom:100px;'>Vadybininkas {$user_data['slapyvardis']}!</h2></center>";?>

		
		<div class="ataskaita">
			<h2>Valdyti naujus mokėjimus</h2>
			<div class="container">
				<form method='post'>
					<div class="duomenys">
						<label for="paymentid" class="control-label">Įveskite ID:</label>
						<input name='paymentid' type='number' class="form-control input-sm" required>
					</div>
					<div class="duomenys">
						<label for="paymentstatus" class="control-label">Naujas statusas: </label>
						<select id="paymentstatus" name="paymentstatus">
						<option value="Priimtas">Priimtas</option>
						<option value="Atmestas">Atmestas</option>
						</select>
					</div>

					<div class="form-group col-lg-2">
						<input type='submit' name='update' value='Pakeisti' class="atrinkti">
					</div>
					
				</form>
						<?php
		if (isset($_POST["update"]))
		{
			$payment_id = $_POST['paymentid'];
			$payment_status=$_POST['paymentstatus'];
			$sql_validate="SELECT * FROM `Mokejimai` WHERE `id` = '$payment_id' AND `statusas` = 'Pateiktas'";
			$result = mysqli_query($con, $sql_validate);
			$answer = mysqli_fetch_assoc($result);
			if((mysqli_num_rows($result)==1) && ($answer['naudotojo_id'] != $_SESSION['user_id'])){
				$sql = "UPDATE `Mokejimai` SET statusas = '$payment_status' WHERE `id` = $payment_id";
				if (!mysqli_query($con, $sql)) die("Klaida įrašant:" . mysqli_error($con));
				
				if($payment_status=="Priimtas"){
					$sql_2 = "UPDATE `Naudotojai` SET `ar_susimokejes` = 1 WHERE `naudotojo_id` = $answer[naudotojo_id]";
					if (!mysqli_query($con, $sql_2)) die("Klaida įrašant:" . mysqli_error($con));
				}
			}
			else
			{
				echo "<p style='color:red; font-weight:bold;'>Negalimas veiksmas.<p>";
			}
		}	
		?>
			</div>
				<div>
					<?php
				$query="SELECT id,naudotojo_id,data, statusas FROM `Mokejimai` WHERE `statusas`='Pateiktas' ORDER BY `id` DESC";
				$result = mysqli_query($con, $query);
				if(mysqli_num_rows($result)>0){
					echo "<table style='margin: 0px auto;' id='prisijungimai'>";
					echo "<tr> 
					<th>ID</th>
					<th>Naudotojo ID</th>
					<th>Data</th>
					<th>Statusas</th></tr>";
						while ($row = mysqli_fetch_assoc($result)) {
							echo "<tr>
					<td>" . $row['id'] . "</td>
					<td>" . $row['naudotojo_id'] . "</td>
					<td>" . $row['data'] . "</td>
					<td>" . $row['statusas'] . "</td>
					</tr>";
						}
					echo "</table>";
				}
				else{
					echo "<p style='color:red; font-weight:bold;'>Naujų mokėjimų nėra.<p>";
				}
				?>
			</div>
		</div>

		<footer><p>Justinas Adomaitis IFAi-0, KTU 2022</p></footer>
	</body>
	
</html>