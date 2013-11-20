<?php
App::uses('AppModel', 'Model');

class StaticContent extends StaticContentManagerAppModel {
    
    
    public static $JS = 1;
    public static $CSS = 2;
    public static $IMG = 3;
    public static $FILE = 4;
    
    
    public function manageOldScripts(){

        $session_duration = 5*60;
        $limit = 0.5;

        mt_srand();
        
        $random = mt_rand()/mt_getrandmax();
        
        if($random <= $limit)       
            return $this->deleteAll(array('StaticContent.created <=' => date('Y-m-d H:i:s', time() - $session_duration)), false);
        else
            return false;
        
    }
    
    public function createId(){
        
        //TODO Factorizar!!!
        $max_attempts = 6;

        for($i=0; $i<$max_attempts; $i++){

            $code = sha1(rand() . microtime(true));

            $this->recursive = -1;
            $script = $this->findById($code);

            if(empty($script))
                return $code;

        }

        return false;
            
    }
        
    public function createContent($filenames = null, $allowed_domain = false, $type = false, $options = array()){
        
        //Se eliminan los script que lleven algun tiempo guardados
        $this->manageOldScripts();

        if(empty($filenames) || empty($type))
            return false;

        $dataSource = $this->getDataSource();

        $dataSource->begin();

        $script['StaticContent']['id'] = $this->createId();
        $script['StaticContent']['files'] = json_encode($filenames);
        $script['StaticContent']['allowed_domain'] = $allowed_domain;
        $script['StaticContent']['type'] = $type;
        $script['StaticContent']['options'] = json_encode($options);

        if($this->save($script)){
            if($dataSource->commit())
                return $this->id;
        }else{
            $dataSource->rollback();
        }

        return false;

    }    
    
}

?>