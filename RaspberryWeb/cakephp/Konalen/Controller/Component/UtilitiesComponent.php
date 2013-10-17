<?php

App::uses('Component', 'Controller');

class UtilitiesComponent extends Component {
    
    public function initialize(&$controller, $settings = array()) {
        $this->controller = $controller;
    }    
    
    
    public function getHeader($name = null, $require = true, $error_msg = 'Missing Parameters'){
        
        $headers = apache_request_headers();
        
        if(isset($headers[$name]))
            return $headers[$name];

        if($require)
            throw new Exception(__($error_msg));
        
        return null;
        
    }
    
    public function getRawPost($require = true, $error_msg = 'Missing Parameters') {
        
        if(isset($HTTP_RAW_POST_DATA))
            return $HTTP_RAW_POST_DATA;
        
        $raw_data = file_get_contents('php://input');
        
        //TODO Verificar el content type y parsear la info
        
        if($raw_data)
            return $raw_data;
        
        if($require)
            throw new Exception(__($error_msg));
        
        return null;
        
    }
    
    public function getParam($name = null, $type = 'POST', $require = true, $error_msg = 'Missing Parameters'){

        if(is_null($name))
            return null;
        
        switch ($type) {
            
            case 'GET':
                if(isset($this->controller->request->query[$name]))
                    return $this->controller->request->query[$name];
                break;
                
            case 'POST':
                if(isset($this->controller->request->data[$name]))
                    return $this->controller->request->data[$name];
                break;

            default:
                break;
        }
        
        if($require)
            throw new Exception(__($error_msg));

        return null;
    }
    
    /*Agrega un checksum al codigo generado para luego poder comparar la integridad del codigo y identificar si se envian codigos incorrectos*/
    
    public function createCode($min = 50, $max = 70) {
        
        $length = mt_rand($min, $max);
        
        $characters = '0123456789abc' . 'efghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, strlen($characters)-1)];
        }
        
        $crc = crc32($randomString);
        $crc = base_convert($crc, 10, 26);
        
        return $randomString . 'd' . $crc;
        
    }

    public function checkCode($code) {

        //Buscamos la primera aparicion de la letra 'd'
        $randomString = strstr($code, 'd', true);
        
        $crc = crc32($randomString);
        $crc = base_convert($crc, 10, 26);
        $randomString = $randomString . 'd' . $crc;
        
        return strcmp($code, $randomString) == 0;
        
    }
    
    
}

?>
