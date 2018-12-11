<?php
session_start();
include ('../dbconn.php');
error_reporting(0);
$userid = $_SESSION['user'];


if ($username == 1){
    
    header("location:https://www.theuselesswebindex.com/error/");
}

$sql = "SELECT * FROM users WHERE userid = $userid";
$result = $conn->query($sql);
if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
        $profileid = $row['userid'];
        $name = $row['user'];
        $email = $row['email'];
        $check = $row['userid'];
        }
}else {
    echo "error";
}
if ($userid == $profileid){
    $username = $userid;
    
}
else {
    $username = $_GET['id'];
}

if (!empty($username)){
    $sql = "SELECT * FROM users WHERE userid = $username";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
            $pn = $row['user'];
            }
    }else {
        echo "<br> this user does not exitst";
    }
}
?>
<!DOCTYPE HTML>
<html>
<head></head>
    
<body>
 <header>
    <a href="../products/productform.php"><button>Add product</button></a>
    <a href="../viewproducts.php"><button>view products</button></a>
    <?php

        if ($_SESSION['user'] == 0 || $_SESSION['user'] == 1){
            echo "<a href='login.php'><button class='sign'>login</button></a>";
        }
        else {
            echo "<a href='logout.php'><button class='sign'>logout</button></a>";
        }
     
    ?>
<!--     <a href='rmuser.php'><button>delete acount</button></a>-->
    </header> 
    
    Welcome <?php echo $name;
    


if ($userid !== $profileid){
    echo "<br> you are on $pn's Profile page";
}

$post = "SELECT * FROM product WHERE seller = $username ORDER BY product.id DESC";

$result = $conn->query($post);
            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
                    
                    echo '<div class=product>';
                        echo '<p class="content">';
                        echo '<a href="product.php?id='.$row['id'].'">';
                        echo $row['name']."<br>";
                        echo "</a>";
                        echo $row['time']."<br>";
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




if ($userid == $username){
    
    }
?>

</body>
</html>


