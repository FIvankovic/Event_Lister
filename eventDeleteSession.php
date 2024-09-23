<?php
// If regular attendee - redirect
if ($_SESSION["role"] == "3") {
    header('Location: ' . './eventListing.php');
}

require_once('./model/Session.php');

if (isset($_GET["sessionID"])) {
    $sessionID = filter_var($_GET["sessionID"], FILTER_SANITIZE_NUMBER_INT);

    $session = new Session();
    $session->deleteOneByID($sessionID);

    if (isset($_GET["eventID"])) {
        $eventID = filter_var($_GET["eventID"], FILTER_SANITIZE_NUMBER_INT);
        header('Location: ' . "eventDetails.php?eventID=$eventID");
    } else {
        header('Location: ' . "eventListing.php");
    }
}