<head>
    <title>Admin Board</title>
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
    $object = new AdministrativeModule();
    include_once('./View/shared/header.php');
    if($_SESSION["role"] === 1){
?>

<section id="section-adminUsers" class="section-adminBoard">
    <div id="adminboard-header">
        <h1>Admin Board</h1>
    </div>
    <div class="container">
        <?php
            $userTable = "<h2 class='h2-adminBoard'>Attendee</h2>"
                    . "<p>A list of all the attendee accounts.</p>"
                    . "<span class='smallinfo'>NOTE: Admins cannot be deleted once they are sent. Wisely allocate admins (Role=1).</span>"
                    . "<table class='table admin-tables'>"
                    . "<thead>"
                    . "<tr>"
                    . "<th scope='col'>Id</th>"
                    . "<th scope='col'>Name</th>"
                    . "<th scope='col'>Password</th>"
                    . "<th scope='col'>Role</th>"
                    . "<th scope='col'>Functions</th>"
                    . "</tr>"
                    . "</thead>"
                    . "<tbody>";
            echo $userTable;

            $people = $object->getAll("attendee");
            foreach ($people as $item) {
                    $contentUser = "
                    <tr>
                       <td>$item->idattendee</td>
                       <td>$item->name</td>
                       <td>$item->password</td>
                       <td>$item->role</td>";
                    if (intval($item->role) !== 1) {
                        $contentUser .= "<td><a href='deleteAttendee.php?attendeeID=$item->idattendee'>Delete</a><a class='eventLinks' href='attendeeEditForm.php?attendeeID=$item->idattendee'>Edit</a></td>";  
                    }
                    else{
                        $contentUser .="<td></td>";
                    }
                    echo $contentUser;
                    echo "</tr>";
            }//foreach end
            echo "</tbody>";
            echo "</table>";
        ?>  
    </div>
</section>



<section id="section-adminVenue" class="section-adminBoard">
    <div class="container">
        <?php
            $venueTable = "<h2 class='h2-adminBoard'>Venue</h2>"
                    . "<a href='./venueEditForm.php'>Create New Venue</a>"  
                    . "<table class='table admin-tables'>"
                    . "<thead>"
                    . "<tr>"
                    . "<th scope='col'>Venue Id</th>"
                    . "<th scope='col'>Name</th>"
                    . "<th scope='col'>Max Capacity</th>"
                    . "<th scope='col'>Functions</th>"
                    . "</tr>"
                    . "</thead>"
                    . "<tbody>";
            echo $venueTable;
            
            $venues = $object->getAll("venue");
            foreach ($venues as $item) {
                    $content = "
                    <tr>
                       <td>$item->idvenue</td>
                       <td>$item->name</td>
                       <td>$item->capacity</td>";
                       $content .= "<td><a href='deleteVenue.php?venueId=$item->idvenue'>Delete</a><a class='eventLinks' href='venueEditForm.php?venueId=$item->idvenue'>Edit</a></td>";  
                    echo $content;
            }//foreach end          
            echo "</tbody>";
            echo "</table>";
        ?>
    </div>
</section>

<section id="section-adminEvents" class="section-adminBoard">
    <div class="container">
        <?php
            $eventTable = "<h2 class='h2-adminBoard'>Events</h2>"
                . "<a href='./eventEditForm.php'>Create New Event</a>"    
                . "<table class='table admin-tables'>"
                . "<thead>"
                . "<tr>"
                . "<th scope='col'>Event Id</th>"
                . "<th scope='col'>Name</th>"
                . "<th scope='col'>Starting Date</th>"
                . "<th scope='col'>Ending Date</th>"
                . "<th scope='col'>Number Allowed</th>"
                . "<th scope='col'>Venue</th>"
                . "<th scope='col'>Functions</th>"
                . "</tr>"
                . "</thead>"
                . "<tbody>";
            echo $eventTable;
            
            $events = $object->getAll("event");
            foreach ($events as $item) {
                    $content = "
                    <tr>
                       <td>$item->idevent</td>
                       <td><a href='eventDetails.php?eventID=$item->idevent'>$item->name</a></td>
                       <td>$item->datestart</td>
                       <td>$item->dateend</td>
                       <td>$item->numberallowed</td>
                       <td>$item->venue</td>";
                       $content .= "<td><a href='eventDelete.php?eventID=$item->idevent'>Delete</a><a class='eventLinks' href='eventEditForm.php?eventID=$item->idevent'>Edit</a></td></tr>";  
                    echo $content;
            }//foreach end          
            echo "</tbody>";
            echo "</table>";
        ?>
    </div>
</section>

<section id="section-adminSessions" class="section-adminBoard">
    <div class="container">
        <?php
            $sessionTable = "<h2 class='h2-adminBoard'>Sessions</h2>"
                . "<p>New sessions can be created by going to their corresponding event.</p>"
                . "<table class='table admin-tables'>"
                . "<thead>"
                . "<tr>"
                . "<th scope='col'>Session Id</th>"
                . "<th scope='col'>Name</th>"
                . "<th scope='col'>Number Allowed</th>"
                . "<th scope='col'>Event</th>"
                . "<th scope='col'>Starting Date</th>"
                . "<th scope='col'>Ending Date</th>"
                . "<th scope='col'>Functions</th>"
                . "</tr>"
                . "</thead>"
                . "<tbody>";
            echo $sessionTable;
            
            $sessions = $object->getAll("session");
            foreach ($sessions as $item) {
                    $content = "
                    <tr>
                       <td>$item->idsession</td>
                       <td>$item->name</td>
                       <td>$item->numberallowed</td>
                       <td>$item->event</td>
                       <td>$item->startdate</td>
                       <td>$item->enddate</td>";
                       $content .= "<td><a href='./eventDeleteSession.php?sessionID=$item->idsession'>Delete</a></td>";  
                    echo $content;
            }//foreach end          
            echo "</tbody>";
            echo "</table>";
        ?>
    </div>
</section>
<?php
}//if role 1 admin is active end
else{
    header("location: ./index.php");
    exit();  
}

?>


<?php
include_once('./View/shared/footer.php');