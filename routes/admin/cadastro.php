<?php

use \App\Http\Response;
use \App\Controller\Admin;

//rota de cadastro
$obRouter->get('/admin/cadastro',[
    'middlewares' => [
        'require-admin-logout'
    ],
    function($request){
        return new Response(200,Admin\Cadastro::getCadastro($request));
    } 
 ]);

 $obRouter->post('/admin/cadastro',[
    'middlewares' => [
        'require-admin-logout'
    ],
    function($request){
        return new Response(200,Admin\Cadastro::insertUser($request));
    } 
 ]);
