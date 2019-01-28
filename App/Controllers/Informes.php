<?php namespace App\Controllers;

use App\Models\TratamientosPacientes;
use Core\View;

class Informes
{

    public function ingresos()
    {

        $data = (new TratamientosPacientes())->informeIngresos_1();
        $rankingRazonVisita = (new TratamientosPacientes())->informeIngresos_2();
        $totalTratamientos = (new TratamientosPacientes())->informeRazon_1();
        $informeXmes = (new TratamientosPacientes())->informeIngresos_3();

        View::set('tabla_1', $data);
        View::set('rankingRazonV', $rankingRazonVisita);
        View::set('informeXmes', $informeXmes);
        View::set('totalIngreso', $totalTratamientos);

        echo View::render('informeIngresos');
    }
    
}