<?php
include ('../dbconn.php');

	$id = $_GET['id'];
    
    $delcom = "DELETE FROM comments WHERE comid = $id";

if (isset($_GET['id']) && is_numeric($_GET['id'])){

	mysqli_query($conn,$delcom);
	header("Location: {$_SERVER["HTTP_REFERER"]}");
	
}else{
	header("location:viewproducts.php");
	return;

}

$conn->close();
?>