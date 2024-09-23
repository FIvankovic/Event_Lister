<?php

// If regular attendee - redirect
if ($_SESSION["role"] == "3") {
    header('Location: ' . './eventListing.php');
}

require_once('./model/Event.php');

if (isset($_GET['eventID'])) {
    $eventID = filter_var($_GET['eventID'], FILTER_SANITIZE_NUMBER_INT);
    $event = new Event();

    $affectedRows = $event->deleteOneByID($eventID);
    header('Location: ' . './eventListing.php');
}