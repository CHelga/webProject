<!DOCTYPE html>
<html>
<head>
    <title>Saját hirdetéseim</title>
    <meta charset=UTF-8>
    <link rel="stylesheet" type="text/css" href="kereses.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<div id="felhasznalo_adatai">

    <?php
    require 'core.inc.php';
    require 'connection.php';


    $bejelentkezettid = $_SESSION['user_id'];
    $sql = "SELECT * FROM pajax WHERE felhasznalo= $bejelentkezettid";
    $myData = mysqli_query($mysqli, $sql);

    while ($record = mysqli_fetch_object($myData)) {
        $felh = $record->id;                                        //a hiretesnek az id-ja
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
                    <form action="torles_connection.php" enctype="multipart/form-data" method="POST" id="adataim">
                        <input type="hidden" value="<?php echo $felh; ?>" id="felh" name="felh"/>
                        <button type="submit" name="delete" id="delete" class="btn btn-primary btn-md">Törlés</button>
                    </form>
                    <form action="edit_proba.php" enctype="multipart/form-data" method="POST" id="edit_adatok">
                        <input type="hidden" value="<?php echo $felh; ?>" id="felh" name="felh"/>
                        <button type="submit" name="edit" class="btn btn-primary btn-md" id="edit">Modositás</button>
                    </form>
                </td>
            </tr>
            </tbody>
        </table><br><br>
        <?php
    }

    mysqli_close($mysqli);
    ?>
</div>
</body>
</html>