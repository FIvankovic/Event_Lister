<?php


require_once('./model/AdministrativeModule.php');
require_once('./Controller/Sanitizer.php');

if (isset($_GET['idvenue']) && isset($_GET['name']) && isset($_GET['capacity'])) {
    
    $idvenue = $_GET['idvenue'];
    $name = $_GET['name'];
    $capacity = $_GET['capacity'];
    
    //Sanizer object
    $sanitizer = new Sanitizer();
    
    //Sanitize the user inputs
    $name = $sanitizer->stringSanitize($name);
    $capacity = $sanitizer->intSanitize($capacity);

    $model = new AdministrativeModule();
    $myVenue = $model->editOneVenue($idvenue, $name, $capacity);

    
    header('Location: ' . './adminBoard.php');
}
