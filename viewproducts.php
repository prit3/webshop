<?php
session_start();     

?>

<html lang="en">
    <head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="style.css" type="text/css" rel="stylesheet">
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
                  <li class="nav-item active">
                    <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="./products/productform.php">add product</a>
                  </li>  <li class="nav-item">
                    <a class="nav-link" href="./users/profile.php">profile</a>
                  </li>
                    <?php

                        if ($_SESSION['user'] == 0 || $_SESSION['user'] == 1){
                            echo "<li class='nav-item'>
                                    <a class='nav-link' href='./users/login.php'>login</a>
                                  </li>";
                        }
                         else {
                            echo "<li class='nav-item'>
                                    <a class='nav-link' href='./users/logout.php'>logout</a>
                                  </li>";
                         }
                     ?>
                </ul>
                    <form method="get" class="form-inline my-2 my-lg-0">
                        <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search">
                    </form>
              </div>
            </nav>
            <form method="get">
                <select class="custom-select custom-select-sm" name="sorteer">
                    <option>Sort on</option>
                    <option value="producktDESC">Products from new to oud</option>
                    <option value="productASC">Products from old to new</option>
                    <option value="timeDESC">Time from New to old</option>
                    <option value="timeASC">Time from old to new</option>
                    <option value="nameASC">Name from A to Z</option>
                    <option value="nameDESC">Name from Z to A</option>
                </select>
                <input type="submit" name="update" value="Update">
            </form>
            
            
           
        </header>
        <div class="container">
            <?php
            include ('dbconn.php');
            error_reporting(0);    
           
            $post = "SELECT * FROM product p INNER JOIN users u ON p.seller = u.userid";
//            Search function
            if (isset($_GET['search'])){
            $search = $_GET['search'];
                $post .= " WHERE `name` LIKE '%".$search."%' OR `info` LIKE '%".$search."%'";
            }
            
//            Sort function
            $sort = $_GET["sorteer"];
            switch ($sort){
                case "productDESC":
                    $post .= " ORDER BY p.id DESC";
                    break;
                case "productASC":
                    $post .= " ORDER BY p.id ASC";
                    break;
                case "timeDESC":
                    $post .= " ORDER BY p.time DESC";
                    break;
                case "timeASC":
                    $post .= " ORDER BY p.time ASC";
                    break;
                case "nameDESC":
                    $post .= " ORDER BY p.name DESC";
                    break;
                case "nameASC":
                    $post .= " ORDER BY p.name ASC";
                    break;
                default:
                    $post .=" ORDER BY p.id DESC";
            }
//            $post = "SELECT * FROM BlogPosts INNER JOIN Tags on BlogPosts.Tag_id = Tags.id";
                ?>
            <div class="card-columns">
            <?php
            $result = $conn->query($post);
            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
                    ?>
                        
                        <div class="card text-center" style="width: 18rem;">
                      <img class="card-img-top" src=".../100px180/" alt="Card image cap">
                      <div class="card-body">
                          <h5 class="card-title"><a href="<?php echo "./products/product.php?id=$row[id]" ?>" class="card-link"><?php echo $row['name'] ?></a></h5>
                          
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



