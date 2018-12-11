<?php 
include ('mkproduct.php'); 
session_start();

if ($_SESSION['user'] == 0 || $_SESSION['user'] == 1){
            header("location:login.php");
}

?>


<!DOCTYPE HTML>
<html>
    <head>


    </head>
    <body>


        <header>
            
            <a href="../viewproducts.php"><button>View Products</button></a>
            
            
        </header>


        <form method="post">
            Product Name: 
            <br> 
            <input type="text" name="title" placeholder="Product Name" value="<?php echo $title; ?>" >
            <br>
            <br>
            Info: 
            <br> 
            <textarea name="info" cols="32" rows="4" placeholder="Place here your product info."><?php echo $text; ?></textarea>
            <br>
            <input type="number" name="price" min="0.00" max="100000000.00" step="0.05">
            <br>
                <input type="submit" name="submit" value="Place product">
            <br>
            <br>
        </form>
    </body>
</html>



