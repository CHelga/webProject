<!DOCTYPE html>
<html>
<head>
    <title>Hirdetések</title>
    <meta charset=UTF-8>
    <link rel="stylesheet" type="text/css" href="kereses.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php

require 'connection.php';

$sql = "SELECT * FROM pajax";
$myData = mysqli_query($mysqli, $sql);

while ($record = mysqli_fetch_object($myData)) {

    $felh = $record->felhasznalo;
    ?>
    <table id="kereses_tabla">
        <tbody>
        <tr>
            <td id="kep_rama">
                <?php
                echo "<img id='kep_meretezes' src='upload/$record->kep'>";
                ?>
            </td>
            <td>
                <p id="cim_iras_tipus">
                <h2><?php echo $record->cim ?></h2></p>
                <p><?php echo "Város : " . $record->varos; ?></p>
                <p><?php echo "Terület : " . $record->terulet ?></p>
                <p><?php echo "Ára : " . $record->ar . "  " . $record->penzerme ?></p>
                <p><?php echo "Szoba : " . $record->szobaszam ?></p>
                <p><?php echo "Leírás : " . $record->comment ?></p>
            </td>

            <td id="datum_elhelyezese">
                Feltöltési dátuma
                <p id="datum_elhelyezese_szam">
                    <strong><br><?php echo $record->datum; ?></strong>
                </p>
            </td>
            <td id="edit_buttons_space">
                <form action="uzenetkuldes_proba.php" enctype="multipart/form-data" method="POST" id="form_level">
                    <input type="hidden" value=" <?php echo $felh; ?>" id="felh" name="felh"/>
                    <button type="submit" name="level" id="level" class="btn btn-primary btn-md">Levél küldés</button>
                </form>
            </td>
        </tr>
        </tbody>
    </table><br><br>
    <?php
}
mysqli_close($mysqli);
?>
</body>
</html>

