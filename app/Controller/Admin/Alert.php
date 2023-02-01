<?php

namespace App\Controller\Admin;
use \App\Utils\View;

class Alert{

    public static function getError($message){//mensagems de sucesso
        return View::render('admin/alert/status',[
            'tipo' => 'danger',
            'message' => $message
        ]);
    }

    public static function getSuccess($message){//mensagens de error
        return View::render('admin/alert/status',[
            'tipo' => 'success',
            'message' => $message
        ]);
    }

}