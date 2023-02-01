<?php

namespace App\utils;

class View{


    private static $vars = [];

    public static function init($vars = []){
        self::$vars = $vars;
    }

    private static function getContentView($view){ //retorna o conteúdo bruto de uma view
        $file = __DIR__ . '/../../resources/view/'.$view.'.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }


    public static function render($view, $vars = []){  //retorna o conteúdo renderizado
        
        $contentView = self::getContentView($view); //conteúdo da view

        $vars = array_merge(self::$vars,$vars);

        $keys = array_keys($vars);
        $keys = array_map(function($item){
            return '{{'.$item.'}}';
        },$keys);

        return str_replace($keys,array_values($vars),$contentView); //conteúdo renderizado
    }
}