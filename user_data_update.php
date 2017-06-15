<?php
require 'rb.php';

R::setup('mysql:host=localhost;dbname=projekt','root', '');
R::debug(false);
$id = $_POST["aktualisisd"];
$ob = R::load('projekt',$id);

//updating a bean
$ob->username = $_POST["username"];     //  PDO bindings hasznal az adatok megvedesere (injecrion helyett)
$ob->firstname = $_POST["firstname"];
$ob->surname = $_POST["surname"];

$id = R::store($ob);
$ob = R::load('projekt', $id);
echo "<br>updating: <br>".$ob;
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>

