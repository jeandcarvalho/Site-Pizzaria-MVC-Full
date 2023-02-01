<?php

namespace App\Http;

class Response{

    private $httpCode = 200; //código do status HTTP

    private $headers = [];

    private $contentType = 'text/html';

    private $content;

    public function __construct($httpCode,$content,$contentType = 'text/html'){
        $this->$httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    public function setContentType($contentType){
        $this->contentType = $contentType;
        $this->addHeader('Conten-Type',$contentType);
    }

    public function addHeader($key,$value){
        $this->headers[$key] = $value;
    }

    private function sendHeaders(){
        http_response_code($this->httpCode);
        foreach($this->headers as $key=>$value){
            header($key.': '.$value);
        }

    }

    public function sendResponse(){
        $this->sendHeaders(); //envia o cabeçalho

        switch($this->contentType){ //mostra o conteúdo
            case 'text/html':
                echo $this->content;
                exit;
        }
    }

}