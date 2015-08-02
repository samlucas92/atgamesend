<?php
session_start();
$_SESSION['name']='';
session_destroy();
header("Location: login.php"); /* Redirect browser */
?>