<?php
App::uses('AppModel', 'Model');
App::import('Lib', 'ResponseStatus');
App::import('Model', 'IpAddressAccessAttempt');
App::import('Model', 'PartnerForm');



/**
 * UserPartner Model
 *
 * @package       Konalen.Model
 * @property User $User
 * @property Partner $Partner
 * @property UserAccess $UserAccess
 * @author Ismael Valenzuela <iavalenzu@gmail.com>
 * 
 */
class UserPartner extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_password' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxlength' => array(
				'rule' => array('maxlength', 50),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Partner' => array(
			'className' => 'Partner',
			'foreignKey' => 'partner_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
/**
 * HasMany Associations
 * 
 * @var array 
 */        
        public $hasMany = array(
		'UserAccess' => array(
			'className' => 'UserAccess',
			'foreignKey' => 'user_partner_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);        

        public function __construct($id = false, $table = null, $ds = null) {

            $this->IpAddressAccessAttempt = new IpAddressAccessAttempt();
            $this->PartnerForm = new PartnerForm();
            parent::__construct($id, $table, $ds);
            
        }          
        
        /**
         * 
         * Retorna el UserPartner asociado al User y Partner entregado.
         * 
         * @param User $user
         * @param Partner $partner
         * @return UserPartner
         */
        
        public function getByUserAndPartner($user = null, $partner = null){
            
            if(empty($user) || empty($partner))
                return false;
            
             //Se debe verificar si esta asociado al partner 
            $user_partner = $this->find('first', array(
                'conditions' => array(
                    'UserPartner.user_id' => $user['User']['id'],
                    'UserPartner.partner_id' => $partner['Partner']['id']
                )
            ));   
            
            return $user_partner;
            
        }
        
        /**
         * 
         * @param User $user
         * @param Partner $partner
         * @param string $password
         * @param mixed $data
         * @return UserPartner
         * @throws InternalErrorException
         */
        
        public function createUserPartner($user = null, $partner = null, $password = null, $data = null){
            
            if(empty($user) || empty($partner) || empty($password) || empty($data))
                return false;
            
            //Iniciamos la transaccion
            $dataSource = $this->getDataSource();
            $dataSource->begin();
            
            $activation_code = $this->createActivationCode(); 
            
            $user_partner = array(
                'UserPartner' => array(
                    'user_id' => $user['User']['id'],
                    'partner_id' => $partner['Partner']['id'],
                    'user_password' => Security::hash($password, null, true),
                    'active' => 0,
                    'activation_code' => $activation_code,
                    'user_data' => $data
                )
            );
            
            if($activation_code && $this->save($user_partner)){
                if($dataSource->commit())
                    return $this->findById($this->id);
            }else{
                $dataSource->rollback();
            }                 
            
            throw new InternalErrorException(ResponseStatus::$server_error);
            
        }
        
        /**
         * Genera un nuevo codigo de reseteo de contraseña.
         * 
         * 
         * @param UserPartner $user_partner
         * @return UserPartner
         * @throws InternalErrorException
         */
        
        public function setResetPasswordCode($user_partner = null){
            
            if(empty($user_partner))
                return false;
            
            //Iniciamos la transaccion
            $dataSource = $this->getDataSource();
            $dataSource->begin();
            
            $reset_password_code = $this->createResetPasswordCode(); 
            
            $user_partner['UserPartner']['reset_password_code'] = $reset_password_code; 
            
            if($reset_password_code && $this->save($user_partner)){
                if($dataSource->commit())
                    return $this->findById($this->id);
            }else{
                $dataSource->rollback();
            }                 
            
            throw new InternalErrorException(ResponseStatus::$server_error);
            
        }
        
        /**
         * 
         * @param string $email
         * @param string $password
         * @param mixed $data
         * @param Partner $partner
         * @return array Corresponde a la respuesta que será enviada al partner que realizó la peticion.
         * @throws InternalErrorException
         */
        
        public function register($email, $password, $data, $partner){
            
            $user = $this->User->findByEmail($email);
            
            if(empty($user)){
                $user = $this->User->createUser($email);
            }
            
            $user_partner = $this->getByUserAndPartner($user, $partner);
            
            if($user_partner){
                //El usuario ya esta asociado a este partner
                return array(
                    'msg' => ResponseStatus::$user_already_registered,
                    'data' => array()
                );
            }    
            
            //No esta asociado luego lo creamos
            $new_user_partner = $this->createUserPartner($user, $partner, $password, $data);
    
            if(!$this->User->sendActivationCode($new_user_partner)){
                throw new InternalErrorException(ResponseStatus::$server_error);
            }
            
            return array(
                'msg' => ResponseStatus::$ok,
                'data' => array(
                    'id' => $new_user_partner['User']['public_id'],
                    'email' => $new_user_partner['User']['email'],
                    'created' => $new_user_partner['UserPartner']['created'],
                    'data' => $new_user_partner['UserPartner']['user_data']
                )
            );
            
        }        

        /**
         * Genera un nuevo codigo de activacion unico.
         * 
         * @return string|boolean En caso de error retorna false.
         */
        
        public function createActivationCode(){
            
            $max_attempts = Configure::read('AuthenticationCodeGenerationAttempts');
            
            for($i=0; $i<$max_attempts; $i++){
                
                $code = Utilities::createCode();
                
                $user = $this->findByActivationCode($code);
                
                if(empty($user))
                    return $code;
                
            }

            return false;
        }

        /**
         * Genera una nuevo codigo unico de reseteo de contraseña.
         * 
         * @return string|false
         */
        
        public function createResetPasswordCode(){
            
            $max_attempts = Configure::read('ResetPasswordCodeGenerationAttempts');
            
            for($i=0; $i<$max_attempts; $i++){
                
                $code = Utilities::createCode();
                
                $user = $this->findByResetPasswordCode($code);
                
                if(empty($user))
                    return $code;
                
            }

            return false;
        }        
        
        /**
         * 
         * @param string $email
         * @param string $password
         * @param string $user_agent
         * @param string $user_ip_address
         * @param Partner $partner
         * @param string $recaptcha_challenge_field
         * @param string $recaptcha_response_field
         * @return array Corresponde a la respuesta que será enviada al partner que realizó la peticion.
         * @throws InternalErrorException
         */
        
        public function login($email = false, $password = false, $recaptcha_response = false, $session_id = false){

            
            $partner_form = $this->PartnerForm->getSession($session_id);

            //Se verifica si la sesion es valida
            if(empty($partner_form)){
                
                $data_form = array(
                    'error' => 'La session no es valida',
                    'fields' => array()
                );
                
                $this->PartnerForm->setData($session_id, $data_form);
                
                return array(
                    'status' => ResponseStatus::$invalid_session,
                    'data' => array()
                );
            }

            //Si el correo electronico es vacion retornamos un error
            if(empty($email)){

                $data_form = array(
                    'error' => 'Ingresa tu dirección de correo electrónico.',
                    'fields' => array(
                        'email' => array(
                            'error' => 'Ingresa tu dirección de correo electrónico.'
                        )
                    )
                );
                
                $this->PartnerForm->setData($session_id, $data_form);
                
                return array(
                    'status' => ResponseStatus::$error,
                    'data' => array()
                );
                
            }

            $user = $this->User->findByEmail($email);
            
            if(empty($user)){
                
                $data_form = array(
                    'error' => 'El nombre de usuario o la contraseña que ingresaste es incorrecto.',
                    'fields' => array(
                        'email' => array(
                            'value' => $email
                        )
                    )                
                );
                
                $this->PartnerForm->setData($session_id, $data_form);
                
                return array(
                    'status' => ResponseStatus::$error,
                    'data' => array()
                );                
            }

            $user_partner = $this->getByUserAndPartner($user, $partner_form);

            if(empty($user_partner)){

                $data_form = array(
                    'error' => 'El nombre de usuario o la contraseña que ingresaste es incorrecto.',
                    'fields' => array(
                        'email' => array(
                            'value' => $email
                        )
                    )
                );
                
                $this->PartnerForm->setData($session_id, $data_form);
                
                return array(
                    'status' => ResponseStatus::$error,
                    'data' => array()
                );
            }

            
            if(!$user_partner['UserPartner']['active']){
                
                $data_form = array(
                    'error' => 'El usuario se encuentra inactivo.',
                    'fields' => array(
                        'email' => array(
                            'value' => $email
                        )
                    )
                );
                
                $this->PartnerForm->setData($session_id, $data_form);
                
                return array(
                    'status' => ResponseStatus::$user_inactive,
                    'data' => array()
                );                
            }

            
            //Si el numero de intentos de acceso se supera se envia un captcha
            if( $user_partner['UserPartner']['login_attempts'] >= Configure::read('UserMaxLoginAttempts')){
                
                if(empty($recaptcha_response)){
                    
                    $data_form = array(
                        'captcha' => true,
                        'fields' => array(
                            'email' => array(
                                'value' => $email
                            )

                        )
                    );

                    $this->PartnerForm->setData($session_id, $data_form);

                    return array(
                        'status' => ResponseStatus::$error,
                        'data' => array()
                    );
                    
                }
                
                //Si vienen definidos los campos de captcha, chequeamos que coincida el checksum
                if(sha1($recaptcha_response) == $partner_form['PartnerForm']['captcha_checksum']){

                    //Dado que el codigo es correcto se resetean los intentos de login    
                    $user_partner['UserPartner']['login_attempts'] = 0;

                    $this->save($user_partner);

                }else{   

                    $data_form = array(
                        'captcha' => true,
                        'error' => 'El codigo ingresado es incorrecto.',
                        'fields' => array(
                            'captcha' => array(
                                'error' => 'El codigo ingresado es incorrecto.'
                            ),
                            'email' => array(
                                'value' => $email
                            )

                        )
                    );

                    $this->PartnerForm->setData($session_id, $data_form);

                    return array(
                        'status' => ResponseStatus::$error,
                        'data' => array()
                    );

                }
                
            }

            //Se verifica si la contraseña es vacia
            if(empty($password)){

                $data_form = array(
                    'error' => 'Ingresa tu contraseña.',
                    'fields' => array(
                        'email' => array(
                            'value' => $email
                        )
                    )
                );
                
                $this->PartnerForm->setData($session_id, $data_form);
                
                return array(
                    'status' => ResponseStatus::$error,
                    'data' => array()
                );
                
            }
            
            
            
            if( $user_partner['UserPartner']['user_password'] != Security::hash($password, null, true)){

                //Guardamos un intento de acceso
                $user_partner['UserPartner']['login_attempts']++;
                
                $this->save($user_partner);
                
                $data_form = array(
                    'error' => 'El nombre de usuario o la contraseña que ingresaste es incorrecto.',
                    'fields' => array(
                        'email' => array(
                            'value' => $email
                        )
                    )
                );
                
                $this->PartnerForm->setData($session_id, $data_form);
                
                return array(
                    'status' => ResponseStatus::$error,
                    'data' => array()
                );            
                
            }
            
            //Se agrega un acceso exitoso
            $user_access = $this->UserAccess->createAccess($user_partner);
            
            return array(
                'status' => ResponseStatus::$ok,
                'data' => array(
                    'session_id' => $user_access['UserAccess']['session_id'],
                    'id' => $user_partner['User']['public_id'],
                    'email' => $user_partner['User']['email'],
                    'created' => $user_partner['UserPartner']['created'],
                    'data' => $user_partner['UserPartner']['user_data']
                )
            );            
            
        }        

        /**
         * 
         * @param string $session_id
         * @param mixed $data
         * @param Partner $partner
         * @return array Corresponde a la respuesta que será enviada al partner que realizó la peticion.
         * @throws InternalErrorException
         */
        
        public function changedata($session_id = null, $data = null, $partner = null){

            $new_user_access = $this->UserAccess->checkSessionId($session_id, $partner);
            
            if(empty($new_user_access)){
                return array(
                    'msg' => ResponseStatus::$session_invalid,
                    'data' => array()
                );                
            }
            
            $user_partner = $this->findById($new_user_access['UserAccess']['user_partner_id']);
            
            if(empty($user_partner)){
                return array(
                    'msg' => ResponseStatus::$error,
                    'data' => array()
                );
            }
            
            $user_partner['UserPartner']['user_data'] = $data;

            if(!$this->save($user_partner)){
                throw new InternalErrorException(ResponseStatus::$server_error);
            }
            
            return array(
                'msg' => ResponseStatus::$ok,
                'data' => array(
                    'session_id' => $new_user_access['UserAccess']['session_id'],
                    'id' => $user_partner['User']['public_id'],
                    'email' => $user_partner['User']['email'],
                    'created' => $user_partner['UserPartner']['created'],
                )
            );               
            
        }

        /**
         * 
         * @param string $code
         * @return array Corresponde a la respuesta que será enviada al partner que realizó la peticion.
         * @throws InternalErrorException
         */
        
        
        public function activate($code){
            
            //TODO Si el codigo es incorrecto seguimos la IP
            $user_partner = $this->findByActivationCode($code);
 
            if(empty($user_partner)){
                return array(
                    'msg' => ResponseStatus::$error,
                    'data' => array()
                );            
            }
            
            if(!$user_partner['UserPartner']['active']){
            
                $user_partner['UserPartner']['active'] = 1;
                $user_partner['UserPartner']['activation_code'] = null;
                $user_partner['UserPartner']['activation_date'] = date('Y-m-d H:i:s');

                if(!$this->save($user_partner)){
                    throw new InternalErrorException(ResponseStatus::$server_error);
                }
            
            }
            
            return array(
                'msg' => ResponseStatus::$ok,
                'data' => array(
                    'redirect_url' => $user_partner['Partner']['activation_url']
                )
            );                    
            
        }
        
        /**
         * 
         * @param string $code
         * @param string $new_password
         * @return array Corresponde a la respuesta que será enviada al partner que realizó la peticion.
         * @throws InternalErrorException
         */
        
        public function setpassword($code, $new_password){
            
            //Si el codigo es incorrecto seguimos la IP
            $user_partner = $this->findByResetPasswordCode($code);
 
            if(empty($user_partner)){
                return array(
                    'msg' => ResponseStatus::$error,
                    'data' => array()
                );            
            }
                        
            $user_partner['UserPartner']['user_password'] = Security::hash($new_password, null, true);
            $user_partner['UserPartner']['reset_password_code'] = null;

            if(!$this->save($user_partner)){
                throw new InternalErrorException(ResponseStatus::$server_error);
            }            
            
           
            return array(
                'msg' => ResponseStatus::$ok,
                'data' => array()
            );
             
            
        }
        
        /**
         * 
         * @param string $session_id
         * @param string $new_password
         * @param Partner $partner
         * @return array Corresponde a la respuesta que será enviada al partner que realizó la peticion.
         * @throws InternalErrorException
         */
        
        public function changepassword($session_id, $new_password, $partner){
            
            $new_user_access = $this->UserAccess->checkSessionId($session_id, $partner);
            
            if(empty($new_user_access)){
                return array(
                    'msg' => ResponseStatus::$session_invalid,
                    'data' => array()
                );                
            }
            
            $user_partner = $this->findById($new_user_access['UserAccess']['user_partner_id']);
            
            if(empty($user_partner)){
                return array(
                    'msg' => ResponseStatus::$error,
                    'data' => array()
                );
            }
            
            $user_partner['UserPartner']['user_password'] = Security::hash($new_password, null, true);

            if(!$this->save($user_partner)){
                throw new InternalErrorException(ResponseStatus::$server_error);
            }
            
            return array(
                'msg' => ResponseStatus::$ok,
                'data' => array(
                    'session_id' => $new_user_access['UserAccess']['session_id'],
                    'id' => $user_partner['User']['public_id'],
                    'email' => $user_partner['User']['email'],
                    'created' => $user_partner['UserPartner']['created'],
                )
            );               
            
        }
        
        /**
         * 
         * @param string $email
         * @param Partner $partner
         * @return array Corresponde a la respuesta que será enviada al partner que realizó la peticion.
         * @throws InternalErrorException
         */
        
        public function resetpassword($email, $partner){
            
            $user = $this->User->findByEmail($email);
            
            if(empty($user)){
                return array(
                    'msg' => ResponseStatus::$error,
                    'data' => array()
                );                
            }

            $user_partner = $this->getByUserAndPartner($user, $partner);

            if(empty($user_partner)){
                return array(
                    'msg' => ResponseStatus::$error,
                    'data' => array()
                );
            }
            
            $user_partner_new_code = $this->setResetPasswordCode($user_partner);
            
            if(!$this->User->sendResetPassCode($user_partner_new_code)){
                throw new InternalErrorException(ResponseStatus::$server_error);
            }
            
            return array(
                'msg' => ResponseStatus::$ok,
                'data' => array()
            );            
            
        }
        
        /**
         * Callback Method
         * 
         * @param array $options
         * @return boolean
         */
        
        public function beforeSave($options = array()) {
            
            if(isset($this->data['UserPartner']['user_data'])){
                $this->data['UserPartner']['user_data'] = json_encode($this->data['UserPartner']['user_data']);
            }
            
            return true;
        }

        /**
         * Callback Method
         * 
         * @param mixed $results
         * @param boolean $primary
         * @return mixed
         */
        
        
        public function afterFind($results, $primary = false) {
            
            foreach ($results as $key => $val) {
                if (isset($val['UserPartner']['user_data'])) {
                    $results[$key]['UserPartner']['user_data'] = json_decode($val['UserPartner']['user_data'], true);
                }
            }
            return $results;
        }        
        
}
