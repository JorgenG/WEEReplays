<?php
    $validNewUser = true;
    $error = array();
    $error['username'] = "";
    $error['password'] = "";
    $error['email'] = "";
    
    if(isset($_POST['regusername'])
            && isset($_POST['regpassword'])
            && isset($_POST['regpasswordconfirm'])
            && isset($_POST['regemail'])) 
    {
        
        $username = $_POST['regusername'];
        $password = $_POST['regpassword'];
        $passwordconfirm = $_POST['regpasswordconfirm'];
        $email = $_POST['regemail'];
        
        if(strlen(trim($username)) < 5 || strlen(trim($username)) > 20) 
        {
            $validNewUser = false;
            $error['username'] = "Wrong length, must be between 5 and 20 characters.";
        } 
        else if(userNameTaken($username)) 
        {
            $validNewUser = false;
            $error['username'] = "Username already taken. Choose another one.";
        }
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
            $validNewUser = false;
            $error['email'] = "Invalid e-mail entered.";
        } 
        else if(emailAlreadyRegistered($email)) 
        {
            $validNewUser = false;
            $error['email'] = "E-mail address already registered. Forgot password?";
        }
        
        if(strlen(trim($password)) < 6 || strlen(trim($password)) > 30) 
        {
            $validNewUser = false;
            $error['password'] = "Password length must be between 6 and 30 characters.";            
        } 
        else if(trim($password) != trim($passwordconfirm)) 
        {
            $validNewUser = false;
            $error['password'] = "Passwords do not match.";
        }
        
    } 
    else 
    {
        $validNewUser = false;
    }
    
    // Do checks!
    

    if($validNewUser) 
    {        
        addNewUser($username, $email, $password);
        echo "User " . $username . " was created.";             
    } 
    else 
    {
        include('forms/registerform.php');
    }    
?>
