<?php

//Run code only if user accessed this page through the index.php login system
if (isset($_POST["submit"])) {
    
    //Include the database connection
    require_once '../includes/dbh.php';
    require_once '../Controller/FormValidator.php';
    require_once '../Controller/Sanitizer.php';
    
    //Grabbing the username(name) and password from the login form
    $name = $_POST['user'];
    $pwd = $_POST['password'];
    
    
    //Sanizer object
    $sanitizer = new Sanitizer();
    
    //Sanitize the user inputs
    $name = $sanitizer->stringSanitize($name);
    $pwd = $sanitizer->stringSanitize($pwd);

    //Create objects
    $validator = new FormValidator();
    $connector = new DB();
    $connector->connect(); //Connect to the DB
    $pdo = $connector->getConnection();//Get the connection to be used by the FormValidator class
    
    //Send the user back to the login page if either was left blank
    if ($validator->emptyInputLogin($name, $pwd) !== false) {
        header("location: ../index.php?error=emptyInput");
        exit();
    } else {
        //usernameTaken method will return a sql row statement which will hold the attendee table data for the current $name
        $usernameExists = $validator->usernameTaken($pdo, $name);
        
        //Get the password from $usernameExists
        $hashedPwd = $usernameExists["password"];
        
        //Verify the hashed password that is stored in the database
        $pwdChecked = password_verify($pwd, $hashedPwd);
        
        //In the case that the password is false -> send the user back to the login page
        if ($pwdChecked === false) {
            header("location: ../index.php?error=incorrectLogin");
            exit();
        //If pwd correct, continue and make a SESSION
        } else if ($pwdChecked === true) {
            session_start(); //Session start
            $_SESSION["idattendee"] = $usernameExists["idattendee"];
            $_SESSION["name"] = $usernameExists["name"];
            $_SESSION["role"] = intval($usernameExists["role"]);
            $_SESSION["loggedIn"] = true;
            header("location: ../eventListing.php");
            exit();
        }
    }
} 
//Send user back to the index.php if they try to access loginHandler.php through the url
else {
    header("location: ../index.php");
    exit();
}
