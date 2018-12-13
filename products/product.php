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
        $pc = "INSERT INTO `comments` (`comid`, `productid`, `userid`, `hiddenid`, `comment`, `time`) VALUES (NULL, '$id', '$hidden', '$name','$comment', CURRENT_TIME())";
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
<style>
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
    <a href="../users/profile.php"><button>profile</button></a>
    <a href="productform.php"><button>Add new product</button></a>
    <a href="../viewproducts.php"><button>View all products</button></a>
    <?php

        if ($_SESSION['user'] == 0 || $_SESSION['user'] == 1){
            echo "<a href='login.php'><button class='sign'>login</button></a>";
        }
        else {
            echo "<a href='logout.php'><button class='sign'>logout</button></a>";
        }
    ?>
    </header> 
<?php 
$post = "SELECT * FROM product p INNER JOIN users u ON p.seller = u.userid WHERE id = $id";

  $result = $conn->query($post);
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                //pon= product owner name    
                $pon = $row['seller'];
                echo '<div class=blog>';
                    echo '<p class="content">';
                    echo $row['name'];
                    echo "<table>";
                        echo "<tr>";
                            echo "<td>"."Time:"."</td>";
                            echo "<td>".$row['time']."</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td>"."Name: "."</td>";
                            echo "<td>".$row['user']."</td>";
                        echo "</tr>";
                    echo "</table>";
                    echo "<br>";

                    echo "</p>";
                    echo "<p class='blogtxt'>";
                        echo $row['info'];
                    echo "</p>";
                    if ($_SESSION['user'] == $row['seller']){
                        echo '<a href="editproduct.php?id='.$row['id'].'">edit</a>',"&nbsp";
                        echo '<a href="rmproduct.php?id='.$row['id'].'">delete</a>';
                    }
            }
        }

?>
<br>
<br>
<br>
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
 
$comm = "SELECT * FROM comments where productid = $id";

  $result = $conn->query($comm);
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){

//                
                echo '<div class=comment>';
                    echo '<p class="content">';
                    echo $row['userid'];
                    echo "<br>";
                    
                    
                    echo "Time: ";
                    echo $row['time'];

                    echo "<p class='blogtxt'>";
                        echo $row['comment'];
                    echo "</p>";
                
                    if($name == $row['hiddenid'] || $name == $pon){
                        
                        echo '<a href="rmcomment.php?id='.$row['comid'].'">delete</a>';
                    }
            }
        }
?>
<br>
<form method="post">
<input type="number" name="price" min="0.00" max="100000000.00" step="0.01">
<input type="submit" name="bid" value="Place a Bidding"> 
</form>
<?php
    $bids = "SELECT * FROM bid b INNER JOIN users u ON b.user_id = u.userid where b.productid = $id";

    $result = $conn->query($bids);
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                echo '<div class=bid>';
                    echo '<p class="content">';
                        echo $row['user'];
                        echo "<br>";

                        echo "<p class='blogtxt'>";
                        echo "&euro;".$row['bid'];
                    echo "</p>";
                    echo "Time: ";
                    echo $row['time'];
                
                    if ($name == $row['hiddenid']){
                        echo '<a href="rmbid.php?id='.$row['bidid'].'">delete</a>';
                    }
            }
        }
?>
</body>
</html>