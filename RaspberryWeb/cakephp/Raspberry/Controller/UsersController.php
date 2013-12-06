<?php
App::uses('AppController', 'Controller');
App::import('Lib', 'SecureSender');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

    public function doCurlRequest($url, $data = array(), $headers = array(), $post = true){
        
        if(!is_array($data)) return array();
        
        if($data)
            $data = http_build_query($data);
        
        $options = array (
            CURLOPT_RETURNTRANSFER => true, // return web page
            CURLOPT_HEADER => false, // don't return headers
            CURLOPT_FOLLOWLOCATION => true, // follow redirects
            CURLOPT_ENCODING => "", // handle compressed
            CURLOPT_USERAGENT => "", // who am i
            CURLOPT_AUTOREFERER => true, // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120, // timeout on connect
            CURLOPT_TIMEOUT => 120, // timeout on response
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POST => $post
        );      

        $ch = curl_init ( $url );
        curl_setopt_array ( $ch, $options );
        $content = curl_exec ( $ch );
        $errno = curl_errno ( $ch );
        $error = curl_error ( $ch );
        $info = curl_getinfo ( $ch );
        
        return array(
            'errno' => $errno,
            'error' => $error,
            'info' => $info,
            'content' => $content
        );
        
        
    }    
    
    
    public function register(){
        
//        $register_url = Configure::read('KonalenRegisterUrl');
        
        
        $MyPrivateKey = Configure::read('MyPrivateKey');
        $KonalenPublicKey = Configure::read('KonalenPublicKey');
   
        
        $sps = new SecureSender();
        $sps->setRecipientPublicKey($KonalenPublicKey);
        $sps->setSenderPrivateKey($MyPrivateKey);
        
        $headers = array(
            'Authorization: Raspberry ' . $sps->encrypt('AUTHENTICATE') . ' '
        );
        
        debug($headers);
        
        $response = $this->doCurlRequest("http://konalen.dev/api/register", array(), $headers, false);

        print_r($response);
        
        
    }
    
    
}


?>