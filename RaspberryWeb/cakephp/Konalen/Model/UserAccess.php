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

            return false;
            
        }
        
        
        public function createAccess($user_partner = null, $user_agent = null, $user_ip_address = null){

            if(empty($user_partner) || empty($user_agent) || empty($user_ip_address))
                return false;
            
            $dataSource = $this->getDataSource();
            
            $dataSource->begin();
            
            $session_id = $this->createSessionId();
            
            $user_access = array(
                'UserAccess' => array(
                    'user_partner_id' => $user_partner['UserPartner']['id'],
                    'user_agent' => $user_agent,
                    'ip_address' => $user_ip_address,
                    'session_id' => $session_id
                )
            );

            if($session_id && $this->save($user_access)){
                if($dataSource->commit())
                    return $this->findById($this->id);
            }else{
                $dataSource->rollback();
            }

            throw new InternalErrorException(ResponseStatus::$server_error);
            
        }
        
        public function checkSessionId($session_id = null){
            
            if(empty($session_id))
                return false;
            
            $dataSource = $this->getDataSource();
            
            $dataSource->begin();
            
            $user_access = $this->find('first', array(
                'conditions' => array(
                    'UserAccess.session_id' => $session_id
                ),
                'order' => array('UserAccess.id DESC')
            ));
            
            if(empty($user_access))
                return false;
            
            $new_session_id = $this->createSessionId();
            
            $user_access['UserAccess']['session_id'] = $new_session_id;

            if($new_session_id && $this->save($user_access)){
                if($dataSource->commit())
                    return $this->findById($this->id);
            }else{
                $dataSource->rollback();
            }

            return null;
            
        }
        
        
}

?>