<?php
require 'connection/connect_to_session.php';
session_destroy();
header('Location:startPage.php');

?>
