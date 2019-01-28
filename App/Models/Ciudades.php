<?php namespace App\Models;

defined("APPPATH") OR die("Access denied");

class Ciudades extends ModelBase
{

    protected $tabla = 'ciudades';

    protected $atributos = [
        'ciudad' => null
    ];

}