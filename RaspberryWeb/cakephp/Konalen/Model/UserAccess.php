<?php
App::uses('AppModel', 'Model');
/**
 * Service Model
 *
 * @property Partner $Partner
 */
class UserAccess extends AppModel {


	public $belongsTo = array(
		'UserPartner' => array(
			'className' => 'UserPartner',
			'foreignKey' => 'user_partner_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
            
        public function createSessionId(){
            
            $max_attempts = Configure::read('SessionIdGenerationAttempts');
            
            for($i=0; $i<$max_attempts; $i++){
                
                $code = Utilities::getRandomString(50);
                
                $access = $this->findBySessionId($code);
                
                if(empty($access))
                    return $code;
                
            }

            throw new InternalErrorException(ResponseStatus::$server_error);
        }
        
        
        public function access($user_partner = null, $user_agent = null, $user_ip_address = null, $session_id = null){

            if(empty($user_partner) || empty($user_agent) || empty($user_ip_address) || empty($session_id))
                return false;
            
            $user_access = array(
                'UserAccess' => array(
                    'user_partner_id' => $user_partner['UserPartner']['id'],
                    'user_agent' => $user_agent,
                    'ip_address' => $user_ip_address,
                    'session_id' => $session_id
                )
            );

            return $this->save($user_access);

        }
        
        
}

?>