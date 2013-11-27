<?php

App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');
App::import('Lib', 'Utilities');
App::import('Lib', 'ResponseStatus');
App::import('Lib', 'SimpleCaptcha/SimpleCaptcha');


/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property RequestHandlerComponent $RequestHandler
 * @author Ismael Valenzuela <iavalenzu@gmail.com>
 * @package Konalen.Controller
 * 
*/
class UsersController extends AppController {

        /**
         * Components
         *
         * @var array
         */
	public $components = array('Paginator', 'RequestHandler', 'StaticContentManager.Compressor');

        /**
         * Uses
         *
         * @var array
         */
        public $uses = array('PartnerForm', 'User', 'Partner', 'UserPartner', 'UserAccess');
        
        public $helpers = array('StaticContentManager.StaticContent');
        
        
        public function beforeFilter() {
            parent::beforeFilter();
        }
        
        /**
         *  
         * @param string email Corresponde al correo electronico del nuevo usuario.
         * @param string password Corresponde a la contraseña del nuevo usuario.
         * @param mixed data Corresponde a la informacion adicional del nuevo usuario.
         * 
         * @return array Retorna un arreglo con los datos del nuevo usuario creado.
         */

        public function register() {
            
            $authorizedPartner = $this->Partner->getAuthorizedPartner();
            
            //Se obtiene la data correspondiente al nuevo usuario
            $post_data = Utilities::getRawPostData(true);

            //Se obtienen los parametros
            $email = Utilities::exists($post_data, 'email', true, false);
            $password = Utilities::exists($post_data, 'password', true, false);
            $data = Utilities::exists($post_data, 'data', true, false);
            
            $response = $this->UserPartner->register($email, $password, $data, $authorizedPartner);
   
            $this->set('response', $response);
            $this->set('_serialize', array('response'));
            
        }
        
        
        public function checklogin(){
            
            $session_id = Utilities::exists($this->request->data, 'session_id', true, true, false);
            $email = Utilities::exists($this->request->data, 'email', true, true, false);
            $password = Utilities::exists($this->request->data, 'password', true, true, false);
            $captcha_response = Utilities::exists($this->request->data, 'captcha_response', false, true, false);
            
            $response = $this->UserPartner->login($email, $password, $captcha_response, $session_id);

            $this->redirect(array('action'=>'showlogin'));
            
        }

        
        private function __getLoginBoxJavascript($element_path = null, $partner_form = null){
            
            
            if(empty($partner_form) || empty($element_path)){
                return "";
            }
            
             /* Set up new view that won't enter the ClassRegistry */
            $view = new View($this, false);

            /*Se genera el id unico de las clases CSS*/
            $css_class_id = md5(microtime(true));


            /*Se obtiene el html de la caja de login y se comprime*/
            $html_box = $view->element($element_path . 'box', array('id' => $css_class_id, 'partner_form' => $partner_form));
            $html_box = $this->Compressor->compressHtml($html_box);


            /*Se obtiene el css de la caja de login y se comprime*/
            $css_box = $view->element($element_path . 'css', array('id' => $css_class_id));
            $css_box = $this->Compressor->compressCss($css_box);

            
            /*Se envia el html y el css a la vista que inserta el contenido*/
            $view->set('html', $html_box);
            $view->set('css', $css_box);


            $view_output = $view->render('loginform');
            $view_output = $this->Compressor->compressJs($view_output);
                
            return $view_output;
            
        }
        
        
        //El formulario esta contenido en otra pagina
        public function loginform(){
            
            $this->autoLayout = false;
            $this->autoRender = false;
     
            //Se obtienen la llave publica del partner
            $public_key = Utilities::exists($this->request->query, 'key', true, false);

            $public_key_decoded = base64_decode($public_key);
            
            $partner = $this->Partner->getPartnerByPublicKey($public_key_decoded);

            if($partner){

                //Se obtiene la ultima sesion activa o se crea una nueva con un identificador de session. 
                $partner_form = $this->PartnerForm->getActiveSession($partner);
                
                $js_content = $this->__getLoginBoxJavascript('login1/', $partner_form);
                
                $this->response->type('js');
                $this->response->body($js_content);
                
            }
            
            
        }
        
        public function test(){
            
            $this->autoLayout = false;
            $this->autoRender = false;
            
            
            /* Set up new view that won't enter the ClassRegistry */
            $view = new View($this, false);
            
            $headcode = "<style type='text/css'> .red { color: red; } </style>";
            $content = '<div class="red">Este es el formulario de login!!!</div>';
            
            $view->set('headcode', $headcode);
            $view->set('content', $content);

            /* Grab output into variable without the view actually outputting! */
            $view_output = $view->render('/Elements/insert_code');
            
            print_r($view_output);
            
            $this->response->type('application/x-javascript');
            
        }
        
        public function showlogin(){
            
            $this->autoLayout = false;

            
        }
        
        public function getCaptcha($session_id = null){
            
            $this->autoLayout = false;
            $this->autoRender = false;            
            
            if(empty($session_id))
                return;
            
            $captcha = new SimpleCaptcha();

            // OPTIONAL Change configuration...
            //$captcha->wordsFile = 'words/es.php';
            //$captcha->session_var = 'secretword';
            //$captcha->imageFormat = 'png';
            //$captcha->lineWidth = 3;
            //$captcha->scale = 3; $captcha->blur = true;
            //$captcha->resourcesPath = "/var/cool-php-captcha/resources";
            
            $captcha->resourcesPath = '/var/www/sandbox/cakephp/Konalen/Lib/SimpleCaptcha/resources';
            
            // Image generation
            $captcha->CreateImage();
            
            $checksum = $captcha->getSha1Captcha();
            
            if($this->PartnerForm->setCaptchaChecksum($session_id, $checksum)){
                $captcha->WriteImage();
            }
            
            $captcha->Cleanup();
            
            $this->response->type('jpg');
            
        }
        
        public function testCaptcha(){
            
            $this->autoLayout = false;
            $this->autoRender = false;
            
            $captcha = new SimpleCaptcha();

            // OPTIONAL Change configuration...
            //$captcha->wordsFile = 'words/es.php';
            //$captcha->session_var = 'secretword';
            //$captcha->imageFormat = 'png';
            //$captcha->lineWidth = 3;
            //$captcha->scale = 3; $captcha->blur = true;
            //$captcha->resourcesPath = "/var/cool-php-captcha/resources";

            // Image generation
            $captcha->CreateImage();
            
            $this->log($captcha->getSha1Captcha());

            //$this->response->type('jpg');
            
            
            
        }
        
        
        /**
         * @param string $email
         * @param string $password
         * @return array Retorna un arreglo con los datos de la nueva sesion creada.
         */
        
        public function login(){
            
            $authorizedPartner = $this->Partner->getAuthorizedPartner();

            //Se obtiene la data correspondiente al nuevo usuario
            $post_data = Utilities::getRawPostData(true);

            //Se obtienen los parametros
            $email = Utilities::exists($post_data, 'email', true, false);
            $password = Utilities::exists($post_data, 'password', true, false);
            $user_agent = Utilities::exists($post_data, 'user_agent', true, false);
            $user_ip_address = Utilities::exists($post_data, 'ip_address', true, false);
            $recaptcha_challenge_field = Utilities::exists($post_data, 'recaptcha_challenge_field', false, false);
            $recaptcha_response_field = Utilities::exists($post_data, 'recaptcha_response_field', false, false);
            
            $response = $this->UserPartner->login($email, $password, $user_agent, $user_ip_address, $authorizedPartner, $recaptcha_challenge_field, $recaptcha_response_field);
            
            $this->set('response', $response);
            $this->set('_serialize', array('response'));
            
        }
        
        public function activate(){
            
            $this->autoLayout = false;
            
            //Se obtienen los parametros
            $code = Utilities::exists($this->request->query, 'code', true, false);
            
            $response = $this->UserPartner->activate($code);
            
            if($response['msg'] == ResponseStatus::$ok){
                
                if(isset($response['data']['redirect_url'])){

                    $url = $response['data']['redirect_url'];
                    unset($response['data']['redirect_url']);
                    $url = $url . "?" . http_build_query($response);

                    $this->redirect($url);

                }
                
            }
            
        }

        
        public function setpassword(){
            
            //TODO Ver si es posible setear la password sin pasar por el partner
            
            $authorizedPartner = $this->Partner->getAuthorizedPartner();

            //Se obtiene la data correspondiente al nuevo usuario
            $post_data = Utilities::getRawPostData(true);
            
            //Se obtienen los parametros
            $code = Utilities::exists($post_data, 'code', true, false);
            $new_password = Utilities::exists($post_data, 'password', true, false);
            
            $response = $this->UserPartner->setpassword($code, $new_password);

            $this->set('response', $response);
            $this->set('_serialize', array('response'));
            
        }        
        
        
        public function renewsession(){
            
            $authorizedPartner = $this->Partner->getAuthorizedPartner();

            //Se obtiene la data correspondiente al nuevo usuario
            $post_data = Utilities::getRawPostData(true);

            //Se obtienen los parametros
            $session_id = Utilities::exists($post_data, 'session_id', true, false);
            
            $new_user_access = $this->UserAccess->checkSessionId($session_id, $authorizedPartner);
            
            if($new_user_access){
                
                $response = array(
                    'msg' => ResponseStatus::$ok,
                    'data' => array(
                        'session_id' => $new_user_access['UserAccess']['session_id'],
                        'expiration_date' => $new_user_access['UserAccess']['session_expire']
                    )
                );
                
            }else{
                
                $response = array(
                    'msg' => ResponseStatus::$session_invalid,
                    'data' => array()
                );          
                
            }
            
            $this->set('response', $response);
            $this->set('_serialize', array('response'));
            
        }
        
        
        public function setdata(){
            
            $authorizedPartner = $this->Partner->getAuthorizedPartner();

            //Se obtiene la data correspondiente al nuevo usuario
            $post_data = Utilities::getRawPostData(true);

            //Se obtienen los parametros
            $session_id = Utilities::exists($post_data, 'session_id', true, false);
            $new_data = Utilities::exists($post_data, 'data', true, false);
            
            $response = $this->UserPartner->changedata($session_id, $new_data, $authorizedPartner);
            
            $this->set('response', $response);
            $this->set('_serialize', array('response'));
            
        }
        
        public function changepassword(){
            
            $authorizedPartner = $this->Partner->getAuthorizedPartner();

            //Se obtiene la data correspondiente al nuevo usuario
            $post_data = Utilities::getRawPostData(true);

            //Se obtienen los parametros
            $session_id = Utilities::exists($post_data, 'session_id', true, false);
            $new_password = Utilities::exists($post_data, 'new_password', true, false);
            
            $response = $this->UserPartner->changepassword($session_id, $new_password, $authorizedPartner);
            
            $this->set('response', $response);
            $this->set('_serialize', array('response'));
            
            
        }
        public function resetpassword(){
            
            $authorizedPartner = $this->Partner->getAuthorizedPartner();

            //Se obtiene la data correspondiente al nuevo usuario
            $post_data = Utilities::getRawPostData(true);

            //Se obtienen los parametros
            $email = Utilities::exists($post_data, 'email', true, false);

            $response = $this->UserPartner->resetpassword($email, $authorizedPartner);
            
            $this->set('response', $response);
            $this->set('_serialize', array('response'));
            
        }
        
 }
