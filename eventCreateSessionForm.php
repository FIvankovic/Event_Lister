<head>
    <title>Event Selector - Create New Session</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<?php
include_once 'View/shared/header.php';
?>

<form method="get" action="eventCreateSession.php">

    <?php
    if (isset($_GET["eventID"])) {
        $eventID = $_GET["eventID"];
        echo "<input type='hidden' name='eventID' value=$eventID>";
    }
    ?>

    <div class="container-fluid justify-content-center">
        <div class="form-group row">
            <div class="col-md-5">
                <label class="font-weight-bold">Session name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter session name">
            </div>
            <div class="form-group col-md-5">
                <label class="font-weight-bold">Capacity </label>
                <input type="number" name="numberallowed" class="form-control" placeholder="Enter maximum capacity">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-5">
                <label class="font-weight-bold">Time Start</label>
                <input type="datetime-local" name="startdate" class="form-control" placeholder="Session starting time">
            </div>
            <div class="form-group col-md-5">
                <label class="font-weight-bold">Time End</label>
                <input type="datetime-local" name="enddate" class="form-control" placeholder="Session ending time">
            </div>
        </div>

        <div class="row justify-content-center">
            <button type="submit" class="btn btn-primary col-md-6 ">Submit</button>
        </div>
    </div>

</form>

<?php
include_once 'View/shared/footer.php';