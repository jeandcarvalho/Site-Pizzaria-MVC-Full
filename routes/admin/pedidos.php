<?php

use \App\Http\Response;
use \App\Controller\Admin;

//rota de pedidos
$obRouter->get('/admin/pedidos',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request){
        return new Response(200,Admin\Pedidos::getPedidos($request));
    } 
 ]);

 //rota de cadastro de pedidos
$obRouter->get('/admin/pedidos/new',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request){
        return new Response(200,Admin\Pedidos::getNewPedidos($request));
    } 
 ]);


 //rota de cadastro de pedidos post
 $obRouter->post('/admin/pedidos/new',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request){
        return new Response(200,Admin\Pedidos::setNewPedidos($request));
    } 
 ]);

  //edição de pedidos
$obRouter->get('/admin/pedidos/{id}/edit',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request,$id){
        return new Response(200,Admin\Pedidos::getEditPedidos($request,$id));
    } 
 ]);

   //edição de pedidos
$obRouter->post('/admin/pedidos/{id}/edit',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request,$id){
        return new Response(200,Admin\Pedidos::setEditPedidos($request,$id));
    } 
 ]);

   //delete de pedidos
$obRouter->get('/admin/pedidos/{id}/delete',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request,$id){
        return new Response(200,Admin\Pedidos::getDeletePedidos($request,$id));
    } 
 ]);

 //delete de pedidos
$obRouter->post('/admin/pedidos/{id}/delete',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request,$id){
        return new Response(200,Admin\Pedidos::setDeletePedidos($request,$id));
    } 
 ]);
 

