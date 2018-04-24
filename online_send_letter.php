<?php
require 'connection/connect_to_session.php';
require 'connection/connection.php';

$felhasznalo = $_SESSION['user_id'];
$oldal = "SELECT admin FROM projekt WHERE id=$felhasznalo"; //azért vizsgáljuk meg, hogy a végén tudjuk, hogy melyik oldalra kell visszatérni
$myData = mysqli_query($mysqli, $oldal);
$record = mysqli_fetch_assoc($myData);
$admin = $record['admin'];

//küldöttid -> felh
$kuldott = $_POST['felh']; //$kuldott = küldöttid
$uzenet = $_POST['myTextarea'];

$sql = "SELECT firstname FROM projekt WHERE id=$felhasznalo ";
$result = mysqli_query($mysqli, $sql);
while ($record = mysqli_fetch_array($result)) {
	$nev = $record['firstname'];
}

$sql = "INSERT INTO uzenetek (id, kuldottid, kapottid, level, kapottnev)
				VALUES ('','$felhasznalo', '$kuldott', '$uzenet', '$nev')";

if (!mysqli_query($mysqli, $sql)) {
	$_SESSION["error"] = "Nem sikerült elküldte az üzenetet, probálja ujból.";
	if ($admin == 0) {
		header('Location:index.php');
	} else {
		header('Location:admin.php');
	}
} else {
	$_SESSION["error"] = "Sikeresen elküldte az üzenetet kuldottid : $felhasznalo, kapottid : $kuldott, level: $uzenet, kapottnev : $nev .";
	if ($admin == 0) {
		header('Location:index.php');
	} else {
		header('Location:admin.php');
	}
}
?>