<head>
    <link rel="stylesheet" type="text/css" href="style/css/kereses.css">
</head>
<?php

require 'connection/connection.php';

$sql = "SELECT * FROM pajax";
$myData = mysqli_query($mysqli, $sql);

while ($record = mysqli_fetch_object($myData)) {
	?>
    <table id="kereses_tabla">
        <tbody>
        <tr>
            <td id="kep_rama">
                <?php
echo "<img id='kep_meretezes' src='style/uploaded_images/$record->kep'>";
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
        </tr>
        </tbody>
    </table><br><br>
    <?php
}
mysqli_close($mysqli);

?>