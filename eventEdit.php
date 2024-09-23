<?php


require_once('./model/Event.php');

if (
    isset($_GET['eventID']) && isset($_GET['name'])
    && isset($_GET['datestart']) && isset($_GET['dateend'])
    && isset($_GET['numberallowed']) && isset($_GET['venue'])
) {
    $eventID = filter_var($_GET["eventID"], FILTER_SANITIZE_NUMBER_INT);
    $name = filter_var($_GET["name"], FILTER_SANITIZE_STRING);
    $numberallowed = filter_var($_GET["numberallowed"], FILTER_SANITIZE_NUMBER_INT);
    $datestart = filter_var($_GET["datestart"], FILTER_SANITIZE_STRING);
    $dateend = filter_var($_GET["dateend"], FILTER_SANITIZE_STRING);
    $venue = filter_var($_GET['venue'], FILTER_SANITIZE_NUMBER_INT);


    $event = new Event();
    $myEvent = $event->editOne($eventID, $name, $datestart, $dateend, $numberallowed, $venue);

    var_dump($myEvent);
    $myEvent->connection->errorInfo;
    header('Location: ' . "./eventDetails.php?eventID=$eventID");
}