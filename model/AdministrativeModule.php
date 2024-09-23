<?php
require_once('./includes/dbh.php');

class AdministrativeModule{
    
    public function __construct() {
        DB::connect();
    }
    
    public function getAll($table){
        $sql = "SELECT * FROM " . $table;
        $className = self::class;
        return DB::queryAll($sql, [], $className);
    }
    
    public function deleteOneByIDSession($id)
    {
        $query = 'DELETE FROM session WHERE session.idsession = :id;';
        $params = ['id' => $id];
        return DB::query($query, $params);
    }
    
    public function deleteOneByIDAttendee($id)
    {
        $query = 'DELETE FROM attendee WHERE attendee.idattendee = :id;';
        $params = ['id' => $id];
        return DB::query($query, $params);
    }
    
    public function getAttendeeByID($id)
    {
        $query = 'SELECT * FROM attendee WHERE attendee.idattendee = :id;';
        $params = ['id' => $id];
        $className = self::class;
        return DB::queryOne($query, $params, $className);
    }
    
    public function editOneAttendee($id, $name, $password, $role)
    {
        $query = 'UPDATE attendee SET name = :name, password = :password, role = :role WHERE idattendee = :id;';
        $params = ['id' => $id, 'name' => $name, 'password' => $password, 'role' => $role];
        return DB::query($query, $params);
    }
    
    public function deleteVenueByID($id)
    {
        $query = 'DELETE FROM venue WHERE venue.idvenue = :id;';
        $params = ['id' => $id];
        return DB::query($query, $params);
    }
    
    public function getVenueByID($id){
        $query = 'SELECT * FROM venue WHERE venue.idvenue = :id;';
        $params = ['id' => $id];
        $className = self::class;
        return DB::queryOne($query, $params, $className);
    }
    
    public function editOneVenue($idvenue, $name, $capacity){
        $query = 'UPDATE venue SET name = :name, capacity = :capacity WHERE idvenue = :idvenue;';
        $params = ['idvenue' => $idvenue, 'name' => $name, 'capacity' => $capacity];
        return DB::query($query, $params);
    }
    
     public function newVenue($idvenue,$name,$capacity)
    {
        $query = "INSERT INTO venue(idvenue, name, capacity) VALUES (:idvenue, :name,:capacity)";
        $params = ['idvenue' => $idvenue,'name' => $name, 'capacity' => $capacity];
        return DB::query($query, $params);
    }

    
}

