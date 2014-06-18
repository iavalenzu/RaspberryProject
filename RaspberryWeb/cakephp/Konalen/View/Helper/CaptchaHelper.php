<?php

App::uses('AppHelper', 'View/Helper');

class CaptchaHelper extends AppHelper {
    
    public $helpers = array('Html');
    
    public function image($code = false) {
        
        if(empty($code)){
            return "";
        }
        
        return $this->Html->image(
            $this->Html->url(array(
                "controller" => "forms",
                "action" => "captcha"
            )),
            array('fullBase' => true)    
        );                
                
    }
}

?>

