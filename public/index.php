<?php

// Directorio del proyecto
define('PROJECTPATH', dirname(__DIR__));

// Directorio app
define('APPPATH', PROJECTPATH . '/App');

// Dominio
define('DOMAIN', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT']);

#autoload con namespaces
function autoload_classes($class_name)
{
    $fileName = PROJECTPATH . '/' . str_replace('\\', '/', $class_name) . '.php';

    if(is_file($fileName))
        include_once $fileName;
}

spl_autoload_register('autoload_classes');

$app = new \Core\App();

$app->render();
