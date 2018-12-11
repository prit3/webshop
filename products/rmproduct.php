<?php
include ('../dbconn.php');

	$id = $_GET['id'];
	$rmproduct = "DELETE FROM `product` WHERE `product`.`id` = $id";
//	$delcomm = "DELETE FROM `comments` WHERE `Blogid`.`id` = $id";
    
//    $delrel = "DELETE FROM RelBlogTags WHERE Blog_id = $id";

if (isset($_GET['id']) && is_numeric($_GET['id'])){
    
    mysqli_query($conn,$rmproduct);
//	mysqli_query($conn,$delrel);
//	mysqli_query($conn,$delblog);
	header("Location: {$_SERVER["HTTP_REFERER"]}");
	
}else{
	header("location:../viewproducts.php");
	return;

}

$conn->close();
?>