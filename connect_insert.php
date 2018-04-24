<?php
require 'connection/connect_to_session.php';
require 'connection/connection.php';

$felhasznalo = $_SESSION['user_id'];
$oldal = "SELECT admin FROM projekt WHERE id=$felhasznalo";
$myData = mysqli_query($mysqli, $oldal);
$record = mysqli_fetch_assoc($myData);
$admin = $record['admin'];

//SQL injection megelőzése
$cim = mysqli_real_escape_string($mysqli, $_POST['cim']);
$varos = mysqli_real_escape_string($mysqli, $_POST['varos']);
$terulet = mysqli_real_escape_string($mysqli, $_POST['terulet']);
$penz = mysqli_real_escape_string($mysqli, $_POST['penz']);
$ara = mysqli_real_escape_string($mysqli, $_POST['ara']);
$szobaszam = mysqli_real_escape_string($mysqli, $_POST['szobaszam']);
$comment = mysqli_real_escape_string($mysqli, $_POST['comment']);
//$datum = mysqli_real_escape_string($mysqli, $_POST['datum']);
$datum = date("Y.m.d");

if (empty($cim) || empty($varos) || empty($terulet) || empty($penz) || empty($ara) || empty($szobaszam) || empty($comment)) {

	$_SESSION["error"] = "Sikeretlen feltöltés.  Kérem adja meg az összes beszúráshoz szükséges adatot.";
	if ($admin == 0) {
		header('Location:index.php');
	} else {
		header('Location:admin.php');
	}
} else {

	if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 4000000)
	) {
		if ($_FILES['file']['error'] > 0) {
			echo "return code : " . $_FILES['file']['name'];
		} else if (file_exists('style/uploaded_images/' . $_FILES['file']['name'])) {
			echo $_FILES['file']['name'] . "Mar letezik! ";
		} else if (move_uploaded_file($_FILES["file"]["tmp_name"], "style/uploaded_images/" . $_FILES["file"]["name"])) {
			$part = $_FILES['file']['name'];
		}
		//optimazing the image uploading system

		// $image_path = "style/uploaded_images/";
		// $new_name = time() . uniqid(rand());
		// $destFile = $image_path . $new_name . '.jpg';
		// $filename = $_FILES["img"]["tmp_name"];
		// list($width, $height) = getimagesize($filename);
		// move_uploaded_file($filename, $destFile);

	} else {
		$_FILES["file"]["name"] = 'no_image.jpg';
	}

	$part = $_FILES['file']['name'];

	$sql = "INSERT INTO pajax (id, cim,  varos, terulet, penzerme, ar, szobaszam, comment, felhasznalo, kep, datum)
				VALUES ('', '$cim', '$varos', '$terulet', '$penz', '$ara', '$szobaszam', '$comment', '$felhasznalo', '$part', '$datum')";

	if (!mysqli_query($mysqli, $sql)) {
		$_SESSION["error"] = "Nem sikerült feltegye a hirdetést.Probálja ujra."; // kiiratom, hogy nem talaltam ilyent
		if ($admin == 0) {
			header('Location:index.php');
		} else {
			header('Location:admin.php');
		}
	} else {
		$_SESSION["error"] = "Sikeresen feltette  a hirdetést."; // kiiratom, hogy nem talaltam ilyent
		if ($admin == 0) {
			header('Location:index.php');
		} else {
			header('Location:admin.php');
		}
	}
}

?>