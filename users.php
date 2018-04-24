<!DOCTYPE html>
<html>
<head>
    <title> Felhasználok listája </title>
    <meta charset=UTF-8>
    <link rel="stylesheet" type="text/css" href="style/css/kereses.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>

<?php

require 'connection/connection.php';

$sql = "SELECT * FROM projekt";
$myData = mysqli_query($mysqli, $sql);

while ($record = mysqli_fetch_array($myData)) {
	$felh = $record['id'];
//		echo "surname:   " .$record['surname'] . "<br>";
	?>
<table id="felhaszalo_adatai_tabla">
    <tbody>
    <tr>
        <td id="felhasznalok_kiirasa">

            <p><?php echo "Felhasználo név: " . $record['username']; ?></p>
            <p><?php echo "Keresztnév: " . $record['firstname']; ?></p>
            <p><?php echo "Becenév: " . $record['surname']; ?></p>

        </td>
        <td>
            <form id="myForm" action="user_delete.php" method="POST">
                <input type="hidden" value=" <?php echo $felh; ?>" id="felh" name="felh"/>
                <button type="submit" name="delete" class="btn btn-primary btn-md" id="felhasznalok_torles_gomb">
                    Törlés
                </button>
            </form>
        </td>
    </tr>
    </tbody>
</table>
<br><br>
</body>
</html>
<?php
}
mysqli_close($mysqli);
?>
