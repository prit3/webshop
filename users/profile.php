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
    </head>
    <body>
     <header>
        <a href="../products/productform.php"><button>Add product</button></a>
        <a href="../viewproducts.php"><button>view products</button></a>
        <?php
            if($userid !== $username){
                echo "<a href='../users/profile.php'><button>profile</button></a>";
            }
            if ($_SESSION['user'] == 0 || $_SESSION['user'] == 1){
                echo "<a href='login.php'><button class='sign'>login</button></a>";
            }
            else {
                echo "<a href='logout.php'><button class='sign'>logout</button></a>";
            }
        ?>
    <!--     <a href='rmuser.php'><button>delete acount</button></a>-->
        </header> 

        <?php

        
            echo "<br> you are on $pn's Profile page";
        

        $post = "SELECT * FROM product WHERE seller = $username ORDER BY product.id DESC";

        $result = $conn->query($post);
                    if ($result->num_rows > 0){
                        while ($row = $result->fetch_assoc()){
                            echo '<div class=product>';
                                echo '<p class="content">';
                                echo '<a href="../products/product.php?id='.$row['id'].'">';
                                echo $row['name']."<br>";
                                echo "</a>";
                                echo "&euro;".$row['price'];
                                echo "<br>";
                                if ($_SESSION['user'] == $row['seller']){
                                    echo '<a href="../products/editproduct.php?id='.$row['id'].'">edit</a>',"&nbsp";
                                    echo '<a href="../products/rmproduct.php?id='.$row['id'].'">delete</a>';
                                }
                            echo "</div>";
                        }
                    }
                    else {
                        echo "<br>No Products Found";
                    }
        ?>
        
         <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>


