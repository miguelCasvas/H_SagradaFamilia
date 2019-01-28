<?php namespace Core;

/**
 * Class Database
 * @package Core
 */
class Database
{

    /**
     * @desc nombre del usuario de la base de datos
     * @var $_dbUser
     * @access private
     */
    private $_dbUser;

    /**
     * @desc password de la base de datos
     * @var $_dbPassword
     * @access private
     */
    private $_dbPassword;

    /**
     * @desc nombre del host
     * @var $_dbHost
     * @access private
     */
    private $_dbHost;

    /**
     * @desc nombre de la base de datos
     * @var $_dbName
     * @access protected
     */
    protected $_dbName;

    /**
     * @desc conexión a la base de datos
     * @var $_connection
     * @access private
     */
    private $_connection;

    /**
     * @desc instancia de la base de datos
     * @var $_instance
     * @access private
     */
    private static $_instance;

    public function __construct()
    {

        try{
            // Datos de configuración del App
            $config = App::getConfig();

            $this->_dbHost = $config['host'];
            $this->_dbUser = $config['user'];
            $this->_dbPassword = $config['password'];
            $this->_dbName = $config['database'];

            $this->_connection = new \PDO('mysql:host='.$this->_dbHost.'; dbname='.$this->_dbName, $this->_dbUser, $this->_dbPassword);
            $this->_connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->_connection->exec("SET CHARACTER SET utf8");

        }catch (\PDOException $e)
        {
            print "Error!: " . $e->getMessage();
            die();
        }

    }

    /**
     * [prepare]
     * @param  [type] $sql [description]
     * @return [type]      [description]
     */
    public function prepare($sql)
    {
        return $this->_connection->prepare($sql);
    }

    /**
     * [instance singleton]
     * @return [object] [class database]
     */
    public static function instance()
    {
        if(!isset(self::$_instance)){
            $class = __CLASS__;
            self::$_instance = new $class;
        }
        return self::$_instance;
    }

    /**
     * [__clone Evita que el objeto se pueda clonar]
     * @return [type] [message]
     */
    public function __clone()
    {
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
    }
}