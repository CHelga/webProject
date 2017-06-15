<?php
require 'core.inc.php';
require 'connection.php';

$bejelentkezettid = $_SESSION['user_id'];

//felhasznalonak az id-ja	
$id = $_POST['felh'];

if ($id == $bejelentkezettid) {
    $_SESSION["error"] = "Saját magát nem törölheti ki.";
    header('Location:admin.php');
} else {
    $sql = "DELETE FROM projekt WHERE id=$id";
    if ($mysqli->query($sql) === TRUE) {
        $_SESSION["error"] = "Sikeresen kitörölte a felhasználot.";
        header('Location:admin.php');
    } else {
        $_SESSION["error"] = "Nem sikerült kiötörölnie a felhasználot.";
        header('Location:admin.php');
    }
}
?>

