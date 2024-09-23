<head>
    <title>Event Selector - Log-in</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<?php
require_once('./model/Event.php');
require_once('./model/Venue.php');
include_once 'View/shared/header.php';

if (isset($_GET['eventID'])) {
    $eventID = $_GET['eventID'];
    $event = new Event();
    $myEvent = $event->getOneByID($eventID);
    $venue = new Venue();
    $allVenues = $venue->getAll();
    echo "
        <form method='get' action='eventEdit.php'>
            <input type='hidden' value=" . $myEvent->idevent . " name='eventID'>
            <div class='form-group'>    
                <label>Name:</label>
                <input type='text' value=" . $myEvent->name . " name='name'>
            </div>
            <div class='form-group'>
                <label>Date Start:</label>
                <input type='datetime-local' value=" . $myEvent->getStartingDateLocal() . " name='datestart'>
            </div>
            <div class='form-group'>
                <label>Date End:</label>
                <input type='datetime-local' value=" . $myEvent->getEndingDateLocal() . " name='dateend'>
            </div>
            <div class='form-group'>
                <label>Number Allowed:</label>
                <input type='number' value=" . $myEvent->numberallowed . " name='numberallowed'>
            </div>
            <div class='form-group'>
                <label>Venue:</label>";
    echo "<select class='form-select' name='venue'>
					  <option selected>Choose location</option>";
    foreach ($allVenues as $venue) {
        echo "<option value=$venue->idvenue>$venue->name</option>";
    }
    echo "</select><br/>";
    echo "</div>
            <input type='submit' value='Edit Event'>
        </form>
    ";
} else if ($_SESSION["role"] === 1) {
    echo "<form method='get' action='newEvent.php'>
            <div class='form-group'>
                <label>Event Id:</label>
                <input type='number' value='' name='eventID'>
            </div>
            <div class='form-group'>
                <label>Name:</label>
                <input type='text' value='' name='name'>
            </div>
            <div class='form-group'>
                <label>Date Start:</label>
                <input type='datetime-local' value='' name='datestart'>
            </div>
            <div class='form-group'>
                <label>Date End:</label>
                <input type='datetime-local' value='' name='dateend'>
            </div>
            <div class='form-group'>
                <label>Number Allowed:</label>
                <input type='number' value='' name='numberallowed'>
            </div>
            <div class='form-group'>
                <label>Venue:</label>
                <input type='number' value='' name='venue'>
            </div>
            <input type='submit' value='Create New Event'>
    </form>";
}

include_once 'View/shared/footer.php';