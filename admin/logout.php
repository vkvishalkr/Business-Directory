<?php require_once("../include/connect.php");
session_start();
session_destroy();
redirect ('login');

?>