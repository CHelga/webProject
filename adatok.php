<!DOCTYPE html>
<html>
<head>
    <title>Hidetések</title>
    <meta charset=UTF-8>
    <script src="ajax.js" type="text/javascript"></script>
    <script src="ajax_adatok.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="kereses.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<div id="adatok_admin">
    <div id="felhasznalok">            <!-- ajaxtol kapott valasz kiirasa-->
        <span id="user"></span><br>
        <span id="firstname"></span><br>
        <span id="surname"></span><br>
    </div>
    <?php
    require 'connection.php';

    $sql = "SELECT * FROM pajax";
    $myData = mysqli_query($mysqli, $sql);

    while ($record = mysqli_fetch_object($myData)) {
        $hirdetesid = $record->id;
        $felh = $record->felhasznalo;
        $_POST['felh'] = $felh;
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
                        <button type="submit" name="level"  id="level"  class="btn btn-primary btn-md">Levél küldés</button>
                    </form>
                    <form action="torles_admin_connection.php" enctype="multipart/form-data" method="POST" id="adataim">
                        <input type="hidden" value="<?php echo $hirdetesid; ?>" id="hirdetesid" name="hirdetesid"/>
                        <button type="submit" name="delete"  id="delete"  class="btn btn-primary btn-md">Törlés</button>
                    </form>
                    <form action="edit_proba.php" enctype="multipart/form-data" method="POST" id="edit_adatok">
                        <input type="hidden" value="<?php echo $hirdetesid; ?>" id="felh" name="felh"/>
                        <button type="submit" name="edit"  id="edit" class="btn btn-primary btn-md">Modositás</button>
                    </form>
                    <button type="submit" id='edit' onclick="adatok(<?php echo $felh; ?>)"  class="btn btn-primary btn-md"> Adatok</button>
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
