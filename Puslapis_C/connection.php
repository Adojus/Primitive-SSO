<?php

$dbhost = "localhost";
$dbname = "vieningo_c";
$dbuser = "stud";
$dbpass = "stud";

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if (!$con) {
		die("Negaliu prisijungti prie MySQL:")
			. mysqli_error($con);
	}
