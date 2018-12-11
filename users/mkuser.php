<?php
include ('../dbconn.php');
session_start();

empty ($_POST["user"]) ? $user = "" : $user = $_POST["user"];
empty ($_POST["email"]) ? $email = "" : $email = $_POST["email"];

if (isset($_POST["pass2"])){ $pass = $_POST["pass2"];}

$sign_up = "INSERT INTO `users` (userid, user, email, pass) VALUES (NULL, '$user', '$email', '$pass')";

if (isset($_POST['submit'])){
    
    if ($_POST['pass1'] == $_POST['pass2']){
        if (!empty($_POST['user']) && $_POST['email'] && $_POST['pass2']){
       
        //schrijf het weg en haal id op om hem/haar/het meteen in te kunnen loggen
        mysqli_query($conn, $sign_up);
        $userid = $conn->insert_id;
        $_SESSION['user'] = $userid;
        header("location:profile.php");
        }
        else {
            echo "Niet alle velden zijn ingevuld";
            echo "<br>";
            echo "<br>";
        }
    }
    else {
        echo "Password zijn niet gelijk";
        echo "<br>";
        echo "<br>";
        
    }
}