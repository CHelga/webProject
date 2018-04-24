<?php
require 'connection/connect_to_session.php';
require 'connection/connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Üzeneteim</title>
    <meta charset=UTF-8>
    <link rel="stylesheet" type="text/css" href="kereses.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php

$bejelentkezettid = $_SESSION['user_id'];

$sql = "SELECT * FROM uzenetek WHERE kapottid= $bejelentkezettid";
$myData = mysqli_query($mysqli, $sql);

while ($record = mysqli_fetch_array($myData)) {
	$felh = $record['kuldottid'];
	?>
<table id="uzenetek_tabla">
    <tbody>
    <tr >
        <td id="uzenet_cime">
            <h3> <?php echo "Küldte az üzenetet : " . $record['kapottnev']; ?></h3>
        </td>
    </tr>
    <br>
    <tr>
        <td id="uzenet_szoveg">
            <?php echo "Az üzenet tartalma:  <br> " . $record['level']; ?>
        </td>
    </tr>
    <br>
    <tr>
        <td id="button_padding">
        <form action="send_letter.php" enctype="multipart/form-data" method="POST" id="form_level">

            <input type="hidden" value=" <?php echo $felh; ?>" id="felh" name="felh"/>
            <button type="submit" name="level" class="btn btn-primary btn-md" id="level_kuldes"> Válaszolás</button>
        </form>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
<?php
}
mysqli_close($mysqli);
?>
