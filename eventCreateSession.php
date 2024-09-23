<?php
require_once('./model/Session.php');

if (
    filter_var($_GET["eventID"], FILTER_VALIDATE_INT) &&
    isset($_GET["name"]) && filter_var($_GET["numberallowed"], FILTER_VALIDATE_INT)
    && filter_var($_GET["startdate"]) && filter_var($_GET["enddate"])
) {

    $eventID = filter_var($_GET["eventID"], FILTER_SANITIZE_NUMBER_INT);
    $name = filter_var($_GET["name"], FILTER_SANITIZE_STRING);
    $numberallowed = filter_var($_GET["numberallowed"], FILTER_SANITIZE_NUMBER_INT);
    $startdate = filter_var($_GET["startdate"], FILTER_SANITIZE_STRING);
    $enddate = filter_var($_GET["enddate"], FILTER_SANITIZE_STRING);

    $session = new Session();
    $session->setName($name);
    $session->setNumberAllowed($numberallowed);
    $session->setEventID($eventID);
    $session->setStartDate($startdate);
    $session->setEndDate($enddate);

    $session->insertSelf();
    header('Location: ' . "eventDetails.php?eventID=$eventID");
}