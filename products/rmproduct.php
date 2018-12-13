<?php
include ('../dbconn.php');

	$id = $_GET['id'];
	$rmproduct = "DELETE FROM `product` WHERE `product`.`id` = $id";
    $delcom = "DELETE FROM comments WHERE productid = $id";
    $delbid = "DELETE FROM bid WHERE productid = $id";
    
//    $delrel = "DELETE FROM RelBlogTags WHERE Blog_id = $id";

if (isset($_GET['id']) && is_numeric($_GET['id'])){
	mysqli_query($conn,$delcom);
	mysqli_query($conn,$delbid);
    mysqli_query($conn,$rmproduct);
	header("location:../viewproducts.php");
}else{
	header("location:../viewproducts.php");
	return;
}

$conn->close();
?>