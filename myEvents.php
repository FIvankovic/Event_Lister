<head>
    <title>Event Selector - Event Listings</title>
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
require_once('./model/Event.php');
require_once('./model/Venue.php');
?>

<section id="section-eventListing">
    <div id="eventTable-div">
        <div id="event-header">
            <h1>My Events</h1>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Event Name</th>
                    <th scope="col">Dates</th>
                    <th scope="col">Capacity</th>
                    <th scope="col">Venue</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $userID = $_SESSION["idattendee"];
                $event = new Event();
                $events = $event->getAllThatUserIsAttending($userID);

                $venue = new Venue();

                foreach ($events as $event) {
                    $myVenue = $venue->getOneByID($event->venue);
                    $venueName = ($myVenue != null) ? $myVenue->name : 'undefined';

                    echo "<tr>";
                    echo "<td>
                            <a href='eventDetails.php?eventID=$event->idevent'>
                                $event->name
                            </a>
                        </td>";
                    echo "<td>" . $event->getDates() . "</td>";
                    echo "<td>$event->numberallowed</td>";
                    echo "<td>$venueName</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <div>
</section>

<?php
include_once 'View/shared/footer.php';
?>