<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Pedidos{
    public $qnt;
    public $sabor;
    public $data;
    public $endereco;
    public $tamanho;

    public function cadastrar(){

      $this->data = date('Y-m-d H:i:s');

      $this->id = (new Database('pedidos')) ->insert([
        'qnt' => $this->qnt,
        'sabor' => $this->sabor,
        'data' => $this->data,
        'endereco' => $this->endereco,
        'tamanho' => $this->tamanho,
        'data' => $this->data
      ]);
      return true;
    }

    public function atualizar(){
      return (new Database('pedidos'))->update('id = '.$this->id,[
        'qnt' => $this->qnt,
        'sabor' => $this->sabor,
        'data' => $this->data,
        'endereco' => $this->endereco,
        'tamanho' => $this->tamanho,
        'data' => $this->data
      ]);
    }

    public function excluir(){
      return (new Database('pedidos'))->delete('id = '.$this->id);
    }

    public static function getPedidosById($id){
      return self::getPedidos('id = '.$id)->fetchObject(self::class);
    }

    public static function getPedidos($where = null,$order = null, $limit = null, $fields= '*'){
      return (new Database('pedidos'))->select($where,$order,$limit,$fields);
    }
}