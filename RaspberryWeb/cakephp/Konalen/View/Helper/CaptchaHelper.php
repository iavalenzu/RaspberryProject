<?php

App::uses('AppHelper', 'View/Helper');
App::import('Lib', 'SecureSender');

class CaptchaHelper extends AppHelper {
    
    public $helpers = array('Html');
    
    public function image($code = false) {
        
        if(empty($code)){
            return "";
        }
        
        $KonalenPrivateKey = Configure::read('KonalenPrivateKey');
        $KonalenPublicKey = Configure::read('KonalenPublicKey');
        
        if(empty($KonalenPrivateKey) || empty($KonalenPublicKey)){
            return "";
        }
        
        $sps = new SecureSender();
        $sps->setRecipientPublicKey($KonalenPublicKey);
        $sps->setSenderPrivateKey($KonalenPrivateKey);

        return $this->Html->image(
            $this->Html->url(array(
                "controller" => "forms",
                "action" => "captcha",
                $sps->encrypt($code)
            )),
            array('fullBase' => true)    
        );                
                
    }
}

?>

