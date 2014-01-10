<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Packet{
    
    var $data = null;
    var $id = null;
    var $created = null;
    
    function __construct($data = null, $id = null) {
        
        //Definimos la data del paquete
        $this->data = $data;
        //Identificador del paquete
        $this->id = (empty($id)) ? sha1(mt_rand()) : $id;
        //Fecha de creacion del paquete
        $this->created = time();
        
    }    
    
    public function __wakeup(){}    
    
    public function reset(){
        $this->data = null;
        $this->id = null;
        $this->created = null;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setData($data = null){
        $this->data = $data;
    }

    public function getData(){
        return $this->data;
    }
    
    public function isData($data = null){
        return strcasecmp($this->data, $data) === 0;
    }
    
    public function isEmpty(){
        return empty($this->data);
    }
        
}

/**
 * Description of SecurePacket
 *
 * @author ivalenzu
 */
class TimeOutPacket extends Packet {
    
    var $expires = null;
    
    function __construct($data = null, $timeout = 60, $id = null) {
        
        parent::__construct($data, $id);
        
        $this->expires = (empty($timeout)) ? $this->created : $this->created + $timeout;
        
    }    
    
    public function __wakeup(){
        
        if($this->isExpired()){
            $this->reset();
        }
    }    
    
    public function reset(){
        parent::reset();
        $this->expires = null;      
    }
    
    private function isExpired(){
        return $this->expires < time();
    }
    
}



class OneUsePacket extends Packet {
    
    var $checkUrl = null;

    function __construct($data = null, $id = null, $check_url = null) {

        parent::__construct($data, $id);
        $this->checkUrl = $check_url;
        
    }   
    
    public function reset(){
        parent::reset();
        $this->checkUrl = null;
    }    
    
    public function __wakeup(){
        
        parent::__wakeup();
        
        if(!$this->canUse()){
            $this->reset();
        }
    }     
    
    
    public function canUse(){
        
        if(empty($this->checkUrl) || empty($this->id)){
            return false;
        }
        
        $url = parse_url($this->checkUrl);
        
        if(empty($url)){
            return false;
        }        
        
        $host  = $url['host'];
        $path  = $url['path'];        
        
        if(empty($host) || empty($path)){
            return false;
        }          

        $fp = @fsockopen($host, 80);

        if(empty($fp)){
            return false;
        }
        
        
        $vars = array(
            'id' => $this->id
        );
        
        $content = http_build_query($vars);

        fwrite($fp, "POST {$path} HTTP/1.1\r\n");
        fwrite($fp, "Host: {$host}\r\n");
        fwrite($fp, "Content-Type: application/x-www-form-urlencoded\r\n");
        fwrite($fp, "Content-Length: " . strlen($content) . "\r\n");
        fwrite($fp, "Connection: close\r\n");
        fwrite($fp, "\r\n");

        fwrite($fp, $content);

        $out = '';
        
        while (!@feof($fp)) {
            $out .= @fgets($fp, 1024);
        }
        
        $response = @preg_split("/\r\n\r\n/", $out);
        
        if(empty($response)){
            return false;
        }
                
        $body = $response[1];
        
        $body_decoded = @json_decode($body, true);
        
        if(empty($body_decoded)){
            return false;
        }
        
        if(!isset($body_decoded['valid'])){
            return false;
        }
        
        return $body_decoded['valid'];
        
    }
    
}



class LoginPacket extends Packet {
    
    var $transactionId = null;
    
    function __construct($user = null, $transaction_id = null, $id = null) {
        parent::__construct($user, $id);
        $this->transactionId = $transaction_id;
        
    }     
    
    public function getUser(){
        return parent::getData();
    }


    public function reset(){
        parent::reset();
        $this->transactionId = null;
    }        
    
    public function __wakeup(){
        parent::__wakeup();
        
        if(!isset($_SESSION['TransactionId']) || $_SESSION['TransactionId'] !== $this->transactionId){
            $this->reset();
        }else{
            unset($_SESSION['TransactionId']);
        }

    }
    
    
}

class HelloPacket extends TimeOutPacket {

    public static $DATA = 'HELLO';
    
    function __construct() {
        parent::__construct(HelloPacket::$DATA, 10);
    }   
    
}