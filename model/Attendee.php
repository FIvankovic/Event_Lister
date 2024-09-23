<?php
require_once('./includes/dbh.php');

class Attendee
{
    public $idattendee;
    public $name;
    public $role;

    public function __construct()
    {
        DB::connect();
    }

    public function getAll()
    {
        $query = 'SELECT * FROM attendee;';
        $className = self::class;
        return DB::queryAll($query, [], $className);
    }

    public function getManagers()
    {
        $query = 'SELECT * FROM attendee WHERE role = 2;';
        $className = self::class;
        return DB::queryAll($query, [], $className);
    }

    public function getManagersOnEventID($eventID)
    {
        $query = 'SELECT * FROM event INNER JOIN manager_event ON event.idevent = manager_event.event INNER JOIN attendee ON attendee.idattendee = manager_event.manager WHERE attendee.role = 2 AND event.idevent = :eventID;';
        $params = ['eventID' => $eventID];
        $className = self::class;
        return DB::queryAll($query, $params, $className);
    }

    public function getOneByID($id)
    {
        $query = 'SELECT * FROM attendee WHERE attendee.idattendee = :id;';
        $params = ['id' => $id];
        $className = self::class;
        return DB::queryOne($query, $params, $className);
    }
}