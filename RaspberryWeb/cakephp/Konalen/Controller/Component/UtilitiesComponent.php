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
    
    
}

?>
