<?php namespace Core;

defined("APPPATH") OR die("Access denied");

class View
{

    /**
     * @var
     */
    protected static $data = [];

    /**
     *
     */
    const  VIEWS_PATH = '../App/views/';

    /**
     *
     */
    const EXTENSION_TEMPLATES = 'php';

    /**
     * [render views with data]
     * @param [String]  [template name]
     * @throws \Exception
     * @return string
     */
    public static function render($template)
    {

        if( ! file_exists(self::VIEWS_PATH . $template . '.' . self::EXTENSION_TEMPLATES)){
            throw new \Exception('Error: el archivo' . self::VIEWS_PATH . $template . ' no existe', 1);
        }

        ob_start();

        self::addDefecto();
        extract(self::$data);
        include(self::VIEWS_PATH . $template . '.' . self::EXTENSION_TEMPLATES);
        $str = ob_get_contents();
        ob_end_clean();
        return $str;
    }

    /**
     * [set Set Data form views]
     * @param [string] $name  [key]
     * @param [mixed] $value [value]
     */
    public static function set($name, $value)
    {
        self::$data[$name] = $value;
    }

    public static function addDefecto()
    {
        // Cargue de url dominio
        if(! isset(self::$data['_domain'])){
            self::$data['_domain'] = DOMAIN;
        }

        // Cargue de url template
        if(! isset(self::$data['urlTheme'])){
            self::$data['urlTheme'] = DOMAIN . '/template/AdminLTE-2.4.5';
        }
    }

}