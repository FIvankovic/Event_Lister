<?php
require_once('./model/Event.php');

if (isset($_GET["eventID"]) && isset($_GET["userID"])) {
    $eventID = filter_var($_GET["eventID"], FILTER_SANITIZE_NUMBER_INT);
    $userID = filter_var($_GET["userID"], FILTER_SANITIZE_NUMBER_INT);

    $event = new Event();
    $event->addAttendee($eventID, $userID);

    header('Location: ' . "eventDetails.php?eventID=$eventID");
} else {
    header('Location: ' . "eventListing.php");
}