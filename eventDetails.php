<head>
    <title>Event Selector - Event Details</title>
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
require_once('./model/Session.php');
require_once('./model/Venue.php');
require_once('./model/Attendee.php');
$isManagerOrAdmin = $_SESSION["role"] == "2" || $_SESSION["role"] == "1";
?>

<section id="section-eventListing">
    <?php
    if (isset($_GET['eventID'])) {
        $eventID = filter_var($_GET['eventID'], FILTER_SANITIZE_NUMBER_INT);
        $event = new Event();
        $myEvent = $event->getOneByID($eventID);

        $session = new Session();
        $allSessions = $session->getAllByEventID($eventID);
    }
    ?>
    <div id="eventTable-div">
        <div id="event-header">
            <?php
            echo "<h1>$myEvent->name</h1>";
            echo ($isManagerOrAdmin)
                ?
                "<a role='button' class='btn btn-primary' href='eventEditForm.php?eventID=$eventID'>Edit Event</a>
                 <a role='button' class='btn btn-danger' href='eventDelete.php?eventID=$eventID'>Delete Event</a>
                 <a role='button' class='btn btn-success' href='eventCreateSessionForm.php?eventID=$eventID'>Create Session</a>"
                :
                "";
            ?>

            <?php
            if (isset($myEvent)) {

                $userID = $_SESSION["idattendee"];
                $isUserAttending = $event->isUserAttendingEventID($eventID, $_SESSION['idattendee']);
                if ($isUserAttending) {
                    echo "<a role='button' class='btn btn-danger' href='eventUnsubscribe.php?eventID=$eventID&userID=$userID'>Unsubscribe</a>";
                } else {
                    echo "<a role='button' class='btn btn-success' href='eventSubscribe.php?eventID=$eventID&userID=$userID'>Subscribe</a>";
                }

                $venue = new Venue();
                $myVenue = $venue->getOneByID($myEvent->venue);
                $venueName = ($myVenue != null) ? $myVenue->name : 'undefined location';

                $attendee = new Attendee();

                $managers = $attendee->getManagersOnEventID($eventID);

                $managerNames = "";
                foreach ($managers as $manager) {
                    $managerNames = $managerNames . " " . $manager->name;
                }

                echo "<table class='table'>";
                echo "<thead>
                                <tr>
                                    <th scope='col'></th>
                                    <th scope='col'></th>
                                    <th scope='col'></th>
                                    <th scope='col'></th>
                                </tr>
                            </thead>";
                echo "<tbody>";
                echo "<tr> 
                           <td><b>Event Name</b></td>
                           <td>$myEvent->name</td>
                        </tr>";
                echo "<tr> 
                        <td><b>Begins</b></td>
                        <td>$myEvent->datestart</td>
                        <td><b>Ends</b></td>
                        <td>$myEvent->dateend</td>
                     </tr>";
                echo "<tr> 
                     <td><b>Venue Name</b></td>
                     <td>$venueName</td>
                     <td><b>Maximum Attendees</b></td>
                     <td>$myEvent->numberallowed</td>
                  </tr>";
                echo "<tr> 
                  <td><b>Managers</b></td>
                  <td>$managerNames</td>
               </tr>";
                echo "</tbody>";
                echo "</table>";
            }
            ?>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Time Start</th>
                    <th scope="col">Time End</th>
                    <th scope="col">Attendance Status</th>
                    <?php
                    echo ($isManagerOrAdmin) ? "<th scope='col'></th>" : '';
                    ?>
                </tr>
            </thead>
            <tbody>
                <h2>Sessions</h2>
                <?php
                foreach ($allSessions as $session) {
                    echo "<tr>";
                    echo "<td>$session->name</td>";
                    echo "<td>$session->startdate</td>";
                    echo "<td>$session->enddate</td>";
                    echo "<td>x / $session->numberallowed</td>";
                    echo ($isManagerOrAdmin) ? "<td><a href='eventDeleteSession.php?sessionID=$session->idsession&eventID=$myEvent->idevent' role='button' class='btn btn-danger' >Delete</a>
                    </td>" : '';
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