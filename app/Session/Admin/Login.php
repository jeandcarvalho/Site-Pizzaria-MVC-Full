<?php

namespace App\Session\Admin;

class Login{

    private static function init(){
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    public static function login($obUser){ //cria login
        self::init();

        $_SESSION['admin']['usuario'] = [
            'id_user' => $obUser->id_user,
            'nome' => $obUser->nome,
            'email' => $obUser->email
        ];
        return true;
    }

    public static function isLogged(){
        self::init();
        return isset($_SESSION['admin']['usuario']['id_user']);
    }

    public static function logout(){ 
        self::init();
        unset($_SESSION['admin']['usuario']);
        return true;
    }
}