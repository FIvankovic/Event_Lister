<?php
require_once('./includes/dbh.php');

// The name of the properties in this class must match the Event table column names
class Event
{
    public $idevent;
    public $name;
    public $datestart;
    public $dateend;
    public $numberallowed;
    public $venue;

    public function __construct()
    {
        DB::connect();
    }

    public function getAll()
    {
        $query = 'SELECT * FROM event;';
        $className = self::class;
        return DB::queryAll($query, [], $className);
    }

    public function getOneByID($id)
    {
        $query = 'SELECT * FROM event WHERE event.idevent = :id;';
        $params = ['id' => $id];
        $className = self::class;
        return DB::queryOne($query, $params, $className);
    }
			
	public function newEvent($idevent,$name,$datestart,$dateend,$numberallowed,$venue)
    {
        $query = "INSERT INTO event(idevent, name, datestart, dateend, numberallowed, venue) VALUES (:idevent, :name, :datestart, :dateend, :numberallowed, :venue)";
        $params = ['idevent' => $idevent,'name' => $name, 'datestart' => $datestart, 'dateend' => $dateend, 'numberallowed' => $numberallowed, 'venue' => $venue];
        return DB::query($query, $params);
    }
	
    public function getAllThatUserIsAttending($userID)
    {
        $query = 'SELECT * FROM attendee INNER JOIN attendee_event ON attendee.idattendee = attendee_event.attendee INNER JOIN event ON event.idevent = attendee_event.event WHERE attendee.idattendee = :userID;';
        $params = ['userID' => $userID];
        $className = self::class;
        return DB::queryAll($query, $params, $className);
    }

    public function isUserAttendingEventID($eventID, $userID)
    {
        $query = 'SELECT * FROM event INNER JOIN attendee_event ON event.idevent = attendee_event.event INNER JOIN attendee ON attendee.idattendee = attendee_event.attendee WHERE event.idevent = :eventID AND attendee.idattendee = :userID;';
        $params = ['eventID' => $eventID, 'userID' => $userID];
        $className = self::class;
        return DB::queryOne($query, $params, $className);
    }

    public function addAttendee($eventID, $userID)
    {
        $query = 'INSERT INTO attendee_event (event, attendee) VALUES (:eventID, :userID);';
        $params = ['eventID' => $eventID, 'userID' => $userID];
        return DB::query($query, $params);
    }

    public function removeAttendee($eventID, $userID)
    {
        $query = 'DELETE FROM attendee_event WHERE event = :eventID AND attendee = :userID;';
        $params = ['eventID' => $eventID, 'userID' => $userID];
        return DB::query($query, $params);
    }

    public function deleteOneByID($id)
    {
        $query = 'DELETE FROM event WHERE event.idevent = :id;';
        $params = ['id' => $id];
        return DB::query($query, $params);
    }

    public function editOne($id, $name, $dateStart, $dateEnd, $numberAllowed, $venue)
    {
        $query = 'UPDATE event SET name = :name, datestart = :datestart, dateend = :dateend, numberallowed = :numberallowed, venue = :venue WHERE idevent = :id;';
        $params = ['id' => $id, 'name' => $name, 'datestart' => $dateStart, 'dateend' => $dateEnd, 'numberallowed' => $numberAllowed, 'venue' => $venue];
        return DB::query($query, $params);
    }

    // Get the starting and end date in a single formatted way
    public function getDates()
    {
        $dateFormat = "d/m/Y";
        $new_starting_date = date($dateFormat, strtotime($this->datestart));
        $new_ending_date = date($dateFormat, strtotime($this->dateend));

        return $new_starting_date . " through " . $new_ending_date;
    }

    // Get dates in appropriate format for HTML <input type='datetime-local'>
    public function getStartingDateLocal()
    {
        return date('Y-m-d\TH:i', strtotime($this->datestart));
    }
    public function getEndingDateLocal()
    {
        return date('Y-m-d\TH:i', strtotime($this->dateend));
    }
}