<?php
use \App\Controller\Pages;
use \App\Http\Response;

//rota da home
$obRouter->get('/',[
    function(){
     return new Response(200,Pages\Home::getHome());
    } 
 ]);

//rota da home insert
$obRouter->post('/',[
   function($request){
    return new Response(200,Pages\Home::getHome());
   } 
]);
 
 //rota sobre
 $obRouter->get('/sobre',[
    function(){
     return new Response(200,Pages\Sobre::getSobre());
    } 
 ]);

 //rota cardápio
 $obRouter->get('/pedidos',[
   function(){
    return new Response(200,Pages\Pedidos::getPedidos());
   } 
]);


