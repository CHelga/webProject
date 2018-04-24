<!-- <?php
require 'connection/connect_to_session.php';
require 'connection/connection.php';

$felhasznalo = $_REQUEST['id']; //a felhasznaloID-ja akinek akarom kuldeni az uzenetet (akie a hirdetes)
$sajatid = $_REQUEST['lsajat'];
$uzenet = $_REQUEST['luzenet'];

$sql = "SELECT firstname FROM projekt WHERE id=$sajatid ";
$result = mysqli_query($mysqli, $sql);
while ($record = mysqli_fetch_array($result)) {
	$nev = $record['firstname'];
}

$sql = "INSERT INTO uzenetek (id, kuldottid, kapottid, level, kapottnev)
				VALUES ('','$sajatid', '$felhasznalo', '$uzenet', '$nev')";

mysqli_query($mysqli, $sql);
?> -->