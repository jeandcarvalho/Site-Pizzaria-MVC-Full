<?php

namespace App\Controller\Pages;

USE \App\Utils\View;

class Pedidos extends Page{

        
    public static function getPedidos(){

        $content = View::render('pages/pedidos',[
            
        ]);

        return parent::getPage('Pedidos', $content);
    }

}
