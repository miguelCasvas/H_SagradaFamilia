<?php namespace App\Models;

use App\Crud;
use Core\Database;

defined("APPPATH") OR die("Access denied");

class User implements Crud
{
    /**
     * @return mixed
     */
    public static function getAll()
    {
        try {
            $connection = Database::instance();
            $sql = "SELECT * from usuarios";
            $query = $connection->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        }
        catch(\PDOException $e)
        {
            print "Error!: " . $e->getMessage();
        }
    }

    public static function getById($id)
    {}

    public static function insert($data)
    {}

    public static function update($data)
    {}

    public static function delete($id)
    {}
}