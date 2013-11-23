<?php

App::uses('Component', 'Controller');
App::import('Lib', 'StaticContentManager.Packer/JavaScriptPacker');


class CompressorComponent extends Component {

    public function compressCss($css_string){
        // Remove comments 
        $css_string = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css_string);
        // Remove tabs, spaces, newlines, etc. 
        $css_string = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css_string);
        
        return $css_string;    
        
    }

    public function compressJs($js_string){

        $js_string = str_replace("\\\r\n", "\\n", $js_string);
        $js_string = str_replace("\\\n", "\\n", $js_string);
        $js_string = str_replace("\\\r", "\\n", $js_string);
        $js_string = str_replace("}\r\n", "};\r\n", $js_string);
        $js_string = str_replace("}\n", "};\n", $js_string);
        $js_string = str_replace("}\r", "};\r", $js_string);

        $packer = new JavaScriptPacker($js_string, 'Normal', true, false);
        
        return $packer->pack();
        
    }
    
    
}

?>
