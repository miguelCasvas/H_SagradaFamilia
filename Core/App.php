<?php namespace Core;

defined("APPPATH") OR die('Acceso denegado');

class App
{

    /**
     * @var
     */
    private $_controller;

    /**
     * @var
     */
    private $_method = 'index';

    /**
     * @var array
     */
    private $_params = [];

    /**
     * @const
     */
    const  NAMESPACE_CONTROLLERS = '\App\Controllers\\';

    /**
     * @const
     */
    const CONTROLLERS_PATH = '../App/Controllers/';

    public function __construct()
    {

        // url parseada
        $url = $this->parserURL();

        // se comprueba que exista el archivo en el directorio controllers
        if(file_exists(self::CONTROLLERS_PATH . ucfirst($url[0]) . '.php')){
            // nombre del archivo a llamar
            $this->_controller = ucfirst($url[0]);

            // se elimina el controlador de url, así solo quedaran los parametros del método
            unset($url[0]);
        }else{
            include  APPPATH . '/views/errors/404.php';
            exit;
        }

        // clase con su espacio de nombres
        $fullClass = self::NAMESPACE_CONTROLLERS . $this->_controller;

        // asociación de la instancia a $this_controller
        $this->_controller = new $fullClass;

        // si existe el segundo segmento se comprueba que el método exista en la clase
        if(isset($url[1])){
            // metodo
            $this->_method = $url[1];

            if(method_exists($this->_controller, $url[1])){
                // se elimina el metodo, con esto solo quedan los parametros del método
                unset($url[1]);
            }else{
                throw new \Exception("Error processing Method {$this->_method}", 1);
            }

            // asociación del restro de segmentos a $this->_params para pasarlos al método llamado, por defecto sera un array vacío
            $this->_params = $url ? array_values($url) : [];
        }

    }

    /**
     * @return array
     */
    private function parserURL()
    {
       if(isset($_GET['url'])){
           return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
       }

       return null;

    }

    /**
     * [getConfig Configuración de la app]
     * @return [Array] [Array con la config]
     */
    public static function getConfig()
    {
        return parse_ini_file(APPPATH . '/config/config.ini');
    }

    /**
     *
     * Ejecución del controlador/método que se ha llamado con los parámetros
     *
     */
    public function render()
    {
        call_user_func_array([$this->_controller, $this->_method], $this->_params);
    }


}