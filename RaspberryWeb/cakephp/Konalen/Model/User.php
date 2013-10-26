<?php
App::uses('AppModel', 'Model');

App::import('Lib', 'Utilities');
App::import('Lib', 'ResponseStatus');

App::uses('CakeEmail', 'Network/Email');

/**
 * User Model
 *
 * @property UserPartner $UserPartner
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'email';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'UserPartner' => array(
			'className' => 'UserPartner',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

        
        public function __sendAuthCode($email, $authentication_code){
            
            if(empty($email) || empty($authentication_code))
                return;
            
             //Se envia el correo de autentificacion de cuenta
            $Email = new CakeEmail('mandrill_smtp');
            $Email->from(array('me@example.com' => 'Konalen'));
            $Email->to($email);
            $Email->subject('Activation code');
            
            return $Email->send($authentication_code);
            
        }
        
        public function register($email, $password, $partner){
            
            $user = $this->findByEmail($email);
            
            print_r($user);
            
            $authentication_code = $this->UserPartner->createAuthenticationCode();
            
            if(empty($user)){
                
                $this->create();
                
                $user = array(
                    'User' => array(
                        'email' => $email
                    ),
                    'UserPartner' => array(
                        array(
                            'partner_id' => $partner['Partner']['id'],
                            'user_password' => Security::hash($password, null, true),
                            'authenticated' => 0,
                            'authentication_code' => $authentication_code
                        )
                    )
                );
                
                if(!$this->saveAssociated($user, array('atomic'=>true)))
                    throw new InternalErrorException(ResponseStatus::$server_error);

                $this->__sendAuthCode($email, $authentication_code);
                
                return array(
                    'id' => $this->id
                );
                
            }else{
                
                //Si encuentra el usuario se debe verificar si esta asociado al partner 
                $user_partner = $this->UserPartner->find('first', array(
                    'conditions' => array(
                        'UserPartner.user_id' => $user['User']['id'],
                        'UserPartner.partner_id' => $partner['Partner']['id']
                    )
                ));   
                    
                if($user_partner){
                    //El usuario ya esta asociado a este partner
                    throw new InternalErrorException(ResponseStatus::$user_already_registered);
                }

                $user_partner = array(
                    'UserPartner' => array(
                        'user_id' => $user['User']['id'],
                        'partner_id' => $partner['Partner']['id'],
                        'user_password' => Security::hash($password, null, true),
                        'authenticated' => 0,
                        'authentication_code' => $authentication_code
                    )
                );

                if(!$this->UserPartner->save($user_partner)){
                    throw new InternalErrorException(ResponseStatus::$server_error);
                }

                $this->__sendAuthCode($email, $authentication_code);
                
                return array(
                    'id' => $user['User']['id']
                );
                
            }
            
            return false;
            
        }
        
        
}
