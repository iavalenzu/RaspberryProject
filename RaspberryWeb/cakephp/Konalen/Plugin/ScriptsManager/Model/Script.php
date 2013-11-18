<?php
App::uses('AppModel', 'Model');

class Script extends ScriptsManagerAppModel {

    public function manageOldScripts(){

        $session_duration = 5*60;
        $limit = 0.5;

        mt_srand();
        
        $random = mt_rand()/mt_getrandmax();
        
        if($random <= $limit)       
            return $this->deleteAll(array('Script.created <=' => date('Y-m-d H:i:s', time() - $session_duration)), false);
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
        
    public function createScript($filenames = null){
        
        //Se eliminan los script que lleven algun tiempo guardados
        $this->manageOldScripts();

        if(empty($filenames))
            return false;

        $dataSource = $this->getDataSource();

        $dataSource->begin();

        $script['Script']['id'] = $this->createId();
        $script['Script']['data'] = json_encode($filenames);

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