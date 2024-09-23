<?php
require_once('./includes/dbh.php');

class Venue
{
    public $idvenue;
    public $name;
    public $capacity;

    public function __construct()
    {
        DB::connect();
    }

    public function getAll()
    {
        $query = 'SELECT * FROM venue;';
        $className = self::class;
        return DB::queryAll($query, [], $className);
    }

    public function getOneByID($id)
    {
        $query = 'SELECT * FROM venue WHERE venue.idvenue = :id;';
        $params = ['id' => $id];
        $className = self::class;
        return DB::queryOne($query, $params, $className);
    }
}