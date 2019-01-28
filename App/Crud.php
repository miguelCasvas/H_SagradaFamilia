<?php namespace App;

defined("APPPATH") OR die("Access denied");

interface Crud
{
    public function getAll();
    public function getById($id);
    public static function insert($data);
    public static function update($model, $id);
    public static function delete($model, $id);
}