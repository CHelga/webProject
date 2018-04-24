<?php
require 'connection/connect_to_session.php';
require 'connection/connection.php';

$bejelentkezettid = $_SESSION['user_id']; // felhasznalonak az id-ja
$oldal = "SELECT admin FROM projekt WHERE id=$bejelentkezettid"; // kivalasztjuk az admin-t ahol a felhasznalo id-ja = $bejelentkezettid-val
$result = $mysqli->query($oldal);
while ($record = $result->fetch_assoc()) {
	$admin = $record['admin']; //kimentjuk az $admin -ba azt,hogy admin-e vagy nem
}

//a hiretesnek az id-ja
$id = $_POST['hirdetesid'];
$fel = "SELECT felhasznalo FROM pajax  WHERE id=$id"; //megvizsgaljuk, hogy melyik hirdetest akarjuk kitorolni
$result = $mysqli->query($fel);

if ($result->num_rows > 0) {
	while ($record = $result->fetch_assoc()) {
		$sql = "SELECT * FROM pajax WHERE id = $id";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while ($row = $result->fetch_assoc()) {
				$sql = "DELETE FROM pajax WHERE id=$id";

				if ($mysqli->query($sql) === TRUE) {

					$_SESSION["error"] = "Sikeresen kitörölte a hirdetést."; // kiiratom, hogy nem talaltam ilyent
					if ($admin == 0) {
						header('Location:index.php');
					} else {
						header('Location:admin.php');
					}
				} else {
					$_SESSION["error"] = "Nem sikerült kitörölnie a hirdetést, probálja ujra."; // kiiratom, hogy nem talaltam ilyent
					if ($admin == 0) {
						header('Location:index.php');
					} else {
						header('Location:admin.php');
					}
				}
			}
		} else {
			$_SESSION["error"] = "Nem sikerült kitörölnie a hirdetést, probálja ujra."; // kiiratom, hogy nem talaltam ilyent
			if ($admin == 0) {
				header('Location:index.php');
			} else {
				header('Location:admin.php');
			}
		}
	}
}

?>

