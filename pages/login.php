<?php

if (isset($_SESSION['valid_user'])) {
    echo "<h3>You are already logged in!</h3>";
} else {
    if(isset($_POST['username'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if($username == "Test" && $password == "ape") {
            $_SESSION['valid_user'] = $username;
            echo "Logged in!";
        }
    }
}
?>