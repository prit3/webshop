<?php
session_start();
include ('../dbconn.php');
error_reporting(0);
$userid = $_SESSION['user'];
$username = $_GET['id'];



$sql = "SELECT * FROM users WHERE userid = $userid";
$result = $conn->query($sql);
if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
        $name = $row['user'];
        $email = $row['email'];
        }
} else {
    echo "error";
  }

if (empty ($username)){
    $username = $_SESSION['user'];
}


if (!empty($username)){
    $sql = "SELECT * FROM users WHERE userid = $username";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
            $pn = $row['user'];
            }
    } else {
        echo "<br> this user does not exitst";
        die();
     }
}
?>
<!DOCTYPE HTML>
<html lang="en">
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
                    <a class="nav-link" href="../products/productform.php">add product</a>
                  </li>  <li class="nav-item active">
                    <a class="nav-link" href="../users/profile.php">profile<span class="sr-only">(current)</span></a>
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
<!--
     <header>
        <a href="../products/productform.php"><button>Add product</button></a>
        <a href="../viewproducts.php"><button>view products</button></a>
        
--><div class="container">

        <?php

        
            echo "<br> you are on $pn's Profile page";
        

        
        ?>
            <div class="card-columns">
            <?php
            $post = "SELECT * FROM product WHERE seller = $username ORDER BY product.id DESC";
            $result = $conn->query($post);
            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
                    ?>
                        
                        <div class="card text-center" style="width: 18rem;">
                      <img class="card-img-top" src=".../100px180/" alt="Card image cap">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name'] ?></h5>
                        <p class="card-text"><small class="text-muted"><?php echo "&euro;".$row['price'] ?><br><?php echo $row['time']; ?> </small></p>
                      </div>
                    </div>
                    <?php
                }
            }
             else {
                echo "<br>No Products Found";
             }
            $conn->close();
            ?>
            </div>
    </div>
        
         <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>


