<?php

namespace App\Controller\Admin;

use \App\Utils\View;
use \App\Model\Entity\User as EntityUser;;
use \App\Session\Admin\Cadastro as SessionAdminCadastro;

class Cadastro extends Page{

    public static function getCadastro($request,$errorMessage = null){
        $status = !is_null($errorMessage) ? Alert::getError($errorMessage) : '';
        $content = View::render('admin/cadastro',[
            'status' => $status
        ]);

        return parent::getPage('Cadastro pizza',$content);
    }

    public static function insertUser($request){
        $postVars = $request->getPostVars();

        $email = $postVars['email']??'';
        $senha = $postVars['senha']??'';
        $telefone = $postVars['telefone']??'';
        $senha2 = $postVars['senha2']??'';
        $nome = $postVars['nome']??'';

        $obUser = new EntityUser;

        $obUser->email = $email;
        $obUser->senha = $senha;
        $obUser->telefone = $telefone;
        $obUser->nome = $nome;
        
        if(!$senha==$senha2){
            

        }

        SessionAdminCadastro::Cadastro($obUser);
        
        $obUser->cadastrar();
        
        return self::getCadastro($request);
    }
}