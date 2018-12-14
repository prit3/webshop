<?php
session_start();
include ('../dbconn.php');
error_reporting(0);
$id = $_GET["id"];
$name = $_SESSION['user'];
$choice = $_POST['now'];
empty ($_POST["comment"]) ? $comment = "" : $comment = $_POST["comment"];


switch ($choice){
    case "youseeme":
        $hidden = $name;
        break;
    case "youdont":
        $hidden = 1;
        break;
    default:
        $hidden = $name;
}

//pc = post comment    
if (isset($_POST['submit'])){
	if (!empty($_POST['comment'])){
        $pc = "INSERT INTO `comments` (`comid`, `productid`, `user_id`, `hiddenid`, `comment`, `time`) VALUES (NULL, '$id', '$hidden', '$name','$comment', CURRENT_TIME())";
        mysqli_query($conn, $pc);
    }   
}

if (isset($_POST['bid'])){
    $price = $_POST['price'];
    $bid = "INSERT INTO `bid` (`bidid`, `productid`, `user_id`, `bid`, `time`) VALUES (NULL, '$id', '$name', '$price', CURRENT_TIME())";
    mysqli_query($conn, $bid);
}

?>



<!DOCTYPE HTML>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
         <link href="productstyle.css" type="text/css" rel="stylesheet">
    </head>
<body>
 <header>
            <nav class="navbar navbar-expand-lg navbar-light">
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
    <div class="container">
    <div class="row">
    <div class="col-8">
<?php 
$post = "SELECT * FROM product p INNER JOIN users u ON p.seller = u.userid WHERE id = $id";

  $result = $conn->query($post);
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                //pon= product owner name    
                $pon = $row['seller'];
                ?>
                    <div class="card">
                    <?php    
                    echo $row['name'];
                            
                            echo "<br>";
                            echo "Name:";
                            echo $row['user'];
                            echo "<br>";
                        echo $row['info'];
                        echo "<br>";
                        echo $row['time'];
                    if ($_SESSION['user'] == $row['seller']){
                        echo '<a href="editproduct.php?id='.$row['id'].'">edit</a>';
                        echo '<a href="rmproduct.php?id='.$row['id'].'">delete</a>';
                    }
            }
        }

?>      
        </div>
        </div>
        <div class="col-4">
    <!--bid-->
<form method="post">
<input type="number" name="price" min="0.00" max="100000000.00" step="0.01">
<input type="submit" name="bid" value="Place a Bidding"> 
</form>
<?php
    $bids = "SELECT * FROM bid b INNER JOIN users u ON b.user_id = u.userid where b.productid = $id limit 5";

    $result = $conn->query($bids);
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
               
                    echo '<p class="content">';
                        echo $row['user'];
                        echo "<br>";

                        echo "<p class='blogtxt'>";
                        echo "&euro;".$row['bid'];
                    echo "</p>";
                    echo "Time: ";
                    echo $row['time'];
                    

            }
        }
?>
    </div>
    </div>
    </div>
    </div>
<br>
<br>
<br>
<div class="container">

Ask a Quistion
<form method="post">
    <textarea  cols='40' rows='6' name="comment" placeholder="comment section"></textarea>
    <br>
    <select name="now">
    <option value="youseeme">use my username</option>
    <option value="youdont">make me anonymous</option>
    </select>
    <input type="submit" name="submit" value="place comment">
</form>
    
    
<?php 
 
$comm = "SELECT * FROM comments c INNER JOIN users u ON c.user_id = u.userid where c.productid = $id ORDER BY comid DESC ";

  $result = $conn->query($comm);
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                ?>
                <div class="card text-center">
                <?php
                    echo $row['user'];
                    

                        echo $row['comment'];
                        echo "<br>";
                        echo $row['time'];
                
                    if($name == $row['hiddenid'] || $name == $pon){
                        
                        echo '<a href="rmcomment.php?id='.$row['comid'].'">delete</a>';
                    }
                echo "<br>";
            }
        }
?>
                </div>
    </div>
<br>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>