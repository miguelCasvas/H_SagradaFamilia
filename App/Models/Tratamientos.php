<?php namespace App\Models;

defined("APPPATH") OR die("Access denied");

class Tratamientos extends ModelBase
{

    protected $tabla = 'tratamientos';

    protected $atributos = [
        'nombre' => null,
        'valor' => null,
        'aplicaDto' => null
    ];

}