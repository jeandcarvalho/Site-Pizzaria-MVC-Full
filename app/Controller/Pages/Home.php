<?php

namespace App\Controller\Pages;

USE \App\Utils\View;
USE \App\Model\Entity\Organization;


class Home extends Page{

        
    public static function getHome(){
        $obOrganization = new Organization;

        $content = View::render('pages/home',[
            'name' => $obOrganization->nome,
            'description' => $obOrganization->descricao
        ]);
        return parent::getPage('Pizzaria genérica HOME', $content);
    }

}
