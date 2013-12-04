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
    
    function __construct() {
        
        $now = time();
        
        $this->created = $now;
        //Por defecto la duracion es de una hora
        $this->expires = $now + 60*60;
        
    }    
    
    public function __wakeup(){
        
        if($this->isExpired()){
            $this->data = null;
        }
    }    
    
    private function isExpired(){
        return $this->expires < time();
    }
    
    public function setExpires($duration = null){
        $this->expires = time() + $duration;
    }

    public function setAuthor($author){
        $this->author = $author;
    }

    public function setData($data = null){
        $this->data = serialize($data);
    }
    
    public function getData(){
        return unserialize($this->data);
    }

    
}
