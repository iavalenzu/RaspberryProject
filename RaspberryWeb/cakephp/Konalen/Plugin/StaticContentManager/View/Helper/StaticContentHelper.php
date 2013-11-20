<?php

App::import('Model', 'StaticContentManager.StaticContent');
App::uses('AppHelper', 'View/Helper');


class StaticContentHelper extends AppHelper {
    
    public $helpers = array('Html');

    
     public function css($filenames = null, $allowed_domain = false, $returnurl = false, $options = array()){
         
         if(empty($filenames))
             return "";

         $StaticContent = new StaticContent(); 
         $new_script_id = $StaticContent->createContent($filenames, $allowed_domain, StaticContent::$CSS);

         if(empty($new_script_id))
             return "";
         
         $url = $this->Html->url(array(
            "plugin" => "static_content_manager",
            "controller" => "Content",
            "action" => "get",
            $new_script_id
         ), true);
         
         echo ($returnurl) ? $url : $this->Html->css($url, $options);
         
     }
    
     public function image($filename = null, $allowed_domain = false, $returnurl = false, $options = array()){
         
         if(!is_string($filename))
             return "";

         $StaticContent = new StaticContent(); 
         $new_content_id = $StaticContent->createContent($filename, $allowed_domain, StaticContent::$IMG);

         if(empty($new_content_id))
             return "";
         
         $url = $this->Html->url(array(
            "plugin" => "static_content_manager",
            "controller" => "Content",
            "action" => "get",
            $new_content_id
         ), true);
         
         echo ($returnurl) ? $url : $this->Html->image($url, $options);
         
     }
    
     
     public function file($filenames = null, $allowed_domain = false, $returnurl = false, $options = array()){
         
         if(empty($filenames))
             return "";

         $StaticContent = new StaticContent(); 
         $new_script_id = $StaticContent->createContent($filenames, $allowed_domain, StaticContent::$FILE, $options);

         if(empty($new_script_id))
             return "";
         
         $url = $this->Html->url(array(
            "plugin" => "static_content_manager",
            "controller" => "Content",
            "action" => "get",
            $new_script_id
         ), true);
         
         $title = isset($options['title_link']) ? $options['title_link'] : "";
         
         unset($options['name']);
         unset($options['title_link']);
         unset($options['download']);
         
         echo ($returnurl) ? $url : $this->Html->link($title, $url, $options);
         
     }
     
    
     public function js($filenames = null, $allowed_domain = false, $returnurl = false, $options = array()){
         
         if(empty($filenames))
             return "";

         $StaticContent = new StaticContent(); 
         $new_script_id = $StaticContent->createContent($filenames, $allowed_domain, StaticContent::$JS);

         if(empty($new_script_id))
             return "";
         
         $url = $this->Html->url(array(
            "plugin" => "static_content_manager",
            "controller" => "Content",
            "action" => "get",
            $new_script_id
         ), true);
         
         echo ($returnurl) ? $url : $this->Html->script($url, $options);
         
     }
    
    
}

?>

