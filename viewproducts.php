<?php
session_start();     

?>

<html>
    <head>
        <style>
            header {
                position: sticky;
                top:0;
                background-color:gray;
                max-width:100vw;
                height:100px;
                padding:10px;
            }
            body {
                margin:0;
            }
            
            .blogtxt {
                    border: 1px solid black;
                    border-style: dashed dashed ridge dashed;
                    width: 250px;
                    padding: 5px;
                    overflow: hidden;
                    max-height: 40px;
                    white-space: pre-line;
                    word-break: break-all;
                    text-overflow: ellipsis;
            }
            
            .blogtxt:hover {
                overflow: visible;
                max-height: none;}
            .sign {
                margin-right: 20px;
                float: right;
            }
            .left{float: left;}
            
            .divbody {
                padding-top:10px; 
                padding-left:10px;
            }
           
        </style>
    </head>
    <body>
        <header>
            <a href="./products/productform.php"><button>Add new product</button></a>
            <a href="./users/profile.php"><button>profile</button></a>
            
                 <?php
                
                if ($_SESSION['user'] == 0 || $_SESSION['user'] == 1){
                    echo "<a href='./users/login.php'><button class='sign'>login</button></a>";
                }
                else {
                    echo "<a href='./users/logout.php'><button class='sign'>logout</button></a>";
                }
                
                ?>
            <form method="get">
                <select name="sorteer">
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
              <form method="get"> 
                <input type="search" placeholder="&#x1F50D" name="search">
            </form>
            
            
           
        </header>
        <div class="divbody">
            <?php

            include ('dbconn.php');

            error_reporting(0);


            $sort = $_GET["sorteer"];
            
            switch ($sort){
                case "productDESC":
                    $post = "SELECT * FROM product ORDER BY product.id DESC";
                     echo "sorted on newest product";
                    break;
                case "productASC":
                    $post = "SELECT * FROM product ORDER BY product.id ASC";
                     echo "sorted on oldest product";
                    break;

                case "timeDESC":
                    $post = "SELECT * FROM product ORDER BY time DESC";
                     echo "sorted on newest time";
                    break;

                case "timeASC":
                    $post = "SELECT * FROM product ORDER BY time ASC";
                     echo "sorted on oldest time";
                    break;

                case "nameDESC":
                    $post = "SELECT * FROM product ORDER BY Name DESC";
                    echo "sorted on Name from Z to A";
                    break;

                case "nameASC":
                    $post = "SELECT * FROM product ORDER BY Name ASC";
                    echo "sorted on Name from A to Z";
                    break;


                default:
                    $post = "SELECT * FROM product ORDER BY product.id DESC";
                    echo "Sorted on newest product ";
            }
           
                if (isset($_GET['search'])){
                $search = $_GET['search'];
                    $post = "SELECT * FROM product WHERE `name` LIKE '%".$search."%' OR `info` LIKE '%".$search."%'";
                }
            
//            $post = "SELECT * FROM BlogPosts INNER JOIN Tags on BlogPosts.Tag_id = Tags.id";
                    
            $result = $conn->query($post);
            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
                    
                    $tagid = $row['Tag_id'];
                    echo '<div class=product>';
                        echo '<p class="content">';
                        echo '<a href="product.php?id='.$row['id'].'">';
                        echo $row['name'];
                        echo "</a>";
                        
                            echo "<table>";
                                echo "<tr>";
                                    echo "<td>"."Time:"."</td>";
                                    echo "<td>".$row['time']."</td>";
                                echo "</tr>";

                                echo "<tr>";
                                    echo "<td>"."Name: "."</td>";
                                    echo "<td>".$row['seller']."</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>"."&euro;".$row['price']."</td>";
                                echo "</tr>";
                                
                            echo "</table>";
                            echo "<br>";
                        if ($_SESSION['user'] == $row['seller']){
                            echo '<a href="editproduct.php?id='.$row['id'].'">edit</a>',"&nbsp";
                            echo '<a href="./products/rmproduct.php?id='.$row['id'].'">delete</a>';
                        }
                    echo "</div>";
                        }
                    }

                    else {
                        echo "<br>No Products Found";
                    }

            
            



            $conn->close();
            ?>
        </div>
    </body>
</html>



