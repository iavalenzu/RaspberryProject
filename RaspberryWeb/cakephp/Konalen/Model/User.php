<?php
App::uses('AppModel', 'Model');
App::import('Lib', 'Utilities');
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

        
        public function createAuthenticationCode(){
            
            $max_attempts = 7;
            
            for($i=0; $i<$max_attempts; $i++){
                
                $code = Utilities::createCode();
                
                $user = $this->findByAuthenticationCode($code);
                
                if(empty($user))
                    return $code;
                
            }

            throw new InternalErrorException();
        }

        
        public function register($email, $password, $partner){
            
            $user = $this->findByEmail($email);
            
            if(empty($user)){
                
                $this->create();
                
                $authentication_code = $this->createAuthenticationCode();
                 
                $user = array(
                    'User' => array(
                        'email' => $email,
                        'authenticated' => 0,
                        'authentication_code' => $authentication_code
                    ),
                    'UserPartner' => array(
                        array(
                            'partner_id' => $partner['Partner']['id'],
                            'user_password' => Security::hash($password, null, true)
                        )
                    )
                );
                
                if(!$this->saveAssociated($user, array('atomic'=>true)))
                    throw new InternalErrorException();

                //Se envia el correo de autentificacion de cuenta
                $Email = new CakeEmail('mandrill_smtp');
                $Email->from(array('me@example.com' => 'Konalen'));
                $Email->to($email);
                $Email->subject('Activation code');
                $Email->send($authentication_code);
                
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
                    throw new InternalErrorException('El usuario ya esta registrado');
                }

                $user_partner = array(
                    'UserPartner' => array(
                        'user_id' => $user['User']['id'],
                        'partner_id' => $partner['Partner']['id'],
                        'user_password' => Security::hash($password, null, true)
                    )
                );

                if(!$this->UserPartner->save($user_partner)){
                    throw new InternalErrorException();
                }

                //Si el usuario no esta autentificado creamos un nuevo codigo y enviamos el correo de autenficacion
                if($user['User']['authenticated'] == '0'){
                    
                    $authentication_code = $this->createAuthenticationCode();
                     
                    $this->id = $user['User']['id'];
                    if(!$this->saveField('authentication_code', $authentication_code)){
                        throw new InternalErrorException();
                    }
                     
                    //Se envia el correo de autentificacion de cuenta
                    $Email = new CakeEmail('mandrill_smtp');
                    $Email->from(array('me@example.com' => 'Konalen'));
                    $Email->to($user['User']['email']);
                    $Email->subject('Activation code');
                    $Email->send($authentication_code);
                    
                }
                
                return array(
                    'id' => $user['User']['id']
                );
                
            }
            
            return false;
            
        }
        
        
}
