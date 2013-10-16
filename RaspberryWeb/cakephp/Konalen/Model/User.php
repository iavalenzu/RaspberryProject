<?php
App::uses('AppModel', 'Model');
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

        
        public function getAuthenticationCode(){
            
            $max_attempts = 5;
            
            for($i=0; $i<$max_attempts; $i++){
                
                $microtime = microtime(true) . rand(1000, 9000);
                $code = sha1($microtime);
                
                $user = $this->findByAuthenticationCode($code);
                
                if(empty($user))
                    return $code;
                
            }

            return null;
        }
        
}
