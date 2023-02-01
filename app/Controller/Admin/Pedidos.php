<?php

namespace App\Controller\Admin;

use \App\Utils\View;
use \App\Model\Entity\Pedidos as EntityPedidos;
USE \App\Model\Entity\Enderecos as EntityEnderecos;
use \WilliamCosta\DatabaseManager\Pagination;

class Pedidos extends Page{

    private static function getPedidosCadastrados($request,&$obPagination){
        $cadastrados= '';

        $quantidadeTotal = EntityPedidos::getPedidos(null,null,null,'COUNT(*) as qtd')->fetchObject()->qtd;
        
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        $obPagination = new Pagination($quantidadeTotal,$paginaAtual,5); //configura quantos pedidos aparece por página

        $results = EntityPedidos::getPedidos(null,'id DESC',$obPagination->getLimit());

        while($obPedidos = $results->fetchObject(EntityPedidos::class)){

            $cadastrados .= View::render('admin/modules/pedidos/item',[
                'quantidade' => $obPedidos->qnt,
                'id' => $obPedidos->id,
                'sabor' => $obPedidos->sabor,
                'tamanho' =>$obPedidos->tamanho,
                'endereco' =>$obPedidos->endereco,
                'data' => date('Y/m/d',strtotime($obPedidos->data))
            ]);

        }
        return  $cadastrados;
    }

    public static function getPedidos($request){
        $content = View::render('admin/modules/pedidos/index',[
            'pedidos' => self::getPedidosCadastrados($request,$obPagination),
            'pagination' => parent::getPagination($request,$obPagination),
            'status' => self::getStatus($request)
        ]);

        return parent::getPanel('Seus Pedidos',$content,'pedidos');
    }

    public static function getNewPedidos($request){
        $content = View::render('admin/modules/pedidos/form',[
            'title' => 'Novo Pedido',
            'ends' => self::getEnderecosCadastrados($request),
        ]);

        return parent::getPanel('Novo Pedido',$content,'pedidos');
    }

    private static function getEnderecosCadastrados($request){
        $cadastrados= '';
        
        $results = EntityEnderecos::getEnderecos(null,'id_user ASC');
        
        while($obEnderecos = $results->fetchObject(EntityEnderecos::class)){
            $cadastrados .= View::render('admin/modules/pedidos/ends',[
                'rua' => $obEnderecos->rua,
                'id_user' => $obEnderecos->id_user,
                'numero' => $obEnderecos->numero,
                'bairro' => $obEnderecos->bairro,
                'cep' => $obEnderecos->cep,
            ]);
        }
        return  $cadastrados;    
    }

    public static function setNewPedidos($request){

        $postVars = $request->getPostVars();

        $obPedidos = new EntityPedidos;

        $obPedidos->sabor = $postVars['sabor'] ?? '';
        $obPedidos->tamanho = $postVars['tamanho'] ?? '';
        $obPedidos->qnt = $postVars['qnt'] ?? '';
        $obPedidos->endereco = $postVars['endereço'] ?? '';
        $obPedidos->data = date('Y/m/d',strtotime($obPedidos->data));
        $obPedidos->cadastrar();

        $request->getRouter()->redirect('/admin/pedidos/'.$obPedidos->id.'/edit?status=created');
    }

    public static function getEditPedidos($request,$id){
        $obPedidos = EntityPedidos::getPedidosById($id);
        if(!$obPedidos instanceof EntityPedidos){
            $request->getRouter()->redirect('/admin/pedidos');
        }

        $content = View::render('admin/modules/pedidos/formConfirm',[
            'title' => 'Confirmação Pedido',
            'ends' => self::getEnderecosCadastrados($request),
            'quantidade' => $obPedidos->qnt,
            'id' => $obPedidos->id,
            'sabor' => $obPedidos->sabor,
            'tamanho' =>$obPedidos->tamanho,
            'endereco' =>$obPedidos->endereco,
            'data' => $obPedidos->data,
            'status' => self::getStatus($request)
        ]);

        

        return parent::getPanel('Confirmar Pedido',$content,'pedidos');
    }

    public static function setEditPedidos($request,$id){
        $obPedidos = EntityPedidos::getPedidosById($id);
        if(!$obPedidos instanceof EntityPedidos){
            $request->getRouter()->redirect('/admin/pedidos');
        }
        $request->getRouter()->redirect('/admin/pedidos');
    }

    private static function getStatus($request){
        $queryParams = $request->getqueryParams();
        if(!isset($queryParams['status'])) return '';

        switch ($queryParams['status']){

            case 'created':
                return Alert::getSuccess('Pedido realizado com sucesso!');
            break;

            case 'deleted':
                return Alert::getSuccess('Pedido cancelado/excluído com sucesso!');
            break;
        }
    }

    public static function getDeletePedidos($request,$id){
        $obPedidos = EntityPedidos::getPedidosById($id);
        if(!$obPedidos instanceof EntityPedidos){
            $request->getRouter()->redirect('/admin/pedidos');
        }

        $content = View::render('admin/modules/pedidos/formDelete',[
            
            'status' => self::getStatus($request)
        ]);

        

        return parent::getPanel('Excluir Pedido',$content,'pedidos');
    }

    public static function setDeletePedidos($request,$id){
        $obPedidos = EntityPedidos::getPedidosById($id);
        if(!$obPedidos instanceof EntityPedidos){
            $request->getRouter()->redirect('/admin/pedidos');
        }

        $obPedidos->excluir();

        $request->getRouter()->redirect('/admin/pedidos?status=deleted');
    }
}