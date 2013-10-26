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
        
        
        public function createAuthenticationCode(){
            
            $max_attempts = Configure::read('AuthenticationCodeCreateAttempts');
            
            for($i=0; $i<$max_attempts; $i++){
                
                $code = Utilities::createCode();
                
                $user = $this->findByAuthenticationCode($code);
                
                if(empty($user))
                    return $code;
                
            }

            throw new InternalErrorException(ResponseStatus::$server_error);
        }
        
        
}
