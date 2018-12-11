<?php
session_start();

$userid = "";
$_SESSION["user"] = $userid;

header("location:../viewproducts.php");



?>