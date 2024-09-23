<?php

require_once('./model/AdministrativeModule.php');

if (isset($_GET['venueId'])) {
    $id = $_GET['venueId'];
    $module = new AdministrativeModule();

    $affectedRows = $module->deleteVenueByID($id);
    header('Location: ' . './adminBoard.php');
}


