<?php

App::import('Model', 'ScriptsManager.Script');
App::uses('AppHelper', 'View/Helper');


class ScriptHelper extends AppHelper {
    
    public $helpers = array('Html');

    public function css(){
        
        echo time();
        
    }
    
    
    
     public function js($filenames = null, $returnurl = false){
         
         if(empty($filenames))
             return "";

         $ScriptModel = new Script(); 
         $new_script_id = $ScriptModel->createScript($filenames);

         if(empty($new_script_id))
             return "";
         
         $url = $this->Html->url(array(
            "plugin" => "scripts_manager",
            "controller" => "scripts",
            "action" => "getScript",
            $new_script_id
         ), true);
         
         echo ($returnurl) ? $url : $this->Html->script($url);
         
     }
    
    
}

?>

