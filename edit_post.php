<?php
    require 'core.inc.php';
    require 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hirdetése módosítása</title>
    <meta charset=UTF-8>
    <link rel="stylesheet" type="text/css" href="stilus.css">
</head>
<body>
<form id="myForm" enctype="multipart/form-data" method="POST">
    <div id="feltolt">
        <?php


        $bejelentkezettid = $_SESSION['user_id'];                                    // felhasznalonak az id-ja
        $oldal = "SELECT admin FROM projekt WHERE id=$bejelentkezettid";            // kivalasztjuk az admin-t ahol a felhasznalo id-ja = $bejelentkezettid-val
        $vizsgal = mysqli_query($mysqli, $oldal);
        while ($record = mysqli_fetch_assoc($vizsgal)) {
            $admin = $record['admin'];                        //kimentjuk az $admin -ba azt,hogy admin-e vagy nem
        }

        //a hirdetéstnek az id-ja
        $felh = $_POST['felh'];
        ?>
        <input type="hidden" value=" <?php echo $felh; ?>" id="felh" name="felh"/>
        <br><br><br>
        Cim <input type="text" id="cim" name="cim"/>
        <br><br>
        Város <select id="varos" name="varos">
            <option>--</option>
            <?php
            $varos = "SELECT distinct varos from pajax";
            $myData = mysqli_query($mysqli, $varos);
            while ($record = mysqli_fetch_assoc($myData)) {
                echo '<option>' . $record['varos'] . '</option>';
            }
            echo '</select>';
            ?>
            <br><br>
            Terület <input type="text" id="terulet" name="terulet"/>
            <br><br>
            Pénzérme <select id="penz" name="penz">
                <?php
                $penz = "SELECT distinct penzerme from pajax";
                $myData1 = mysqli_query($mysqli, $penz);
                while ($record = mysqli_fetch_assoc($myData1)) {
                    echo '<option>' . $record['penzerme'] . '</option>';
                }
                echo '</select>';
                ?>
                <br><br>
                Ára <input type="text" id="ara" name="ara"/>
                <br><br>
                Szobák száma <input type="text" id="szobaszam" name="szobaszam"/>
                <br><br>
                Leirás <textarea cols="30" rows="5" name="comment" id="comment"></textarea>
                <br><br>
                Kép hozáadása : <input type="file" name="file" id="file"/>
                <br><br>
                <button type="submit" name="betolt" value="Adatok beltoltese" id="betolt">Adatok betöltése</button>
                <?php

                if (isset($_POST['betolt'])) {
                    $sql1 = "SELECT cim from pajax where id=$felh";
                    $myData1 = mysqli_query($mysqli, $sql1);
                    $record = mysqli_fetch_assoc($myData1);
                    $cim = $record['cim'];

                    $sql = "SELECT terulet from pajax where id=$felh";        //kivalasztjuk a teruletet a hirdetéstnek az id-ja szerint
                    $myData = mysqli_query($mysqli, $sql);
                    $record = mysqli_fetch_assoc($myData);
                    $terulete = $record['terulet'];


                    $sql1 = "SELECT ar from pajax where id=$felh";
                    $myData1 = mysqli_query($mysqli, $sql1);
                    $record = mysqli_fetch_assoc($myData1);
                    $ara = $record['ar'];

                    $sql2 = "SELECT szobaszam from pajax where id=$felh";
                    $myData2 = mysqli_query($mysqli, $sql2);
                    $record = mysqli_fetch_assoc($myData2);
                    $szobaszam = $record['szobaszam'];

                    $sql3 = "SELECT comment from pajax where id=$felh";
                    $myData3 = mysqli_query($mysqli, $sql3);
                    $record = mysqli_fetch_assoc($myData3);
                    $comment = $record['comment'];


                    echo "<script type=\"text/javascript\">	
                document.getElementById('cim').value = '$cim';
				document.getElementById('terulet').value = '$terulete';
				document.getElementById('ara').value = '$ara';
				document.getElementById('szobaszam').value = '$szobaszam';
				document.getElementById('comment').value = '$comment';
			</script>";
                }
                //ha megnyomom az update gombot
                if (isset($_POST['update'])) {
                    //kiolvasuk az adatokat
                    $cimuj = $_POST['cim'];
                    $varosuj = $_POST['varos'];
                    $teruletuj = $_POST['terulet'];
                    $penzuj = $_POST['penz'];
                    $szobaszamuj = $_POST['szobaszam'];
                    $commentuj = $_POST['comment'];
                    $arauj = $_POST['ara'];
                    //	$fileuj = $_POST['file'];

                    //esetleges kep ujrafeltoltese, megvizsgaljuk a meretet, tipusat, azt hogy ne ismetlodjon
                    if ((($_FILES["file"]["type"] == "image/gif")
                            || ($_FILES["file"]["type"] == "image/jpeg")
                            || ($_FILES["file"]["type"] == "image/pjpeg"))
                        && ($_FILES["file"]["size"] < 4000000)
                    ) {
                        if ($_FILES['file']['error'] > 0) {
                            echo "return code : " . $_FILES['file']['name'];
                        } else if (file_exists('upload/' . $_FILES['file']['name'])) {
                            echo $_FILES['file']['name'] . "Mar letezik! ";
                        } else if (move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"])) {
                            $part = $_FILES['file']['name'];
                        }
                    } else
                        //ha nem toltunk fel kepet, akkor automatikusan a no_image.jpg kepet fogja feltolteni
                        $_FILES["file"]["name"] = 'no_image.jpg';
                    $part = $_FILES['file']['name'];

                    //az utolso modositasi datumot tesem fel
                    $datum = date("Y.m.d");
                    $sql = "UPDATE `pajax` SET `cim`='$cimuj',`varos`='$varosuj',`terulet`=$teruletuj,`penzerme`='$penzuj',`ar`= $arauj,`szobaszam`=$szobaszamuj,`comment`= '$commentuj', `kep`= '$part', `datum`= '$datum' WHERE `id`= $felh ";
                    $vizsgal = mysqli_query($mysqli, $sql);


                    if (($vizsgal) === TRUE) {
                        $_SESSION["error"] = "Sikerült modositani a hirdetést.";    // sikeres update eseten
                        if ($admin == 0) {
                            header('Location:index.php');
                        } else {
                            header('Location:admin.php');
                        }
                    } else {
                        $_SESSION["error"] = "Nem sikerült modositani a hirdetést.";    // sikeretlen update eseten
                        if ($admin == 0) {
                            header('Location:index.php');
                        } else {
                            header('Location:admin.php');
                        }
                    }
                }

                if (isset($_POST['Mégsem'])) {
                    if ($admin == 0) {
                        header('Location:index.php');
                    } else {
                        header('Location:admin.php');
                    }
                }
                ?>
                <br><br>
                <input type="submit" name="update" value="Feltöltés" id="update"/>
                <input type="submit" name="Mégsem" value="Mégsem">
    </div>
</body>
</form>
</html>

