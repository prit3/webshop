<?php

$server = "localhost";
$user	= "root";
$pass	= "";
$dbnaam = "webshop";

$conn = new mysqli($server, $user, $pass, $dbnaam);
	
if ($conn->connect_error){
	die ("Geen verbinding: " . $conn->connect_error);
}


?>