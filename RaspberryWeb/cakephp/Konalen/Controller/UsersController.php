<?php

App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');
App::import('Lib', 'Utilities');
App::import('Lib', 'ResponseStatus');


/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property RequestHandlerComponent $RequestHandler
 * @author Ismael Valenzuela <iavalenzu@gmail.com>
 */
class UsersController extends AppController {

        /**
         * Components
         *
         * @var array
         */
	public $components = array('Paginator', 'RequestHandler');

        /**
         * Uses
         *
         * @var array
         */
        public $uses = array('User', 'Partner', 'UserPartner', 'UserAccess');
        
        public function beforeFilter() {
            parent::beforeFilter();
        }
        
        /**
         *  
         * @param String email Corresponde al correo electronico del nuevo usuario.
         * @param String password Corresponde a la contraseña del nuevo usuario.
         * @param Array data Corresponde a la informacion adicional del nuevo usuario.
         * 
         * @return Array Retorna un arreglo con los datos del nuevo usuario creado
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
        
        /**
         * @param string $email
         * @param string $password
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
