<?php namespace App\Models;

use Core\Database;

defined("APPPATH") OR die("Access denied");

class Pasientes extends ModelBase
{

    protected $tabla = 'pasientes';

    protected $atributos = [
        'apellidos' => null,
        'nombres' => null,
        'tpo_identificacion' => null,
        'identificacion' => null,
        'direccion' => null,
        'telefono' => null,
        'id_ciudad' => null
    ];

    /**
     * Tratamientos relacionados a un paciente
     *
     * @param $idPaciente
     * @param $tpoId
     * @return mixed
     */
    public function getTratamientosPaciente($idPaciente, $tpoId)
    {

        $sql = "SELECT 
                      `pasientes`.`id` AS idPaciente,
                      `pasientes`.`identificacion`,
                      CONCAT(`pasientes`.`nombres`, ' ', `pasientes`.`apellidos`) AS nombresApellidos,
                      `pasientes`.`id_ciudad`,
                      (SELECT `ciudad` FROM `ciudades` 	WHERE `id` = `pasientes`.`id_ciudad` LIMIT 1) AS ciudad,
                      `tratamientos`.`nombre` AS tratamiento,
                      `tratamientospacientes`.`valor` AS vlrTratamiento
                 FROM
                      `pasientes` 
                      LEFT JOIN `tratamientospacientes` 
                        ON `pasientes`.`id` = `tratamientospacientes`.`idPaciente` 
                      LEFT JOIN `tratamientos` 
                        ON `tratamientos`.`id` = `tratamientospacientes`.`idTratamiento` 
                    WHERE `pasientes`.`identificacion` = ?
                    AND `pasientes`.`tpo_identificacion` = ?";

        try {
            $connection = Database::instance();
            $query = $connection->prepare($sql);
            $query->execute([$idPaciente, $tpoId]);
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }catch(\PDOException $e){
            print "Error!: " . $e->getMessage();
        }

    }
}