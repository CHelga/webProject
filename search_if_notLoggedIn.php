<?php
require 'connection/connect_to_session.php';
require 'connection/connection.php';
?>
<!DOCTYPE>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="kereses.css">
    <script src="index.js"></script>
    <meta charset="utf-8"/>
</head>
<body>
<div id="login_kereses_valasz">
    <form id="login_kereses_valasz" method="POST">
        <?php

$varos = $_POST['varos'];
$max = $_POST['max'];
$penz = $_POST['penz'];
$maxar = $_POST['maxar'];
$maxszobaszam = $_POST['maxszobaszam'];

//varos,terulet,ar,szoba meg van adva
if ($varos != null && $max != 0 && $maxar != 0 && $maxszobaszam != 0) {
	$minden = "SELECT * FROM pajax WHERE varos='$varos' AND terulet<=$max AND ara<=$maxar AND szobaszam<=$maxszobaszam";
	$myData88 = mysqli_query($mysqli, $minden);

	$record = mysqli_fetch_assoc($myData88);
	$penzerme = $record['penzerme'];
	$ar = $record['ar'];
	$vegso = $ar;

	if ($penzerme == "EURO" && $penz == "FORINT") {
		$vegso = $ar * 306.814135;
	} else if ($penzerme == "EURO" && $penz == "RON") {
		$vegso = $ar * 4.44501765;
	} else if ($penzerme == "RON" && $penz == "FORINT") {
		$vegso = $ar * 69.0242784;
	} else if ($penzerme == "RON" && $penz == "EURO") {
		$vegso = $ar * 0.224970985;
	} else if ($penzerme == "FORINT" && $penz == "RON") {
		$vegso = $ar * 0.014487656;
	} else if ($penzerme == "FORINT" && $penz == "EURO") {
		$vegso = $ar * 0.00326056462;
	}
	$minden = "SELECT * FROM pajax WHERE varos='$varos' AND terulet<=$max AND ara<=$maxar AND szobaszam<=$maxszobaszam";
	$myData88 = mysqli_query($mysqli, $minden);

	$num_rows = mysqli_num_rows($myData88); //megszamolom a sorok szamat
	if ($num_rows == 0) { // ha 0 , akkor azt jelenti, hogy nincsen olyan hirdetes
		$_SESSION["error"] = "Nem talaltam ilyen hirdetest."; // kiiratom, hogy nem talaltam ilyent
		header('Location:startPage.php'); //viszalepek az index oldalra
	} else {
		while ($record = mysqli_fetch_object($myData88)) {
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
                        </tr>
                        </tbody>
                    </table><br><br>
                    <?php
}
	}
}

//varos meg van adva
if ($varos != null && $max == 0 && $maxar == 0 && $maxszobaszam == 0) {
	//ha csak varos szerint szeretnem keresni a hirdeteseket
	$minden1 = "SELECT * FROM pajax WHERE varos = '" . $varos . "'";
	$myData99 = mysqli_query($mysqli, $minden1);

	$record = mysqli_fetch_assoc($myData99);
	$penzerme = $record['penzerme'];
	$ar = $record['ar'];
	$vegso = $ar;

	if ($penzerme == "EURO" && $penz == "FORINT") {
		$vegso = $ar * 306.814135;
	} else if ($penzerme == "EURO" && $penz == "RON") {
		$vegso = $ar * 4.4;
	} else if ($penzerme == "RON" && $penz == "FORINT") {
		$vegso = $ar * 69.0242784;
	} else if ($penzerme == "RON" && $penz == "EURO") {
		$vegso = $ar / 4.4;
	} else if ($penzerme == "FORINT" && $penz == "RON") {
		$vegso = $ar * 0.014487656;
	} else if ($penzerme == "FORINT" && $penz == "EURO") {
		$vegso = $ar * 0.00326056462;
	}

	$sql99 = "SELECT * FROM pajax WHERE varos = '" . $varos . "'";
	$myData99 = mysqli_query($mysqli, $sql99);
	$num_rows = mysqli_num_rows($myData99); //megszamolom a sorok szamat
	if ($num_rows == 0) { // ha 0 , akkor azt jelenti, hogy nincsen olyan hirdetes
		$_SESSION["error"] = "Nem talaltam ilyen hirdetest."; // kiiratom, hogy nem talaltam ilyent
		header('Location:startPage.php'); //viszalepek az index oldalra
	} else {
		while ($record = mysqli_fetch_object($myData99)) //maskepp kiiratom a talalt hirdeteseket
		{
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
                        </tr>
                        </tbody>
                    </table><br><br>
                    <?php
}
	}
}

//varos, terulet meg van adva
if ($varos != null && $max != 0 && $maxar == 0 && $maxszobaszam == 0) {
	$sql1 = "SELECT * FROM pajax WHERE varos = '$varos' AND  terulet<=$max";
	$myData1 = mysqli_query($mysqli, $sql1);

	$record = mysqli_fetch_assoc($myData1);
	$penzerme = $record['penzerme'];
	$ar = $record['ar'];
	$vegso = $ar;

	if ($penzerme == "EURO" && $penz == "FORINT") {
		$vegso = $ar * 306.814135;
	} else if ($penzerme == "EURO" && $penz == "RON") {
		$vegso = $ar * 4.4;
	} else if ($penzerme == "RON" && $penz == "FORINT") {
		$vegso = $ar * 69.0242784;
	} else if ($penzerme == "RON" && $penz == "EURO") {
		$vegso = $ar / 4.4;
	} else if ($penzerme == "FORINT" && $penz == "RON") {
		$vegso = $ar * 0.014487656;
	} else if ($penzerme == "FORINT" && $penz == "EURO") {
		$vegso = $ar * 0.00326056462;
	}

	$sql1 = "SELECT * FROM pajax WHERE varos = '$varos' AND  terulet<=$max";
	$myData1 = mysqli_query($mysqli, $sql1);
	$num_rows = mysqli_num_rows($myData1); //megszamolom a sorok szamat
	if ($num_rows == 0) { // ha 0 , akkor azt jelenti, hogy nincsen olyan hirdetes
		$_SESSION["error"] = "Nem talaltam ilyen hirdetest."; // kiiratom, hogy nem talaltam ilyent
		header('Location:startPage.php'); //viszalepek az index oldalra
	} else {
		while ($record = mysqli_fetch_object($myData1)) //maskepp kiiratom a talalt hirdeteseket
		{
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
                        </tr>
                        </tbody>
                    </table><br><br>
                    <?php
}
	}
}

//varos , terulet, ar meg van adva
if ($varos != null && $max != 0 && $maxar != 0 && $maxszobaszam == 0) {
	$sql1 = "SELECT * FROM pajax WHERE varos = '$varos' AND  terulet<=$max AND ara<=$maxar";
	$myData1 = mysqli_query($mysqli, $sql1);

	$record = mysqli_fetch_assoc($myData1);
	$penzerme = $record['penzerme'];
	$ar = $record['ar'];
	$vegso = $ar;

	if ($penzerme == "EURO" && $penz == "FORINT") {
		$vegso = $ar * 306.814135;
	} else if ($penzerme == "EURO" && $penz == "RON") {
		$vegso = $ar * 4.4;
	} else if ($penzerme == "RON" && $penz == "FORINT") {
		$vegso = $ar * 69.0242784;
	} else if ($penzerme == "RON" && $penz == "EURO") {
		$vegso = $ar / 4.4;
	} else if ($penzerme == "FORINT" && $penz == "RON") {
		$vegso = $ar * 0.014487656;
	} else if ($penzerme == "FORINT" && $penz == "EURO") {
		$vegso = $ar * 0.00326056462;
	}

	$sql1 = "SELECT * FROM pajax WHERE varos = '$varos' AND  terulet<=$max AND ara<=$maxar";
	$myData1 = mysqli_query($mysqli, $sql1);
	$num_rows = mysqli_num_rows($myData1); //megszamolom a sorok szamat
	if ($num_rows == 0) { // ha 0 , akkor azt jelenti, hogy nincsen olyan hirdetes
		$_SESSION["error"] = "Nem talaltam ilyen hirdetest."; // kiiratom, hogy nem talaltam ilyent
		header('Location:startPage.php'); //viszalepek az index oldalra
	} else {
		while ($record = mysqli_fetch_object($myData1)) //maskepp kiiratom a talalt hirdeteseket
		{
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
                        </tr>
                        </tbody>
                    </table><br><br>
                    <?php
}
	}
}

//varos, ar meg van adva
if ($varos != null && $max == 0 && $maxar != 0 && $maxszobaszam == 0) {
	$sql1 = "SELECT * FROM pajax WHERE varos = '$varos' AND ara<=$maxar";
	$myData1 = mysqli_query($mysqli, $sql1);

	$record = mysqli_fetch_assoc($myData1);
	$penzerme = $record['penzerme'];
	$ar = $record['ar'];
	$vegso = $ar;

	if ($penzerme == "EURO" && $penz == "FORINT") {
		$vegso = $ar * 306.814135;
	} else if ($penzerme == "EURO" && $penz == "RON") {
		$vegso = $ar * 4.4;
	} else if ($penzerme == "RON" && $penz == "FORINT") {
		$vegso = $ar * 69.0242784;
	} else if ($penzerme == "RON" && $penz == "EURO") {
		$vegso = $ar / 4.4;
	} else if ($penzerme == "FORINT" && $penz == "RON") {
		$vegso = $ar * 0.014487656;
	} else if ($penzerme == "FORINT" && $penz == "EURO") {
		$vegso = $ar * 0.00326056462;
	}

	$sql1 = "SELECT * FROM pajax WHERE varos = '$varos' AND ara<=$maxar";
	$myData1 = mysqli_query($mysqli, $sql1);
	$num_rows = mysqli_num_rows($myData1); //megszamolom a sorok szamat
	if ($num_rows == 0) { // ha 0 , akkor azt jelenti, hogy nincsen olyan hirdetes
		$_SESSION["error"] = "Nem talaltam ilyen hirdetest."; // kiiratom, hogy nem talaltam ilyent
		header('Location:startPage.php'); //viszalepek az index oldalra
	} else {
		while ($record = mysqli_fetch_object($myData1)) //maskepp kiiratom a talalt hirdeteseket
		{
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
                        </tr>
                        </tbody>
                    </table><br><br>
                    <?php
}
	}
}

//varos , szobaszam meg van adva
if ($varos != null && $max == 0 && $maxar == 0 && $maxszobaszam != 0) {
	$sql1 = "SELECT * FROM pajax WHERE varos = '$varos' AND szobaszam<=$maxszobaszam";
	$myData1 = mysqli_query($mysqli, $sql1);

	$record = mysqli_fetch_assoc($myData1);
	$penzerme = $record['penzerme'];
	$ar = $record['ar'];
	$vegso = $ar;

	if ($penzerme == "EURO" && $penz == "FORINT") {
		$vegso = $ar * 306.814135;
	} else if ($penzerme == "EURO" && $penz == "RON") {
		$vegso = $ar * 4.4;
	} else if ($penzerme == "RON" && $penz == "FORINT") {
		$vegso = $ar * 69.0242784;
	} else if ($penzerme == "RON" && $penz == "EURO") {
		$vegso = $ar / 4.4;
	} else if ($penzerme == "FORINT" && $penz == "RON") {
		$vegso = $ar * 0.014487656;
	} else if ($penzerme == "FORINT" && $penz == "EURO") {
		$vegso = $ar * 0.00326056462;
	}

	$sql1 = "SELECT * FROM pajax WHERE varos = '$varos' AND szobaszam<=$maxszobaszam";
	$myData1 = mysqli_query($mysqli, $sql1);
	$num_rows = mysqli_num_rows($myData1); //megszamolom a sorok szamat
	if ($num_rows == 0) { // ha 0 , akkor azt jelenti, hogy nincsen olyan hirdetes
		$_SESSION["error"] = "Nem talaltam ilyen hirdetest."; // kiiratom, hogy nem talaltam ilyent
		header('Location:startPage.php'); //viszalepek az index oldalra
	} else {
		while ($record = mysqli_fetch_object($myData1)) //maskepp kiiratom a talalt hirdeteseket
		{
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
                        </tr>
                        </tbody>
                    </table><br><br>
                    <?php
}
	}
}

//varos,terulet,szobaszam meg van adva
if ($varos != null && $max != 0 && $maxar == 0 && $maxszobaszam != 0) {
	$sql1 = "SELECT * FROM pajax WHERE varos = '$varos'  AND terulet<=$max AND szobaszam<=$maxszobaszam";
	$myData1 = mysqli_query($mysqli, $sql1);

	$record = mysqli_fetch_assoc($myData1);
	$penzerme = $record['penzerme'];
	$ar = $record['ar'];
	$vegso = $ar;

	if ($penzerme == "EURO" && $penz == "FORINT") {
		$vegso = $ar * 306.814135;
	} else if ($penzerme == "EURO" && $penz == "RON") {
		$vegso = $ar * 4.4;
	} else if ($penzerme == "RON" && $penz == "FORINT") {
		$vegso = $ar * 69.0242784;
	} else if ($penzerme == "RON" && $penz == "EURO") {
		$vegso = $ar / 4.4;
	} else if ($penzerme == "FORINT" && $penz == "RON") {
		$vegso = $ar * 0.014487656;
	} else if ($penzerme == "FORINT" && $penz == "EURO") {
		$vegso = $ar * 0.00326056462;
	}

	$sql1 = "SELECT * FROM pajax WHERE varos = '$varos' AND  terulet<=$max AND szobaszam<=$maxszobaszam";
	$myData1 = mysqli_query($mysqli, $sql1);
	$num_rows = mysqli_num_rows($myData1); //megszamolom a sorok szamat
	if ($num_rows == 0) { // ha 0 , akkor azt jelenti, hogy nincsen olyan hirdetes
		$_SESSION["error"] = "Nem talaltam ilyen hirdetest."; // kiiratom, hogy nem talaltam ilyent
		header('Location:startPage.php'); //viszalepek az index oldalra
	} else {
		while ($record = mysqli_fetch_object($myData1)) //maskepp kiiratom a talalt hirdeteseket
		{
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
                        </tr>
                        </tbody>
                    </table><br><br>
                    <?php
}
	}
}

//varos, ar, szobaszam meg van adva

if ($varos != null && $max == 0 && $maxar != 0 && $maxszobaszam != 0) {
	$sql1 = "SELECT * FROM pajax WHERE varos = '$varos' AND  ara<=$maxar AND szobaszam<=$maxszobaszam";
	$myData1 = mysqli_query($mysqli, $sql1);

	$record = mysqli_fetch_assoc($myData1);
	$penzerme = $record['penzerme'];
	$ar = $record['ar'];
	$vegso = $ar;

	if ($penzerme == "EURO" && $penz == "FORINT") {
		$vegso = $ar * 306.814135;
	} else if ($penzerme == "EURO" && $penz == "RON") {
		$vegso = $ar * 4.4;
	} else if ($penzerme == "RON" && $penz == "FORINT") {
		$vegso = $ar * 69.0242784;
	} else if ($penzerme == "RON" && $penz == "EURO") {
		$vegso = $ar / 4.4;
	} else if ($penzerme == "FORINT" && $penz == "RON") {
		$vegso = $ar * 0.014487656;
	} else if ($penzerme == "FORINT" && $penz == "EURO") {
		$vegso = $ar * 0.00326056462;
	}

	$sql1 = "SELECT * FROM pajax WHERE varos = '$varos' AND  ara<=$maxar AND szobaszam<=$maxszobaszam";
	$myData1 = mysqli_query($mysqli, $sql1);
	$num_rows = mysqli_num_rows($myData1); //megszamolom a sorok szamat
	if ($num_rows == 0) { // ha 0 , akkor azt jelenti, hogy nincsen olyan hirdetes
		$_SESSION["error"] = "Nem talaltam ilyen hirdetest."; // kiiratom, hogy nem talaltam ilyent
		header('Location:startPage.php'); //viszalepek az index oldalra
	} else {
		while ($record = mysqli_fetch_object($myData1)) //maskepp kiiratom a talalt hirdeteseket
		{
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
                        </tr>
                        </tbody>
                    </table><br><br>
                    <?php
}
	}
}

//terulet , ar megadva
if ($varos == null && $max != 0 && $maxar != 0 && $maxszobaszam == 0) {
	$sql1 = "SELECT * FROM pajax WHERE   terulet<=$max AND ara<=$maxar";
	$myData1 = mysqli_query($mysqli, $sql1);

	$record = mysqli_fetch_assoc($myData1);
	$penzerme = $record['penzerme'];
	$ar = $record['ar'];
	$vegso = $ar;

	if ($penzerme == "EURO" && $penz == "FORINT") {
		$vegso = $ar * 306.814135;
	} else if ($penzerme == "EURO" && $penz == "RON") {
		$vegso = $ar * 4.4;
	} else if ($penzerme == "RON" && $penz == "FORINT") {
		$vegso = $ar * 69.0242784;
	} else if ($penzerme == "RON" && $penz == "EURO") {
		$vegso = $ar / 4.4;
	} else if ($penzerme == "FORINT" && $penz == "RON") {
		$vegso = $ar * 0.014487656;
	} else if ($penzerme == "FORINT" && $penz == "EURO") {
		$vegso = $ar * 0.00326056462;
	}

	$sql1 = "SELECT * FROM pajax WHERE  terulet<=$max AND ara<=$maxar";
	$myData1 = mysqli_query($mysqli, $sql1);
	$num_rows = mysqli_num_rows($myData1); //megszamolom a sorok szamat
	if ($num_rows == 0) { // ha 0 , akkor azt jelenti, hogy nincsen olyan hirdetes
		$_SESSION["error"] = "Nem talaltam ilyen hirdetest."; // kiiratom, hogy nem talaltam ilyent
		header('Location:startPage.php'); //viszalepek az index oldalra
	} else {
		while ($record = mysqli_fetch_object($myData1)) //maskepp kiiratom a talalt hirdeteseket
		{
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
                        </tr>
                        </tbody>
                    </table><br><br>
                    <?php
}
	}
}

//ar, szobaszam
if ($varos == null && $max == 0 && $maxar != 0 && $maxszobaszam != 0) {
	$sql1 = "SELECT * FROM pajax WHERE  ara<=$maxar AND szobaszam<=$maxszobaszam";
	$myData1 = mysqli_query($mysqli, $sql1);

	$record = mysqli_fetch_assoc($myData1);
	$penzerme = $record['penzerme'];
	$ar = $record['ar'];
	$vegso = $ar;

	if ($penzerme == "EURO" && $penz == "FORINT") {
		$vegso = $ar * 306.814135;
	} else if ($penzerme == "EURO" && $penz == "RON") {
		$vegso = $ar * 4.4;
	} else if ($penzerme == "RON" && $penz == "FORINT") {
		$vegso = $ar * 69.0242784;
	} else if ($penzerme == "RON" && $penz == "EURO") {
		$vegso = $ar / 4.4;
	} else if ($penzerme == "FORINT" && $penz == "RON") {
		$vegso = $ar * 0.014487656;
	} else if ($penzerme == "FORINT" && $penz == "EURO") {
		$vegso = $ar * 0.00326056462;
	}

	$sql1 = "SELECT * FROM pajax WHERE  ara<=$maxar AND szobaszam<=$maxszobaszam";
	$myData1 = mysqli_query($mysqli, $sql1);
	$num_rows = mysqli_num_rows($myData1); //megszamolom a sorok szamat
	if ($num_rows == 0) { // ha 0 , akkor azt jelenti, hogy nincsen olyan hirdetes
		$_SESSION["error"] = "Nem talaltam ilyen hirdetest."; // kiiratom, hogy nem talaltam ilyent
		header('Location:startPage.php'); //viszalepek az index oldalra
	} else {
		while ($record = mysqli_fetch_object($myData1)) //maskepp kiiratom a talalt hirdeteseket
		{
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
                        </tr>
                        </tbody>
                    </table><br><br>
                    <?php
}
	}
}

//terulet van megadva
if ($max != 0 && $varos == null && $maxar == 0 && $maxszobaszam == 0) {
	$sql1 = "SELECT * FROM pajax WHERE terulet<=$max ";
	$myData1 = mysqli_query($mysqli, $sql1);

	$record = mysqli_fetch_assoc($myData1);
	$penzerme = $record['penzerme'];
	$ar = $record['ar'];
	$vegso = $ar;

	if ($penzerme == "EURO" && $penz == "FORINT") {
		$vegso = $ar * 306.814135;
	} else if ($penzerme == "EURO" && $penz == "RON") {
		$vegso = $ar * 4.4;
	} else if ($penzerme == "RON" && $penz == "FORINT") {
		$vegso = $ar * 69.0242784;
	} else if ($penzerme == "RON" && $penz == "EURO") {
		$vegso = $ar / 4.4;
	} else if ($penzerme == "FORINT" && $penz == "RON") {
		$vegso = $ar * 0.014487656;
	} else if ($penzerme == "FORINT" && $penz == "EURO") {
		$vegso = $ar * 0.00326056462;
	}

	$sql1 = "SELECT * FROM pajax WHERE  terulet<=$max ";
	$myData1 = mysqli_query($mysqli, $sql1);
	$num_rows = mysqli_num_rows($myData1); //megszamolom a sorok szamat
	if ($num_rows == 0) { // ha 0 , akkor azt jelenti, hogy nincsen olyan hirdetes
		$_SESSION["error"] = "Nem talaltam ilyen hirdetest."; // kiiratom, hogy nem talaltam ilyent
		header('Location:startPage.php'); //viszalepek az index oldalra
	} else {
		while ($record = mysqli_fetch_object($myData1)) //maskepp kiiratom a talalt hirdeteseket
		{
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
                        </tr>
                        </tbody>
                    </table><br><br>
                    <?php
}
	}
}

//ar van megadva
if ($varos == null && $max == 0 && $maxar != 0 && $maxszobaszam == 0) {
	$sql1 = "SELECT * FROM pajax WHERE  ara<=$maxar";
	$myData1 = mysqli_query($mysqli, $sql1);

	$record = mysqli_fetch_assoc($myData1);
	$penzerme = $record['penzerme'];
	$ar = $record['ar'];
	$vegso = $ar;

	if ($penzerme == "EURO" && $penz == "FORINT") {
		$vegso = $ar * 306.814135;
	} else if ($penzerme == "EURO" && $penz == "RON") {
		$vegso = $ar * 4.4;
	} else if ($penzerme == "RON" && $penz == "FORINT") {
		$vegso = $ar * 69.0242784;
	} else if ($penzerme == "RON" && $penz == "EURO") {
		$vegso = $ar / 4.4;
	} else if ($penzerme == "FORINT" && $penz == "RON") {
		$vegso = $ar * 0.014487656;
	} else if ($penzerme == "FORINT" && $penz == "EURO") {
		$vegso = $ar * 0.00326056462;
	}

	$sql1 = "SELECT * FROM pajax WHERE ara<=$maxar";
	$myData1 = mysqli_query($mysqli, $sql1);
	$num_rows = mysqli_num_rows($myData1); //megszamolom a sorok szamat
	if ($num_rows == 0) { // ha 0 , akkor azt jelenti, hogy nincsen olyan hirdetes
		$_SESSION["error"] = "Nem talaltam ilyen hirdetest."; // kiiratom, hogy nem talaltam ilyent
		header('Location:startPage.php'); //viszalepek az index oldalra
	} else {
		while ($record = mysqli_fetch_object($myData1)) //maskepp kiiratom a talalt hirdeteseket
		{
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
                        </tr>
                        </tbody>
                    </table><br><br>
                    <?php
}
	}
}

//szobaszam van megadva
if ($varos == null && $max == 0 && $maxar == 0 && $maxszobaszam != 0) {
	$sql1 = "SELECT * FROM pajax WHERE  szobaszam<=$maxszobaszam";
	$myData1 = mysqli_query($mysqli, $sql1);

	$record = mysqli_fetch_assoc($myData1);
	$penzerme = $record['penzerme'];
	$ar = $record['ar'];
	$vegso = $ar;

	if ($penzerme == "EURO" && $penz == "FORINT") {
		$vegso = $ar * 306.814135;
	} else if ($penzerme == "EURO" && $penz == "RON") {
		$vegso = $ar * 4.4;
	} else if ($penzerme == "RON" && $penz == "FORINT") {
		$vegso = $ar * 69.0242784;
	} else if ($penzerme == "RON" && $penz == "EURO") {
		$vegso = $ar / 4.4;
	} else if ($penzerme == "FORINT" && $penz == "RON") {
		$vegso = $ar * 0.014487656;
	} else if ($penzerme == "FORINT" && $penz == "EURO") {
		$vegso = $ar * 0.00326056462;
	}

	$sql1 = "SELECT * FROM pajax WHERE szobaszam<=$maxszobaszam";
	$myData1 = mysqli_query($mysqli, $sql1);
	$num_rows = mysqli_num_rows($myData1); //megszamolom a sorok szamat
	if ($num_rows == 0) { // ha 0 , akkor azt jelenti, hogy nincsen olyan hirdetes
		$_SESSION["error"] = "Nem talaltam ilyen hirdetest."; // kiiratom, hogy nem talaltam ilyent
		header('Location:startPage.php'); //viszalepek az index oldalra
	} else {
		while ($record = mysqli_fetch_object($myData1)) //maskepp kiiratom a talalt hirdeteseket
		{
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
                        </tr>
                        </tbody>
                    </table><br><br>
                    <?php
}
	}
}

?>

        <button onclick="goBack()"  id="vissza_fooldalra"><span> Vissza  </span> </button>
        <!--			</script> -->
    </form>
</div>
</body>
</html>