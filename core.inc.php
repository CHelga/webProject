<?php
ob_start();
session_start();
session_regenerate_id(true); //session fixation megelozese

$current_file = $_SERVER['SCRIPT_NAME'];

//megvizsgaljuk ha nem ures a username
function loggedin(){
	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
		return true;
	}else{
		return false;
	}
}


?>

