<?php

require_once('./model/AdministrativeModule.php');
require_once('./Controller/Sanitizer.php');

if (
    isset($_GET['attendeeId']) && isset($_GET['name'])
    && isset($_GET['password']) && isset($_GET['role'])
) {
    //GET the use inputted values
    $id =$_GET['attendeeId'];
    $name = $_GET['name'];
    $password = $_GET['password'];
    $role = $_GET['role'];
    
    //Sanizer object
    $sanitizer = new Sanitizer();
    
    //Sanitize the user inputs
    $name = $sanitizer->stringSanitize($name);
    $pwd = $sanitizer->stringSanitize($password);
    
    //Password is hashed with password_hash built-in function
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        
    //Prevent the user from making non-existant roles
    if(intval($role) > 3 || intval($role) < 1){
        $role = 3;
    }
    
    //Query the statement
    $model = new AdministrativeModule();
    $newAttendee = $model->editOneAttendee($id, $name, $hashedPwd, $role);
    
    //$newAttendee->connection->errorInfo;
    header('Location: ' . './adminBoard.php');
}

