<?php
$conn = mysqli_connect("localhost", "root", "");
if (!$conn) {
	die("Can not connect : " . mysqli_error());
}
mysqli_select_db($conn, "projekt");
?>