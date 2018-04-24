<?php
require 'connection/connect_to_session.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$bejelentkezettid = $_SESSION['user_id']; // felhasznalonak az id-ja
$oldal = "SELECT admin FROM projekt WHERE id=$bejelentkezettid"; // kivalasztjuk az admin-t ahol a felhasznalo id-ja = $bejelentkezettid-val
$result = $conn->query($oldal);
while ($record = $result->fetch_assoc()) {
	$admin = $record['admin']; //kimentjuk az $admin -ba azt,hogy admin-e vagy nem
}

//a hiretesnek az id-ja
$id = $_POST['felh'];
$fel = "SELECT felhasznalo FROM pajax  WHERE id=$id"; //megvizsgaljuk, hogy melyik hirdetest akarjuk kitorolni
$result = $conn->query($fel);

if ($result->num_rows > 0) {
	while ($record = $result->fetch_assoc()) {
		$sql = "SELECT * FROM pajax WHERE id = $id";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while ($row = $result->fetch_assoc()) {
				$sql = "DELETE FROM pajax WHERE id=$id";

				if ($conn->query($sql) === TRUE) {

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

