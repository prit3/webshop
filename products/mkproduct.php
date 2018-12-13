<?php
include ('../dbconn.php');
session_start();
error_reporting(0);

$name = $_SESSION['user'];
empty ($_POST["title"]) ? $title = "" : $title = $_POST["title"];
empty ($_POST["info"]) ? $text = "" : $text = $_POST["info"];


$price = $_POST['price'];
$mkproduct = "INSERT INTO `product` (id, seller, name, info, price, time) VALUES (NULL, '$name', '$title', '$text', '$price', CURRENT_TIMESTAMP)";

if (isset($_POST['submit'])){
	if (!empty($_POST['title'])){
	mysqli_query($conn, $mkproduct);
	
    header("location:../viewproducts.php");
     
	}
    else{
        echo "fill out all the forms fields please";

        
        echo "<br>";
        echo "<br>";
    }
}
$conn->close();
?>