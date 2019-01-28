<?php namespace App\Models;

use App\Crud;
use Core\Database;

defined("APPPATH") OR die("Access denied");

class ModelBase implements Crud
{

    /**
     * @var array
     */
    protected $atributos = [];

    /**
     * @var
     */
    protected $tabla;

    /**
     * @var string
     */
    protected $pk = 'id';


    /**
     * @return mixed
     */
    public function getAll(array $columns = null)
    {
        try {

            $colunsSelect = '*';

            if(! empty($columns))
                $colunsSelect = implode($columns, ',');

            $connection = Database::instance();
            $sql = "SELECT $colunsSelect FROM " . $this->tabla;
            $query = $connection->prepare($sql);
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }catch(\PDOException $e){
            print "Error!: " . $e->getMessage();
        }
    }

    public function getById($id)
    {
        try {

            $colunsSelect = '*';

            if(! empty($columns))
                $colunsSelect = implode($columns, ',');

            $connection = Database::instance();
            $sql = "SELECT $colunsSelect FROM " . $this->tabla . " WHERE " . $this->pk . "=" . (int) $id;
            $query = $connection->prepare($sql);
            $query->execute();
            return $query->fetch(\PDO::FETCH_ASSOC);
        }
        catch(\PDOException $e)
        {
            print "Error!: " . $e->getMessage();
        }

    }

    public static function insert($model)
    {

        if (! ($model instanceof ModelBase))
            throw new \Exception('Error en parametros pasados', 1);

        try {
            $connection = Database::instance();

            $columnsInsert = [];
            $insertVals = [];
            $dataSave = [];

            foreach ($model->getAtributos() as $column => $val){

                if ($val != ''){
                    $columnsInsert[] = $column;
                    $insertVals[] = '?';
                    $dataSave[] = $val;
                }

            }

            $stringColumns = implode($columnsInsert, ',');
            $stringVals = implode($insertVals, ',');

            $sql = "INSERT INTO ".$model->tabla." ($stringColumns) VALUES ($stringVals)";
            $query = $connection->prepare($sql);
            $query->execute($dataSave);

        }
        catch(\PDOException $e)
        {
            throw $e;
        }

    }

    public static function update($model, $id)
    {
        if (! ($model instanceof ModelBase))
            throw new \Exception('Error en parametros pasados', 1);

        try {
            $connection = Database::instance();

            $columnsUpdate = [];
            $dataSave = [];

            foreach ($model->getAtributos() as $column => $val){

                if ($val != ''){
                    $columnsUpdate[] = $column . ' = ?';
                    $dataSave[] = $val;
                }

            }
            $dataSave[] = (int)$id;
            $stringColumns = implode($columnsUpdate, ',');

            $sql = "UPDATE $model->tabla SET $stringColumns WHERE $model->pk = ?";
            $query = $connection->prepare($sql);
            $query->execute($dataSave);

        }
        catch(\PDOException $e)
        {
            throw $e;
        }
    }

    public static function delete($model, $id)
    {
        try {
            $connection = Database::instance();
            $sql = "DELETE FROM ".$model->tabla." WHERE ". $model->pk . '= ?' ;
            $query = $connection->prepare($sql);
            $query->execute([$id]);
        }
        catch(\PDOException $e)
        {
            throw $e;
        }
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        // Si se asigna valor directo a campo en BD
        if (array_key_exists($name, $this->atributos)){
            $this->atributos[$name] = $value;
        }

    }

    /**
     * @return array
     */
    public function getAtributos()
    {
        return $this->atributos;
    }
}