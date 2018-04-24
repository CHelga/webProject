<?php

$mysqli = mysqli_connect("localhost", "root", "", "projekt" ); 

	if ($mysqli->connect_errno) {
		echo "Nem sikerult kapcsolodni a MYSQL-hez: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
?>

