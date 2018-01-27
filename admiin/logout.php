<?php require_once("includes/session.php") ?>
<?php require_once("includes/direct.php") ?>
<?php 
$_SESSION["id"]=null;
session_destroy();
header("location:login.php");
exit();
?>