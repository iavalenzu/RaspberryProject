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
                'msg' => ResponseStatus::$user_registered,
                'data' => array(
                    'id' => $new_user_partner['User']['public_id'],
                    'email' => $new_user_partner['User']['email'],
                    'created' => $new_user_partner['UserPartner']['created']
                )
            );
            
        }        
        
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
        
        
        public function login($email, $password, $user_agent, $user_ip_address, $partner, $recaptcha_challenge_field, $recaptcha_response_field){
            
            $user = $this->User->findByEmail($email);
            
            if(empty($user)){
                return array(
                    'msg' => ResponseStatus::$login_error,
                    'data' => array()
                );                
            }

            $user_partner = $this->getByUserAndPartner($user, $partner);

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
            
            //Se agrega un acceso exitoso
            $user_access = $this->UserAccess->createAccess($user_partner, $user_agent, $user_ip_address);
            
            if(!$user_access)
                throw new InternalErrorException(ResponseStatus::$server_error);

            debug($user_access);
            
            return array(
                'msg' => ResponseStatus::$login_success,
                'data' => array(
                    'session_id' => $user_access['UserAccess']['session_id'],
                    'id' => $user_partner['User']['public_id'],
                    'email' => $user_partner['User']['email'],
                    'created' => $user_partner['UserPartner']['created']
                )
            );            
            
        }        
        
        public function activate($code){
            
            
            //Si el codigo es incorrecto seguimos la IP
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
                'data' => array(
                    'session_id' => $new_user_access['UserAccess']['session_id'],
                    'id' => $user_partner['User']['public_id'],
                    'email' => $user_partner['User']['email'],
                    'created' => $user_partner['UserPartner']['created'],
                )
            );               
            
        }
        
        public function beforeSave($options = array()) {
            
            if(isset($this->data['UserPartner']['user_data'])){
                $this->data['UserPartner']['user_data'] = json_encode($this->data['UserPartner']['user_data']);
            }
            
            return true;
        }
        
        public function afterFind($results, $primary = false) {
            
            foreach ($results as $key => $val) {
                if (isset($val['UserPartner']['user_data'])) {
                    $results[$key]['UserPartner']['user_data'] = json_decode($val['UserPartner']['user_data'], true);
                }
            }
            return $results;
        }        
        
}
