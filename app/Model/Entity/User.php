<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class User{

    public $nome;
    public $email;
    public $senha;
    public $telefone;

    public static function getUserByEmail($email){
        return (new Database('usuarios'))->select('email = "'.$email.'"')->fetchObject(self::class);
    }

    public function cadastrar(){

        $this->id_user = (new Database('usuarios')) ->insert([
          'nome' => $this->nome,
          'email' => $this->email,
          'telefone' => $this->telefone,
          'senha' => $this->senha,
        ]);
        return true;
      }


}