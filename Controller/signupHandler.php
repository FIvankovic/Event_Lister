<?php

//Check if user got to signUpHandler.php through the sign-up form
if(isset($_POST["submit"])){
    
    //Get the db, FormValidator & Sanitizer
    require_once '../includes/dbh.php';
    require_once '../Controller/FormValidator.php';
    require_once '../Controller/Sanitizer.php';
    
    //Get the form  submitted data entered by the user
    $name = $_POST['user'];
    $pwd = $_POST['password'];
    $pwdRepeat = $_POST['passwordRepeat'];
    
    //Sanitizer object
    $sanitizer = new Sanitizer();
    
    //Sanitize the user inputs
    $name = $sanitizer->stringSanitize($name);
    $pwd = $sanitizer->stringSanitize($pwd);
    $pwdRepeat = $sanitizer->stringSanitize($pwdRepeat);
    
    
    //Validator object - handles all of the form handling
    $validator = new FormValidator();
    $connector = new DB();
    $connector->connect(); //Connect to the DB
    $pdo = $connector->getConnection();//Get the connection to be used by the FormValidator class
    
    
    //Check if input fields were left empty -> return user back to signUp page if true with error msg
    if($validator->emptyInputSignup($name,$pwd,$pwdRepeat) !== false){
       header("location: ../signUp.php?error=emptyInput");
       exit(); 
    }
    //Check if username not alphanumerical-> return user back to signUp page if true with error msg
    if($validator->invalidUsername($name) !== false){
       header("location: ../signUp.php?error=invalidUsername");
       exit(); 
    }
    //Check iif passwords are matching -> return user back to signUp page if true with error msg
    if($validator->passwordMatch($pwd, $pwdRepeat) !== false){
       header("location: ../signUp.php?error=passwordNotMatch");
       exit(); 
    }
    //Check if username already exists in the attendee table -> return user back to signUp page if true with error msg
    if($validator->usernameTaken($pdo, $name) !== false){
        header("location: ../signUp.php?error=usernameTaken");
        exit();
    }
    
    //Create the mysql prepared statement for inserting a new attendee into the database
    $sql = "INSERT INTO attendee (name, password, role) VALUES(?,?,?);";
    //$stmt = mysqli_stmt_init($conn); //Initialize the connection
    $stmt = $pdo->prepare($sql);
    //Check for prepared statement validity
    if(!$stmt){
        header("location: ../signUp.php?error=stmtFailed"); //Return user to signUp.php page with an error message
        exit();
    }
    else{
        //Password is hashed with password_hash built-in function
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        //Role determines user level of access (3 - attendee, 2 - event manager, 1 - admin) -> Change this progromatically to create admins or managers, USER should NOT be able to create these otherwise
        $role = 3;
        //Bind the statements into the parameter
        $stmt->bindParam(1,$name, PDO::PARAM_STR);
        $stmt->bindParam(2,$hashedPwd, PDO::PARAM_STR);
        $stmt->bindParam(3,$role, PDO::PARAM_INT);
        $stmt->execute(); //Run sql statement
        //$stmt->close(); //close it after completion
        header("location: ../signUp.php?error=none"); //Success message is displayed on signUp.php page
        exit();  
    } 
}
else{
    //Send the user back to the signUp page if they try to access signupHandler.php through url
    header("location: ../signUp.php");
}
