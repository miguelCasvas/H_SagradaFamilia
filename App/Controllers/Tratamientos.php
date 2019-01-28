<?php namespace App\Controllers;

use Core\View;

class Tratamientos
{
    public function historico(array $data =  null)
    {
        if (! empty($data)){
            foreach ($data as $name => $val)
                View::set($name, $val);
        }

        $tratamientos = (new \App\Models\Tratamientos())->getAll(['tratamientos.*, null AS txt_aplicaDto']);

        foreach ($tratamientos as $key => $tratamiento){
            $tratamientos[$key]['txt_aplicaDto'] = ($tratamiento['aplicaDto'] == 1) ? 'Si' : 'No';
        }

        View::set('tratamientos', $tratamientos);
        echo View::render('tratamientos');
    }

    public function formularioCreacion(array $data =  null)
    {
        if (! empty($data)){
            foreach ($data as $name => $val)
                View::set($name, $val);
        }

        View::set('urlForm', DOMAIN . '/tratamientos/crear');
        echo View::render('tratamientoCreacion');
    }

    public function crear()
    {

        try{
            $model = new \App\Models\Tratamientos();

            foreach ($_POST as $campo => $val)
                $model->$campo = $val;

            \App\Models\Tratamientos::insert($model);
            $this->historico();

        }catch(\Exception $e){

            $this->formularioCreacion(['_error' => $e]);

        }

    }

    public function editar($id)
    {
        $tratamiento = (new \App\Models\Tratamientos())->getById((int) $id);
        View::set('tratamiento', $tratamiento);
        View::set('urlForm', DOMAIN . '/tratamientos/editarReg/' . $id);

        echo View::render('tratamientoCreacion');
    }

    public function editarReg($id)
    {
        try{
            $model = new \App\Models\Tratamientos();

            foreach ($_POST as $campo => $val)
                $model->$campo = $val;

            \App\Models\Tratamientos::update($model, $id);

            $this->editar($id);

        }catch(\Exception $e){
            echo $e->getMessage();
        }

    }

    public function eliminar($id)
    {
        try{

            $model = new \App\Models\Tratamientos();
            \App\Models\Tratamientos::delete($model, $id);
            $this->historico(['_success' => 'Registro Eliminado']);

        }catch(\Exception $e){

            $this->historico(['_error' => $e]);
        }
    }
}