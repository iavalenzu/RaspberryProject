<?php
App::uses('AppController', 'Controller');
App::import('Lib', 'Packet');
App::import('Lib', 'SecureSender');
App::import('Lib', 'SecureReceiver');


function hash_array($data = array()) {

    $imploded_data = implode(',', $data);

    return sha1($imploded_data);
}

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

     public $components = array('Session');
    
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
    

    public function login_success(){
        
        session_start();
        
        $this->autoLayout = false;
        $this->autoRender = false;
        
        debug($_SERVER);
        
        $data = $this->request->query['data'];
        
        
        //Se crea un recibidor seguro de mensaje y desencriptamos el saludo con la llave publica del partner
        $spr = new SecureReceiver();
        $spr->setSenderPublicKey(Configure::read('KonalenPublicKey'));
        $spr->setRecipientPrivateKey(Configure::read('MyPrivateKey'));

        //Desencriptamos el mensaje
        $login = $spr->decrypt($data);  
        
        debug($login);
        
        if(isset($login['transaction_id'])){
            
            $transaction_id = $login['transaction_id'];
            
            if(isset($_SESSION['TransactionId']) && $_SESSION['TransactionId'] === $transaction_id){

                unset($_SESSION['TransactionId']);
                
                if(isset($login['user'])){
                    debug($login['user']);
                }else{
                    $this->redirect(array('action'=>'login'));
                }
                    
            }else{
                throw new UnauthorizedException();
            }           
            
        }else{
            throw new UnauthorizedException();
        }
        
    }
    
    public function login(){

        session_start();

        $MyPrivateKey = Configure::read('MyPrivateKey');
        $KonalenPublicKey = Configure::read('KonalenPublicKey');
        
        $sps = new SecureSender();
        $sps->setRecipientPublicKey($KonalenPublicKey);
        $sps->setSenderPrivateKey($MyPrivateKey);

        $service_id = 2;
        $form_id = isset($_GET['FormId']) ? $_GET['FormId'] : '';
        $transaction_id = 'trx_' . hash('sha256', microtime(true));
        
        $_SESSION['TransactionId'] = $transaction_id;
        
        $checksum_key = hash('sha256', microtime(true) . mt_rand());
        
        $data = array(
            'FormId' => $form_id,
            'ServiceId' => $service_id,
            'TransactionId' => $transaction_id,
            
            'CheckSum' => hash_hmac('sha256', implode('.', array($form_id, $service_id, $transaction_id)), $checksum_key),
            'CheckSumKey' => $sps->encrypt($checksum_key)
        );
     
        $this->set('get', $data);
        
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