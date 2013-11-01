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

        
        public function createUserId(){
            
            $max_attempts = Configure::read('UserPublicIdGenerationAttempts');
            
            for($i=0; $i<$max_attempts; $i++){
                
                $code = Utilities::getRandomString(20,25);
                
                $user = $this->findByPublicId($code);
                
                if(empty($user))
                    return $code;
                
            }

            return false;
        }
        
        public function createUser($email = null){
            
            if(empty($email))
                return false;
            
            //Iniciamos la transaccion
            $dataSource = $this->getDataSource();
            $dataSource->begin();
            
            $public_id = $this->createUserId();
            
            $user = array(
               'User' => array(
                   'email' => $email,
                   'public_id' => $public_id
                )
            );
            
            if($public_id && $this->save($user)){
                if($dataSource->commit())
                    return $this->findById($this->id);
            }else{
                $dataSource->rollback();
            }   
            
            throw new InternalErrorException(ResponseStatus::$server_error);
            
        }
        
        public function sendActivationCode($user_partner = null){
            
            if(empty($user_partner))
                return;
            
            $data = array(
                'activation_code' => $user_partner['UserPartner']['activation_code']
            );
            
            return $this->Notification->createNotification($user_partner, $data, Notification::$types['EMAIL'], Notification::$status['PENDING']);

        }
        
        public function sendResetPassCode($user_partner = null){
            
            if(empty($user_partner))
                return;
            
            $data = array(
                'reset_password_code' => $user_partner['UserPartner']['reset_password_code']
            );
            
            return $this->Notification->createNotification($user_partner, $data, Notification::$types['EMAIL'], Notification::$status['PENDING']);
            
        }
        
        
}
