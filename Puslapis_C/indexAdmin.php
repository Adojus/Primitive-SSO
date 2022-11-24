<?php
session_start();

include("connection.php");
include("functions.php");

$user_data=check_login($con);
$user_id=$_SESSION['user_id'];


$permission=check_role("Administratorius");
//echo $permission;


if($_SERVER['REQUEST_METHOD']=="POST")
{
	
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Puslapis C - Administratorius</title>
		
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
				min-width:800px;
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

			
		</header>
		<center ><h1 style='margin-top:100px;'>Puslapis C - Administratorius</h1></center><br>
		<?php echo "<center><h2 style='margin-top:100px; margin-bottom:100px;'>Sveiki, {$user_data['slapyvardis']}!</h2></center>";?>

		
		
		
		<div class="ataskaita">
			<h2>Prisiregistravę naudotojai prie C</h2>
				<div>
					<?php
				$query="SELECT naudotojo_id,slapyvardis, epastas, role, aktyvus FROM `Naudotojai`";
				$result = mysqli_query($con, $query);
				
				echo "<table style='margin: 0px auto;' id='prisijungimai'>";
				echo "<tr> 
				<th>ID</th>
				<th>Slapyvardis</th>
				<th>El. paštas</th>
				<th>Rolė</th>
				<th>Aktyvumas</th>
				</tr>";
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>
				<td>" . $row['naudotojo_id'] . "</td>
				<td>" . $row['slapyvardis'] . "</td>
				<td>" . $row['epastas'] . "</td>
				<td>" . $row['role'] . "</td>
				<td>" . $row['aktyvus'] . "</td>
				</tr>";
					}
				echo "</table>";
				?>
			</div>
		</div>
		
		
		
		
		<footer><p>Justinas Adomaitis IFAi-0, KTU 2022</p></footer>
	</body>
	
</html>