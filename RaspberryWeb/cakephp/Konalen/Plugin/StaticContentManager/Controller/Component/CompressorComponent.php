<?php

App::uses('Component', 'Controller');
App::import('Lib', 'StaticContentManager.Packer/JavaScriptPacker');


class CompressorComponent extends Component {
    
    
    public function compressHtml($html_string = null){
                 
        if(empty($html_string)){
            return "";
        }
        
        /*Elimina los comentarios*/
        $html_string = preg_replace('/<!--(.*)-->/Uis', '', $html_string);

        /*Reemplaza las comillas simples por dobles*/
        $html_string = preg_replace("/'/", '"', $html_string);
        
        /*Elimina todos los caracteres 'espacio' por un espacio en blanco*/
        $html_string = preg_replace("/\s+/", " ", $html_string);
    
        return $html_string;
        
    }

    public function compressCss($css_string = null){
        
        if(empty($css_string)){
            return "";
        }
        
        // Remove comments 
        $css_string = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css_string);
        
        // Remove tabs, spaces, newlines, etc. 
        //$css_string = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css_string);
        
        /*Reemplaza las comillas simples por dobles*/
        $css_string = preg_replace("/'/", '"', $css_string);
        
        /*Elimina todos los caracteres 'espacio' por un espacio en blanco*/
        $css_string = preg_replace("/\s+/", " ", $css_string);
    
        return $css_string;    
        
    }

    public function compressJs($js_string = null){

        if(empty($js_string)){
            return "";
        }

        $js_string = str_replace("\\\r\n", "\\n", $js_string);
        $js_string = str_replace("\\\n", "\\n", $js_string);
        $js_string = str_replace("\\\r", "\\n", $js_string);
        $js_string = str_replace("}\r\n", "};\r\n", $js_string);
        $js_string = str_replace("}\n", "};\n", $js_string);
        $js_string = str_replace("}\r", "};\r", $js_string);

        $packer = new JavaScriptPacker($js_string, 'Normal', true, false);
        
        return $packer->pack();
        
    }
    
    /**
     * Comprime y empaqueta los archivos dados y retorna el nombre del archivo temporal.
     * 
     * @param array $filenames
     * @return string
     */
    
    public function compressFiles($filenames = null){
        
        if(empty($filenames))
            return "";
        
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
    
    
}

?>
