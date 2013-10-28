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
		),
		'Notification' => array(
			'className' => 'Notification',
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
		),
	);

        public function getUserByEmailAndPartner($email = null, $partner = null){
            
            $user = $this->findByEmail($email);
            
            if(empty($user))
                return false;
            
            $user_partner = $this->UserPartner->find('first', array(
                'conditions' => array(
                    'UserPartner.user_id' => $user['User']['id'],
                    'UserPartner.partner_id' => $partner['Partner']['id'],
                )
            ));
            
            return $user_partner;
            
        }
        
        public function sendActivationCode($user, $activation_code){
            
            if(empty($user) || empty($activation_code))
                return;
            
            $data = array(
                'activation_code' => $activation_code
            );
            
            return $this->Notification->add($user, $data, Notification::$types['EMAIL'], Notification::$status['PENDING']);
/*            
             //Se envia el correo de autentificacion de cuenta
            $Email = new CakeEmail('mandrill_smtp');
            $Email->from(array('me@example.com' => 'Konalen'));
            $Email->to($email);
            $Email->subject('Activation code');
            
            return $Email->send($activation_code);
*/            
        }
        
        public function register($email, $password, $partner){
            
            $user = $this->findByEmail($email);
            
            $activation_code = $this->UserPartner->createAuthenticationCode();
            
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
                            'active' => 0,
                            'activation_code' => $activation_code
                        )
                    )
                );
                
                if(!$this->saveAssociated($user, array('atomic'=>true)))
                    throw new InternalErrorException(ResponseStatus::$server_error);
                
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
                    return array(
                        'msg' => ResponseStatus::$user_already_registered,
                        'data' => array()
                    );
                }

                $user_partner = array(
                    'UserPartner' => array(
                        'user_id' => $user['User']['id'],
                        'partner_id' => $partner['Partner']['id'],
                        'user_password' => Security::hash($password, null, true),
                        'active' => 0,
                        'activation_code' => $activation_code
                    )
                );

                if(!$this->UserPartner->save($user_partner)){
                    throw new InternalErrorException(ResponseStatus::$server_error);
                }

            }
            
            
            $new_user = $this->getUserByEmailAndPartner($email, $partner);

            if(empty($new_user))
                throw new InternalErrorException(ResponseStatus::$server_error);

            if(!$this->sendActivationCode($new_user, $activation_code)){
                throw new InternalErrorException(ResponseStatus::$server_error);
            }

            return array(
                'msg' => ResponseStatus::$user_registered,
                'data' => array(
                    'id' => $new_user['User']['id'],
                    'email' => $new_user['User']['email'],
                    'created' => $new_user['UserPartner']['created']
                )
            );
            
        }
        
}
