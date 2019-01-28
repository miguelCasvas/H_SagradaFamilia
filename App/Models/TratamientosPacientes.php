<?php namespace App\Models;

use Core\Database;

defined("APPPATH") OR die("Access denied");

class TratamientosPacientes extends ModelBase
{

    protected $tabla = 'tratamientospacientes';

    protected $atributos = [
        'idPaciente' => null,
        'idTratamiento' => null,
        'fecha' => null,
        'valor' => null,
    ];


    /**
     * @param $idPaciente
     * @param $idTratamiento
     * @return mixed
     */
    public function validarRel($idPaciente, $idTratamiento)
    {

        $sql = "SELECT `id` FROM `tratamientospacientes` WHERE `idPaciente` = ? AND `idTratamiento` = ?;";

        try {

            $connection = Database::instance();
            $query = $connection->prepare($sql);
            $query->execute([$idPaciente, $idTratamiento]);

            return $query->fetchAll(\PDO::FETCH_ASSOC);

        }catch(\PDOException $e){
            print "Error!: " . $e->getMessage();
        }

    }

    /**
     * Informe de ingresos
     *
     * @return mixed
     */
    public function informeIngresos_1()
    {

        $sql = "
                    SELECT 
                      COUNT(t1.`id`) AS cant_tratamientos,
                      SUM(t2.`valor`) AS ingresos,
                      t1.`nombre` AS tpoTratamiento 
                    FROM
                      `tratamientos` as t1 
                      INNER JOIN `tratamientospacientes` As t2 
                        ON t1.`id` = t2.`idTratamiento` 
                    group by t1.`id` 
                    ORDER BY SUM(t2.`valor`) DESC;        
        ";

        try {

            $connection = Database::instance();
            $query = $connection->prepare($sql);
            $query->execute();

            return $query->fetchAll(\PDO::FETCH_ASSOC);

        }catch(\PDOException $e){
            print "Error!: " . $e->getMessage();
        }

    }

    /**
     * Informe de ingresos
     *
     * @return mixed
     */
    public function informeIngresos_2()
    {

        $sql = "
                    SELECT 
                      COUNT(t1.`id`) AS cant_tratamientos,
                      t1.`nombre` AS tpoTratamiento 
                    FROM
                      `tratamientos` as t1 
                      INNER JOIN `tratamientospacientes` As t2 
                        ON t1.`id` = t2.`idTratamiento` 
                    group by t1.`id` 
                    ORDER BY COUNT(t1.`id`) DESC;        
        ";

        try {

            $connection = Database::instance();
            $query = $connection->prepare($sql);
            $query->execute();

            return $query->fetchAll(\PDO::FETCH_ASSOC);

        }catch(\PDOException $e){
            print "Error!: " . $e->getMessage();
        }

    }


    /**
     * Informe de ingresos
     *
     * @return mixed
     */
    public function informeIngresos_3()
    {

        $sql = "
            SELECT 
              COUNT(t1.`id`) AS cant_pacientes,
              date_format (t2.`fecha`, '%Y') AS anio,
              date_format (t2.`fecha`, '%M') AS mes
            FROM
              `pasientes` as t1 
              INNER JOIN `tratamientospacientes` As t2 
                ON t1.`id` = t2.`idPaciente`
            group by DATE_FORMAT (t2.`fecha`, '%M / %Y') 
            ORDER BY COUNT(t1.`id`) DESC LIMIT 3;      
        ";

        try {

            $connection = Database::instance();
            $query = $connection->prepare($sql);
            $query->execute();

            return $query->fetchAll(\PDO::FETCH_ASSOC);

        }catch(\PDOException $e){
            print "Error!: " . $e->getMessage();
        }

    }


    /**
     *
     */
    public function informeRazon_1()
    {
       $sql = "SELECT count(`id`) AS totalTratamientos FROM `tratamientospacientes`;";

        try {

            $connection = Database::instance();
            $query = $connection->prepare($sql);
            $query->execute();

            return $query->fetch(\PDO::FETCH_ASSOC);

        }catch(\PDOException $e){
            print "Error!: " . $e->getMessage();
        }

    }
}