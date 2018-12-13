<?php
session_start();
    include ('../dbconn.php');
    $id = $_GET["id"];
error_reporting(0);


?>

<!DOCTYPE HTML>
<html>
    <head><link rel="stylesheet" type="text/css" href="formstyle.css">



    </head>
    <body>
        <a href="../users/profile.php"><button>profile</button></a>
        <a href="productform.php"><button>Add new product</button></a>
        <a href="../viewproducts.php"><button>View all products</button></a>
                 <?php
                
                if ($_SESSION['user'] == 0 || $_SESSION['user'] == 1){
                    echo "<a href='login.php'><button class='sign'>login</button></a>";
                }
                else {
                    echo "<a href='./users/logout.php'><button class='sign'>logout</button></a>";
                }
                
                ?>
        
        <?php 
            include ('dbconn.php');

                $post = "SELECT * FROM product WHERE id='$id' LIMIT 1";
                $result = $conn->query($post);

                if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    if ($_SESSION['user'] !== $row['seller']){
                        header("location:../viewproducts.php");
                    }

                    $name = $row['seller'];
                    $title = $row['name'];
                    $text = $row['info'];
                    $price = $row['price'];
                    

                    echo "<form action='editproduct.php?id=$id' method='post'>";
                    echo "Name:";
                    echo "<br>";
                    echo $name;
                    echo "<br>";
                    echo "Title:";
                    echo "<br>";
                    echo "<input type='text' name='title' placeholder='Title' value='$title'>";
                    echo "<br>";
                    echo "Blogtext";
                    echo "<br>";
                    echo "<textarea name='info' cols='32' rows='4' placeholder='plaats hier je blog bericht.'>$text</textarea>";
                    echo "<br>";
                    echo "<input type='number' name='price' min='0.00' max='100000000.00' step='0.05' value='$price'>";
                    echo "<br>";
                    echo "<input name='update' type='submit' value='Update'>";
                    echo "<input name='reset' type='reset' value='Reset'>";
                    echo "</form>";
                } 
            }
        ?>

    </body>
</html>



<?php 

    if (isset($_POST['update'])){
            if (!empty ($_POST['title'])){
                $title = $_POST['title'];
                $text = $_POST['info'];
                $price = $_POST['price'];
                $up = "UPDATE `product` SET `name` = '$title', `info` = '$text', `price` = $price  WHERE `product`.`id`= $id";


                mysqli_query($conn, $up);
                header("location:../viewproducts.php");

            }
            else {
                echo "er ging wat fout";
            }
    }
            


$conn->close();

?>

