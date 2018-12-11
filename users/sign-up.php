<?php 
    include ('mkuser.php'); 
?>

<style>
* {
    margin: 0;
}
    
div{
    position:fixed;
    top: 25vh;
    left: 40vw;
    width: 250px;
    }
    
.divbody {
    padding: 10px;
    background-color: aqua;
}
    
h3 {
    margin-top: -33px;
    text-align: center;
    width: 260px;
    padding: 5px;
    background-color: salmon;
}

.yess, .noo {

    height: 30px;
    width: 100%;
    border-radius: 10px;
    color:seashell;
    border: none;
    cursor: pointer;
}


.yess {
    background-color: green;
}

.noo {
    background-color: red;
}

</style>

<div>
    <h3>Sign-up</h3>
    <div class="divbody">
        <form method="post" action="sign-up.php">
            Gebruikersnaam:
            <br>
            <input type="text" placeholder="Gebruikersnaam" name="user" value="<?php echo $user; ?>" required>
            <br>
            <br>
            E-mail: 
            <br>
            <input type="email" placeholder="E-mail" name="email" value="<?php echo $email; ?>" required>
            <br>
            <br>
            Password:
            <br>
            <input type="password" name="pass1" placeholder="password" required>
            <br>
            <br>
            herhaal password:
            <br>
            <input type="password" name="pass2" placeholder="password" required>
            <br>
            <br>
            <input class="yess" type="submit" name="submit" value="Sign-up">
        </form>
    </div>
</div>