<?php

App::uses('ScriptsManagerAppController', 'ScriptsManager.Controller');
App::import('Lib', 'ScriptsManager.Packer/JavaScriptPacker');


class ScriptsController extends ScriptsManagerAppController {
    
    public $uses = array('ScriptsManager.Script');
    
    
    private function __getFileContent($filename = null){
        
        if(empty($filename))
            return "";
        
        $output = "";
        
        if(file_exists($filename)){

            $fh = fopen($filename,'r');
            while ($line = fgets($fh)) {
                $output .= $line;
            }
            fclose($fh);
        }
        
        return $output;
        
    }
        
    public function getScript($id = null){
        
        $this->autoLayout = false;
        $this->autoRender = false;
        
        if(empty($id))
            return;
        
        $script = $this->Script->findById($id);
 
        if(empty($script))
            return;
        
        $filenames = json_decode($script['Script']['data'], true);
        
        if(empty($filenames))
            return;
        
        $generatedoutput = "";

        if(is_array($filenames)){

            foreach ($filenames as $filename) {
                $generatedoutput .= $this->__getFileContent(JS . $filename);
            }

        }else{
           $generatedoutput .= $this->__getFileContent(JS . $filenames);
        }

        $generatedoutput = str_replace("\\\r\n", "\\n", $generatedoutput);
        $generatedoutput = str_replace("\\\n", "\\n", $generatedoutput);
        $generatedoutput = str_replace("\\\r", "\\n", $generatedoutput);
        $generatedoutput = str_replace("}\r\n", "};\r\n", $generatedoutput);
        $generatedoutput = str_replace("}\n", "};\n", $generatedoutput);
        $generatedoutput = str_replace("}\r", "};\r", $generatedoutput);
        
        $packer = new JavaScriptPacker($generatedoutput, 'Normal', true, false);
        $packed = $packer->pack();
        
        
        $this->Script->delete($id);
        
        
        echo $packed;
         
    }
    
    
    
}