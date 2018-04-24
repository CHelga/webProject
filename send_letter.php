<?php

require 'connection/connect_to_session.php';
require 'connection/connection.php';

$felhasznalo = $_SESSION['user_id']; //sajat id-m
$admine = $_SESSION['admin'];
//felhaszalo ID = felh
$felh = $_POST['felh']; //a felhasznaloID-ja akinek akarom kuldeni az uzenetet (akie a hirdetes)

//osszehasonlitjuk a felhasznalo id-ját a küldött id-val
if ($felhasznalo == $felh) {
	$_SESSION["error"] = "Ez az ön hirdetése. Saját magának nem küldhet levelet .";
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

$oldal = "SELECT admin FROM projekt WHERE id=$felhasznalo"; // kivalasztjuk az admin-t ahol a felhasznalo id-ja = $felhasznalo-val
$vizsgal = mysqli_query($mysqli, $oldal);
while ($record = mysqli_fetch_assoc($vizsgal)) {
	$admin = $record['admin']; //kimentjuk az $admin -ba azt,hogy admin-e vagy nem
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Üzenet irás </title>
    <meta charset=UTF-8>
    <script type="text/javascript" src="index.js"></script>
    <script type="text/javascript" src="offline.js"></script>
    <link rel="stylesheet" type="text/css" href="stilus.css">
</head>
<body id="uzenet">
<form id="myForm" enctype="multipart/form-data" action="online_send_letter.php" method="POST">
    <h1>Kérem irja ide az üzenetet. </h1>
    <div id="uzenetkuldes">
        <input type="hidden" value=" <?php echo $felh; ?>" id="felh" name="felh">
        <input type="hidden" value=" <?php echo $felhasznalo; ?>" id="felhasznalo" name="felhasznalo">
        <textarea cols="50" rows="15" id="myTextarea" name="myTextarea"></textarea>
        <br><br>
        <input type="submit" name="kuldes" value="Küldés" id="kuldes" onclick="modositas_lementese()"/>
        <button onclick="goBack()" name="Mégsem" value="Mégsem" id="kuldes">Mégsem</button>

    </div>
</form>
</body>
</html>
