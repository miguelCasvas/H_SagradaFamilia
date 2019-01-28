<?php namespace App\Controllers;


use App\Models\User;
use Core\View;

class Home
{

    public function inicio()
    {
        echo View::render('home');
    }

    public function users()
    {

        View::set("title", 'Usuarios del sistema');
        View::set("users", User::getAll());
        View::render('users');
    }
}