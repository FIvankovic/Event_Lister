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

require_once('./model/AdministrativeModule.php');
include_once 'View/shared/header.php';

if (isset($_GET['attendeeID'])) {
    $attendeeId = $_GET['attendeeID'];
    $model = new AdministrativeModule();
    $attendee = $model->getAttendeeByID($attendeeId);

    echo "
        <form method='get' action='editAttendee.php'>
            <input type='hidden' value=" . $attendee->idattendee . " name='attendeeId'></br>
            <label>Name:</label>
            <input type='text' value=" . $attendee->name . " name='name'></br>
            <label>Password:</label>
            <input type='text' name='password'></br>
            <label>Role:</label>
            <input type='number' value=" . $attendee->role . " name='role'></br>
            <p class='smallinfo'>NOTE: If a number higher than 3, or lower than 0 is selected, the role will be defaulted to role 3.</p>
            <input type='submit' value='Edit Attendee'>
        </form>
    ";
}

include_once 'View/shared/footer.php';
