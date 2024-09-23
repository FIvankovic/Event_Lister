<?php

require_once('./model/Event.php');
require_once('./Controller/Sanitizer.php');


if (
    isset($_GET['eventID']) && isset($_GET['name'])
    && isset($_GET['datestart']) && isset($_GET['dateend'])
    && isset($_GET['numberallowed']) && isset($_GET['venue'])
) {
    $eventID = $_GET['eventID'];
    $name = $_GET['name'];
    $datestart = $_GET['datestart'];
    $dateend = $_GET['dateend'];
    $numberallowed = $_GET['numberallowed'];
    $venue = $_GET['venue'];

    //Sanizer object
    $sanitizer = new Sanitizer();

    //Sanitize the user inputs
    $eventID = $sanitizer->intSanitize($eventID);
    $name = $sanitizer->stringSanitize($name);
    $numberallowed = $sanitizer->intSanitize($numberallowed);

    $event = new Event();
    $myEvent = $event->newEvent($eventID, $name, $datestart, $dateend, $numberallowed, $venue);


    header('Location: ' . './eventListing.php');
}