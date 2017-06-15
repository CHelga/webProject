<?php
$con = mysqli_connect("localhost", "root", "");
if(!$con){
    die("Can not connect : " .mysqli_error());
}
mysqli_select_db($con,"projekt");
?>