<?php
require_once('./includes/dbh.php');

// The name of the properties in this class must match the Event table column names
class Session
{
    public $idsession;
    public $name;
    public $numberallowed;
    public $event;
    public $startdate;
    public $enddate;

    public function __construct()
    {
        DB::connect();
    }

    public function getAllBySessionID($id)
    {
        $query = 'SELECT * FROM session WHERE session.idsession = :id;';
        $params = ['id' => $id];
        $className = self::class;
        return DB::queryAll($query, $params, $className);
    }

    public function getAllByEventID($id)
    {
        $query = 'SELECT * FROM session WHERE session.event = :id;';
        $params = ['id' => $id];
        $className = self::class;
        return DB::queryAll($query, $params, $className);
    }

    public function getOneBySessionID($id)
    {
        $query = 'SELECT * FROM session WHERE session.idsession = :id;';
        $params = ['id' => $id];
        $className = self::class;
        return DB::queryOne($query, $params, $className);
    }

    public function deleteOneByID($id)
    {
        $query = 'DELETE FROM session WHERE session.idsession = :id;';
        $params = ['id' => $id];
        return DB::query($query, $params);
    }

    public function insertSelf()
    {
        $query = "INSERT INTO session(name, numberallowed, event, startdate, enddate) VALUES (:name, :numberallowed, :event, :startdate, :enddate)";
        $params = ['name' => $this->name, 'numberallowed' => $this->numberallowed, 'event' => $this->event, 'startdate' => $this->startdate, 'enddate' => $this->enddate];
        return DB::query($query, $params);
    }

    public function setName($newName)
    {
        $this->name = $newName;
    }

    public function setNumberAllowed($newNumberAllowed)
    {
        $this->numberallowed = $newNumberAllowed;
    }

    public function setEventID($newEventID)
    {
        $this->event = $newEventID;
    }

    public function setStartDate($newStartDate)
    {
        $this->startdate = $newStartDate;
    }

    public function setEndDate($newEndDate)
    {
        $this->enddate = $newEndDate;
    }
}