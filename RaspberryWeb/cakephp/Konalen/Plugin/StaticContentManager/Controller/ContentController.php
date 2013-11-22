<?php

App::uses('StaticContentManagerAppController', 'StaticContentManager.Controller');
App::import('Lib', 'StaticContentManager.Packer/JavaScriptPacker');


class ContentController extends StaticContentManagerAppController {
    
    public $uses = array('StaticContentManager.StaticContent');
    
    /**
     * 
     * Obtiene el contenido de un archivo dado por su ruta
     * 
     * @param string $filename
     * @return string
     */
    
    private function __getFileContent($filename = null){
        
        if(empty($filename))
            return "";
        
        $output = "";
        
        if(file_exists($filename)){
            $output = file_get_contents($filename); 
        }
        
        return $output;
        
    }
    
    /**
     * Obtiene el contenido de varios archivos dados y retorna la concatenacion de sus contenidos.
     * 
     * @param string $dir
     * @param array $filenames
     * @return string
     */
    
    private function __getFilesContent($dir = null, $filenames = null){
        
        if(empty($filenames) || empty($dir))
            return "";
        
        $generatedoutput = "";
        
        if(is_array($filenames)){

            foreach ($filenames as $filename) {
                $generatedoutput .= $this->__getFileContent($dir . $filename);
            }

        }else{
           $generatedoutput .= $this->__getFileContent($dir . $filenames);
        }        
        
        return $generatedoutput;
        
    }

    /**
     * Comprime y empaqueta los archivos dados y retorna el nombre del archivo temporal.
     * 
     * @param array $filenames
     * @return string
     */
    
    private function __getCompressFile($filenames = null){
        
        if(empty($filenames))
            return;
        
        # create new zip opbject
        $zip = new ZipArchive();

        # create a temp file & open it
        $tmp_file = tempnam('tmp','scm_');
        
        $zip->open($tmp_file, ZipArchive::CREATE);

        # loop through each file
        foreach($filenames as $filename){
            #add it to the zip
            $zip->addFile(FILES . $filename, $filename);
        }
        
        # close zip
        $zip->close();
        
        return $tmp_file;
        
    }

    private function __getContentDisposition($options = array()){
        
        $content_disposition = "";

        if(isset($options['download'])){
            if($options['download'])
                $content_disposition .= "attachment; ";
            else
                $content_disposition .= "inline; ";
        }else{
            $content_disposition .= "attachment; ";
        }

        if(isset($options['name']) && !empty($options['name'])){
            $content_disposition .= "filename=" . $options['name'] . ".zip";
        }else{
            $content_disposition .= "filename=" . time() . ".zip";
        }
        
        return $content_disposition;
    }
    
    public function get($id = null){
        
        $this->autoLayout = false;
        $this->autoRender = false;

        if(empty($id))
            return;

        //Se obtiene el contenido asociado con el id
        $script = $this->StaticContent->findById($id);
 
        if(empty($script))
            return;

        //Se veirfica que los deminios permitidos para ver este contenido coincidan
        if(!empty($script['StaticContent']['allowed_domain'])){
        
            $referer = parse_url($this->request->referer());
            $allowed_domain = parse_url($script['StaticContent']['allowed_domain']);

            if(empty($referer) || !isset($referer['host']) || empty($allowed_domain) || !isset($allowed_domain['host']))
                return;

            if($referer['host'] != $allowed_domain['host']){
                $this->log("El dominio de origen no esta permitido");
                return;
            }
        
        }

        //Se elimina el contenido para evitar que se vuelva a acceder a el usando el id
        //$this->StaticContent->delete($id);

        $filenames = json_decode($script['StaticContent']['files'], true);
        $options = json_decode($script['StaticContent']['options'], true);
        
        
        //De acuerdo al tipo de contenido procesamos la salida
        switch ($script['StaticContent']['type']) {
            
            case StaticContent::$CSS :

                //Se obtiene el contenido conjunto de los archivos .css
                $generatedoutput = $this->__getFilesContent(CSS, $filenames);

                // Remove comments 
                $generatedoutput = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $generatedoutput);
                // Remove tabs, spaces, newlines, etc. 
                $generatedoutput = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $generatedoutput);
                
                $this->response->type('css');
                $this->response->disableCache();
                $this->response->body($generatedoutput);
                
                break;
            
            case StaticContent::$JS :
                
                $generatedoutput = $this->__getFilesContent(JS, $filenames);
                
                if(isset($options['return_url']) && !$options['return_url']){
                
                    /*El siguiente codigo localiza el actual script y lo elimina del DOM solo funciona cuando se inserta la etiqueta, no cuando se requiere solo la url*/
                    $generatedoutput .= "(function (){";
                    $generatedoutput .= "var scripts = document.getElementsByTagName('script');";
                    $generatedoutput .= "var thiscript = scripts[ scripts.length-1 ];";
                    $generatedoutput .= "thiscript.parentElement.removeChild(thiscript);";
                    $generatedoutput .= "})();";

                }
                
                $generatedoutput = str_replace("\\\r\n", "\\n", $generatedoutput);
                $generatedoutput = str_replace("\\\n", "\\n", $generatedoutput);
                $generatedoutput = str_replace("\\\r", "\\n", $generatedoutput);
                $generatedoutput = str_replace("}\r\n", "};\r\n", $generatedoutput);
                $generatedoutput = str_replace("}\n", "};\n", $generatedoutput);
                $generatedoutput = str_replace("}\r", "};\r", $generatedoutput);

                $packer = new JavaScriptPacker($generatedoutput, 'Normal', true, false);
                $generatedoutput = $packer->pack();

                $this->response->type('javascript');
                $this->response->disableCache();
                $this->response->body($generatedoutput);                
                
                break;

            case StaticContent::$IMG :
                
                $this->response->file(IMAGES . $filenames);
                return $this->response;

                break;
            
            case StaticContent::$FILE :
                
                if(is_string($filenames)){
                    
                    $download = (isset($options['download'])) ? $options['download'] : false;
                    $name = (isset($options['name']) && !empty($options['name'])) ? $options['name'] : time();
                    
                    $this->response->file(FILES . $filenames, array('download' => $download, 'name' => $name));
                    return $this->response;
                    
                }elseif(is_array($filenames)){
                    
                    //Se crea un fichero comprimido con los archivos dados
                    $zipfilename = $this->__getCompressFile($filenames);
                    $content_disposition = $this->__getContentDisposition($options);
                    
                    $this->response->header("Content-Type", "application/zip"); 
                    $this->response->header("Content-Length", filesize($zipfilename)); 
                    $this->response->header("Content-Disposition", $content_disposition); 
                    readfile($zipfilename); 
                    unlink($zipfilename);
                    
                }

                break;
            
            default:
                break;
        }
        
    }
    
}