<?php
session_start();
    include ('dbconn.php');
    $id = $_GET["id"];
error_reporting(0);


?>

<!DOCTYPE HTML>
<html>
    <head><link rel="stylesheet" type="text/css" href="formstyle.css">



    </head>
    <body>
        <a href="profile.php"><button>profile</button></a>
        <a href="blogform.php"><button>create</button></a>
        <a href="viewblog.php"><button>view</button></a>
        <a href="showtags.php"><button>viewtags</button></a>
                 <?php
                
                if ($_SESSION['user'] == 0 || $_SESSION['user'] == 1){
                    echo "<a href='login.php'><button class='sign'>login</button></a>";
                }
                else {
                    echo "<a href='logout.php'><button class='sign'>logout</button></a>";
                }
                
                ?>
        
        <?php 
            include ('dbconn.php');

                $post = "SELECT * FROM BlogPosts WHERE id='$id' LIMIT 1";
                $result = $conn->query($post);

                if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    if ($_SESSION['user'] !== $row['Name']){
                        header("location:viewblog.php");
                    }

                    $naam = $row['Name'];
                    $title = $row['Title'];
                    $text = $row['Blogtext'];
                    $tags = $row['Tag_id'];

                    echo "<form action='editblog.php?id=$id' method='post'>";
                    echo "Name:";
                    echo "<br>";
                    echo $naam;
                    echo "<br>";
                    echo "Title:";
                    echo "<br>";
                    echo "<input type='text' name='title' placeholder='Title' value='$title'>";
                    echo "<br>";
                    echo "Blogtext";
                    echo "<br>";
                    echo "<textarea name='blogtext' cols='32' rows='4' placeholder='plaats hier je blog bericht.'>$text</textarea>";
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
                $text = $_POST['blogtext'];
                $up = "UPDATE `BlogPosts` SET `Title` = '$title', `Blogtext` = '$text', `tijd` = CURRENT_TIME()  WHERE `BlogPosts`.`id`= $id";


                mysqli_query($conn, $up);
                header("location:viewblog.php");

            }
            else {
                echo "er ging wat fout";
            }
    }
            


$conn->close();

?>

