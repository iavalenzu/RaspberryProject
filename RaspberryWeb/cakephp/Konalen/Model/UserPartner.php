<?php
App::uses('AppModel', 'Model');
App::import('Lib', 'ResponseStatus');


/**
 * UserPartner Model
 *
 * @property User $User
 * @property Partner $Partner
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
        
        public $hasMany = array(
		'UserAccess' => array(
			'className' => 'UserAccess',
			'foreignKey' => 'user_partner_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);        

        public function createAuthenticationCode(){
            
            $max_attempts = Configure::read('AuthenticationCodeGenerationAttempts');
            
            for($i=0; $i<$max_attempts; $i++){
                
                $code = Utilities::createCode();
                
                $user = $this->findByActivationCode($code);
                
                if(empty($user))
                    return $code;
                
            }

            throw new InternalErrorException(ResponseStatus::$server_error);
        }
        
        
        public function login($email, $password, $user_agent, $user_ip_address, $partner, $recaptcha_challenge_field, $recaptcha_response_field){
            
            $user = $this->User->findByEmail($email);
            
            if(empty($user)){
                return array(
                    'msg' => ResponseStatus::$login_error,
                    'data' => array()
                );                
            }

            $user_partner = $this->find('first', array(
                'conditions' => array(
                    'UserPartner.user_id' => $user['User']['id'],
                    'UserPartner.partner_id' => $partner['Partner']['id']
                )
            ));

            if(empty($user_partner)){
                return array(
                    'msg' => ResponseStatus::$login_error,
                    'data' => array()
                );
            }

            if(!$user_partner['UserPartner']['active']){
                return array(
                    'msg' => ResponseStatus::$user_inactive,
                    'data' => array()
                );                
            }

            //Si el numero de intentos de acceso se supera se envia un captcha
            if( $user_partner['UserPartner']['login_attempts'] >= Configure::read('UserMaxLoginAttempts')){
                //Si vienen definidos los campos de captcha, chequeamos

                if(Utilities::captchaIsCorrect($recaptcha_challenge_field, $recaptcha_response_field)){
                
                    //Dado que el codigo es correcto se resetean los intentos de login    
                    $user_partner['UserPartner']['login_attempts'] = 0;
                    if(!$this->save($user_partner)){
                        throw new InternalErrorException(ResponseStatus::$server_error);
                    }
                    
                }else{
                
                    return array(
                        'msg' => ResponseStatus::$max_login_attempts_exceeded,
                        'data' => array(
                            'captcha' => Utilities::getCaptchaHtml()
                        )
                    );    
                    
                }
                
            }
            
            if( strcmp($user_partner['UserPartner']['user_password'], Security::hash($password, null, true)) != 0){

                //Guardamos un intento de acceso
                $user_partner['UserPartner']['login_attempts']++;
                if(!$this->save($user_partner)){
                    throw new InternalErrorException(ResponseStatus::$server_error);
                }
                
                return array(
                    'msg' => ResponseStatus::$login_error,
                    'data' => array()
                );            
                
            }
            
            //Se crea el identificador de session
            $session_id = $this->UserAccess->createSessionId();
            
            //Se agrega un acceso exitoso
            if(!$this->UserAccess->access($user_partner, $user_agent, $user_ip_address, $session_id))
                throw new InternalErrorException(ResponseStatus::$server_error);

            
            return array(
                'msg' => ResponseStatus::$login_success,
                'session_id' => $session_id,
                'data' => array(
                    'id' => $user_partner['User']['public_id'],
                    'email' => $user_partner['User']['email'],
                    'created' => $user_partner['UserPartner']['created'],
                )
            );            
            
        }        
        
        public function activate($code){
            
            $user_partner = $this->findByActivationCode($code);
 
            if(empty($user_partner)){
                return array(
                    'msg' => ResponseStatus::$activation_error,
                    'data' => array()
                );            
            }
            
            if(!$user_partner['UserPartner']['active']){
            
                $user_partner['UserPartner']['active'] = 1;
                $user_partner['UserPartner']['activation_code'] = null;
                $user_partner['UserPartner']['activation_date'] = date('Y-m-d h:i:s');

                if(!$this->save($user_partner)){
                    throw new InternalErrorException(ResponseStatus::$server_error);
                }
            
            }
            
            return array(
                'msg' => ResponseStatus::$activation_success,
                'data' => array(
                    'redirect_url' => $user_partner['Partner']['activation_url']
                )
            );                    
            
        }
        
        public function changepassword($session_id, $new_password, $partner){
            
            $user_access = $this->UserAccess->find('first', array(
                'conditions' => array(
                    'UserAccess.session_id' => $session_id
                ),
                'order' => array('UserAccess.id DESC')
            ));
                    
            if(empty($user_access)){
                return array(
                    'msg' => ResponseStatus::$session_invalid,
                    'data' => array()
                );                
            }
            
            $session_id = $this->UserAccess->createSessionId();
            $user_access['UserAccess']['session_id'] = $session_id;

            if(!$this->UserAccess->save($user_access)){
                throw new InternalErrorException(ResponseStatus::$server_error);
            }
            
            $user_partner = $this->findById($user_access['UserAccess']['user_partner_id']);
            
            if(empty($user_partner)){
                return array(
                    'msg' => ResponseStatus::$change_pass_error,
                    'data' => array()
                );
            }
            
            $user_partner['UserPartner']['user_password'] = Security::hash($new_password, null, true);

            if(!$this->save($user_partner)){
                throw new InternalErrorException(ResponseStatus::$server_error);
            }
            
            return array(
                'msg' => ResponseStatus::$change_pass_success,
                'session_id' => $session_id,
                'data' => array(
                    'id' => $user_partner['User']['public_id'],
                    'email' => $user_partner['User']['email'],
                    'created' => $user_partner['UserPartner']['created'],
                )
            );               
            
        }
        
}
