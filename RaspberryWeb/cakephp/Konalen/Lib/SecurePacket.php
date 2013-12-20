<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SecurePacket
 *
 * @author ivalenzu
 */
class SecurePacket {
    
    var $data = null;
    var $expires = null;
    var $created = null;
    var $author = null;
    
    function __construct($data = null, $session_timeout = 60) {
        
        //Definimos la data del paquete
        $this->data = $data;
        //Identificador del paquete
        $this->id = sha1(mt_rand());
        //Fecha de creacion del paquete
        $this->created = time();
        //Por defecto la duracion es de una hora
        $this->expires = $this->created + $session_timeout;
        
    }    
    
    public function __wakeup(){
        
        if($this->isExpired()){
            $this->data = null;
        }
    }    
    
    private function isExpired(){
        return $this->expires < time();
    }
    
    public function setAuthor($author){
        $this->author = $author;
    }

    public function setData($data = null){
        $this->data = $data;
    }
    
    public function isData($data = null){
        return strcasecmp($this->data, $data) === 0;
    }
    
    public function isEmpty(){
        return empty($this->data);
    }
    

    
}

class HelloPacket extends SecurePacket {

    public static $DATA = 'HELLO';
    
    function __construct() {
        parent::__construct(HelloPacket::$DATA, 5);
    }   
    
}

class LoginPacket extends SecurePacket {

    function __construct($data = null) {
        parent::__construct($data, 5);
    }   
    
}


