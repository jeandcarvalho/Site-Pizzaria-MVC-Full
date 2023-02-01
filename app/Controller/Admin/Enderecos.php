<?php

namespace App\Controller\Admin;

USE \App\Utils\View;
USE \App\Model\Entity\Enderecos as EntityEnderecos;
use \WilliamCosta\DatabaseManager\Pagination;

class Enderecos extends Page{

    private static function getEnderecosCadastrados($request,&$obPagination){
        $cadastrados= '';

        $quantidadeTotal = EntityEnderecos::getEnderecos(null,null,null,'COUNT(*) as qtd')->fetchObject()->qtd;
        
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        $obPagination = new Pagination($quantidadeTotal,$paginaAtual,3); //configura quantos endereços aparece por página
        
        $results = EntityEnderecos::getEnderecos(null,'id_user ASC',$obPagination->getLimit());

        while($obEnderecos = $results->fetchObject(EntityEnderecos::class)){
            $cadastrados .= View::render('pages/enderecos/cadastrados',[
                'rua' => $obEnderecos->rua,
                'id_user' => $obEnderecos->id_user,
                'numero' => $obEnderecos->numero,
                'bairro' => $obEnderecos->bairro,
                'cep' => $obEnderecos->cep,
            ]);
        }
        return  $cadastrados;
    }
       
    public static function getEnderecos($request){

        $content = View::render('pages/enderecos',[
            'cadastrados' => self::getEnderecosCadastrados($request,$obPagination),
            'pagination' => parent::getPagination($request,$obPagination),
            'status' => self::getStatus($request)

        ]);
        return parent::getPanel('Seus Endereços',$content,'enderecos');
    }

    public static function insertEnderecos($request){
        $postVars = $request->getPostVars();

        $obEnderecos = new EntityEnderecos;
        $obEnderecos->cep = $postVars['cep'];
        $obEnderecos->rua = $postVars['rua'];
        $obEnderecos->numero = $postVars['numero'];
        $obEnderecos->bairro = $postVars['bairro'];
        $obEnderecos->complement = $postVars['complement'];
        $obEnderecos->cadastrar();
        return self::getEnderecos($request);
    }

    private static function getStatus($request){
        $queryParams = $request->getqueryParams();
        if(!isset($queryParams['status'])) return '';

        switch ($queryParams['status']){

            case 'created':
                return Alert::getSuccess('Endereço cadastrado com sucesso!');
            break;

            case 'deleted':
                return Alert::getSuccess('Endereço excluído com sucesso!');
            break;
        }
    }


    public static function getDeleteEnderecos($request,$id){
        $obEnderecos = EntityEnderecos::getEnderecosById($id);
        if(!$obEnderecos instanceof EntityEnderecos){
            $request->getRouter()->redirect('/admin/enderecos');
        }

        $content = View::render('admin/modules/pedidos/endDelete',[
            
            'status' => self::getStatus($request)
        ]);

        

        return parent::getPanel('Excluir Pedido',$content,'enderecos');
    }

    public static function setDeleteEnderecos($request,$id_user){
        $obEnderecos = EntityEnderecos::getEnderecosById($id_user);
        if(!$obEnderecos instanceof EntityEnderecos){
            $request->getRouter()->redirect('/admin/enderecos');
        }

        $obEnderecos->excluir();

        $request->getRouter()->redirect('/admin/enderecos?status=deleted');
    }

}
