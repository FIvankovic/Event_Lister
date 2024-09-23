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

if (isset($_GET['venueId'])) {
    $venueId = $_GET['venueId'];
    $model = new AdministrativeModule();
    $myVenue = $model->getVenueByID($venueId);
    echo "
        <form method='get' action='venueEdit.php'>
            <input type='hidden' value=" . $myVenue->idvenue . " name='idvenue'>
            <div class='form-group'>    
                <label>Venue Name:</label>
                <input type='text' value=" . $myVenue->name . " name='name'>
            </div>
            <div class='form-group'>
                <label>Capacity:</label>
                <input type='number' value=" . $myVenue->capacity . " name='capacity'>
            </div>
            <input type='submit' value='Edit Venue'>
        </form>
    ";
} else if ($_SESSION["role"] === 1) {
    echo "<form method='get' action='newVenue.php'>
            <div class='form-group'>
                <label>Venue Id:</label>
                <input type='number' value='' name='idvenue'>
            </div>
            <div class='form-group'>    
                <label>Venue Name:</label>
                <input type='text' value='' name='name'>
            </div>
            <div class='form-group'>
                <label>Capacity:</label>
                <input type='number' value='' name='capacity'>
            </div>
            <input type='submit' value='Create New Venue'>
    </form>";
}

include_once 'View/shared/footer.php';

