<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Enderecos{
    public $rua;
    public $bairro;
    public $numero;
    public $complement;
    public $cep;

    public function cadastrar(){

      $this->id_user = (new Database('endereço')) ->insert([
        'rua' => $this->rua,
        'bairro' => $this->bairro,
        'numero' => $this->numero,
        'complement' => $this->complement,
        'cep' => $this->cep,   
      ]);
      return true;
    }

    public function excluir(){
      return (new Database('endereço'))->delete('id_user = '.$this->id_user);
    }

    public static function getEnderecosById($id_user){
      return self::getEnderecos('id_user = '.$id_user)->fetchObject(self::class);
    }

    public static function getEnderecos($where = null,$order = null, $limit = null, $fields= '*'){
      return (new Database('endereço'))->select($where,$order,$limit,$fields);
    }
}