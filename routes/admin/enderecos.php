<?php

use \App\Http\Response;
use \App\Controller\Admin;

 $obRouter->get('/admin/enderecos',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request){
     return new Response(200,Admin\Enderecos::getEnderecos($request));
    } 
 ]);
 
 //rota de enderecos insert
 $obRouter->post('/admin/enderecos',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request){
     return new Response(200,Admin\Enderecos::insertEnderecos($request));
    } 
 ]);

    //delete de enderecos
$obRouter->get('/admin/enderecos/{id_user}/delete',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request,$id_user){
        return new Response(200,Admin\Enderecos::getDeleteEnderecos($request,$id_user));
    } 
 ]);

 //delete de enderecos
$obRouter->post('/admin/enderecos/{id_user}/delete',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request,$id_user){
        return new Response(200,Admin\Enderecos::setDeleteEnderecos($request,$id_user));
    } 
 ]);