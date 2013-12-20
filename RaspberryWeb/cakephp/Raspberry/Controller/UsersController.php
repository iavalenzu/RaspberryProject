<?php
App::uses('AppController', 'Controller');
App::import('Lib', 'SecurePacket');
App::import('Lib', 'SecureSender');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

    public function doCurlRequest($url, $get = array(), $post = array(), $headers = array()){
        

        if(!empty($post)){
            $post = http_build_query($post);
        }

        if(!empty($get)){
            $url .= "?" . http_build_query($get);
        }
        
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
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POST => empty($post) ? false : true
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
            'Authorization Raspberry ' . $sps->encrypt('HELLO') . ' '
        );
        debug($headers);

        /*
        $post = array(
            'Authorization' => 'Raspberry ' . $sps->encrypt('AUTHENTICATE') . ' '
        );
        debug($post);
        */
        
        $response = $this->doCurlRequest("http://konalen.dev/api/register", array(), $post, $headers);

        print_r($response);
        
        
    }
    

    public function login(){
        
        $MyPrivateKey = Configure::read('MyPrivateKey');
        $KonalenPublicKey = Configure::read('KonalenPublicKey');
        
        $sps = new SecureSender();
        $sps->setRecipientPublicKey($KonalenPublicKey);
        $sps->setSenderPrivateKey($MyPrivateKey);

        $hello = new HelloPacket();
        
        
        
        $get = array(
            'User' => 'Raspberry',
            'Key' => $sps->encrypt($hello) . '',
            'Service' => 2,
            'FormId' => isset($_GET['FormId']) ? $_GET['FormId'] : ''
                
        );
 
        $this->set('get', $get);
        
    }
    
    public function checklogin(){
        
        $this->autoLayout = false;
        $this->autoRender = false;
        
        
//        $register_url = Configure::read('KonalenRegisterUrl');
        
        
        $MyPrivateKey = Configure::read('MyPrivateKey');
        $KonalenPublicKey = Configure::read('KonalenPublicKey');
   
        
        $sps = new SecureSender();
        $sps->setRecipientPublicKey($KonalenPublicKey);
        $sps->setSenderPrivateKey($MyPrivateKey);
        
        $headers = array(
            'Authorization: Raspberry ' . $sps->encrypt('HELLO') . ' '
        );

        debug($headers);

        $post = array(
            'form_id' => '45875968756984769',
            'user_id' => 'iavalenzu@gmail.com',
            'user_pass' => 'awdrgyjil'
        );
        
        debug($post);
        
        $response = $this->doCurlRequest("http://konalen.dev/api/checklogin", array(), $post, $headers);

        print_r($response);
        
        
    }    
    
    
}


?>