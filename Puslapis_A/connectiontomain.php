<?php

$dbhost = "localhost";
$dbname = "vieningo_sistema";
$dbuser = "stud";
$dbpass = "stud";

$con_main = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if (!$con_main) {
		die("Negaliu prisijungti prie MySQL:")
			. mysqli_error($con);
	}
