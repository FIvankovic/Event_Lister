<?php

require_once('./model/AdministrativeModule.php');

if (isset($_GET['attendeeID'])) {
    $attendeeID = $_GET['attendeeID'];
    $module = new AdministrativeModule();

    $affectedRows = $module->deleteOneByIDAttendee($attendeeID);
    header('Location: ' . './adminBoard.php');
}


