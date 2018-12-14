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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
         <link href="../style.css" type="text/css" rel="stylesheet">

    </head>
    <body>


<header class="wave">
            <nav class="navbar navbar-expand-lg navbar-dark">
              <a class="navbar-brand" href="#">DriftSale</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="../viewproducts.php">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="../products/productform.php">add product<span class="sr-only">(current)</span></a>
                  </li>  <li class="nav-item">
                    <a class="nav-link" href="../users/profile.php">profile</a>
                  </li>
                    <?php

                        if ($_SESSION['user'] == 0 || $_SESSION['user'] == 1){
                            echo "<li class='nav-item'>
                                    <a class='nav-link' href='../users/login.php'>login</a>
                                  </li>";
                        }
                         else {
                            echo "<li class='nav-item'>
                                    <a class='nav-link' href='../users/logout.php'>logout</a>
                                  </li>";
                         }
                     ?>
                </ul>
              </div>
            </nav>
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
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>



