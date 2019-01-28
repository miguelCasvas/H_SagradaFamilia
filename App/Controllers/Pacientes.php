<?php namespace App\Controllers;

use App\Models\Ciudades;
use App\Models\Pasientes;
use App\Models\TratamientosPacientes;
use Core\View;

class Pacientes
{

    /**
     * [historico Historico de pasientes]
     */
    public function historico()
    {
        $pasientes = (new \App\Models\Pasientes())->getAll(['pasientes.*, null AS ciudad']);

        # Busqueda de ciuidad
        foreach ($pasientes as $key => $pasiente){
            $ciudad = (new Ciudades())->getById($pasiente['id_ciudad']);
            $pasientes[$key]['ciudad'] = $ciudad['ciudad'];
        }

        View::set('pasientes', $pasientes);
        echo View::render('pasientes');
    }

    /**
     * [Crear Creación de pasiente en el sistema]
     */
    public function formularioCreacion(array $data = null)
    {
        if (! empty($data)){
            foreach ($data as $name => $val)
                View::set($name, $val);
        }

        $ciudades = (new Ciudades())->getAll();
        View::set('ciudades', $ciudades);

        echo View::render('pasienteCreacion');
    }

    /**
     * [crear Creacion de nuevo pasiente en el sistema]
     */
    public function crear()
    {

        try{
            $model = new \App\Models\Pasientes();

            foreach ($_POST as $campo => $val){
                $model->$campo = $val;
            }

            $model::insert($model);
            $this->historico();

        }catch(\Exception $e){

            $this->formularioCreacion(['_error' => $e]);

        }

    }

    /**
     * Vista Tratamientos relacionados a un paciente
     */
    public function tratamientosAplicados()
    {

        $tratamientos = (new \App\Models\Tratamientos())->getAll();
        View::set('tratamientos', $tratamientos);
        echo View::render('tratamientosAplicados');

    }

    /**
     * Retorna los tratamientos relacionados a un paciente
     */
    public function tratamientosPaciente(array $data = null)
    {
        $identificacion = @$_GET['identificacion'];
        $tpoIden = @$_GET['tpoIdentificacion'];

        if (! empty($data)){
            foreach ($data as $name => $val)
                View::set($name, $val);
        }

        $model = new Pasientes();
        $data = $model->getTratamientosPaciente($identificacion, $tpoIden);
        $content = '';

        foreach ($data as $datum){
            View::set('data', $datum);
            $content .= View::render('partials/tratamientosPorPaciente');
        }

        if (empty($content)){
            $content = '<tr><td colspan="5" align="center">Sin Tratamientos!</td></tr>';
        }

        echo $content;
    }

    public function nuevoTratamiento()
    {

        $idPaciente     = @$_GET['idPaciente'];
        $idCiudad       = @$_GET['idCiudad'];
        $idTratamiento  = @$_GET['idTratamiento'];
        $descuento      = @$_GET['dtoTratamiento'];
        $vlr            = @$_GET['vlrTratamiento'];

        try{
            $model_1 = new TratamientosPacientes();

            // Validar si el paciente ya tiene el tratamiento
            if(count($model_1->validarRel($idPaciente, $idTratamiento)) > 0)
                throw new \Exception('El Paciente ya cuenta con este tratamiento', 1);

            // Validar si la ciudad es diferente a Bogotá y el tratamiento tiene descuento
            if ($idCiudad != 1 && $descuento == 1)
                $vlr = $vlr - ($vlr * 0.10);

            $model_1->idPaciente = $idPaciente;
            $model_1->idTratamiento = $idTratamiento;
            $model_1->fecha = date('Y-m-d H:i:s');
            $model_1->valor = $vlr;

            TratamientosPacientes::insert($model_1);

            echo 'success';

        }catch(\Exception $e){
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            echo $e->getMessage();
        }

    }
}