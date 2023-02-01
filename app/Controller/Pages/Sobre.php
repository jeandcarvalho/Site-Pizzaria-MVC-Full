<?php

namespace App\Controller\Pages;

USE \App\Utils\View;
USE \App\Model\Entity\Organization;


class Sobre extends Page{

        
    public static function getSobre(){
        $obOrganization = new Organization;

        $content = View::render('pages/sobre',[
            'name' => $obOrganization->nome,
            'description' => $obOrganization->descricao,
            'sobre' => "lorem   Ipsum   is  simply  dummy   text"
        ]);
        return parent::getPage('Sobre', $content);
    }

}
