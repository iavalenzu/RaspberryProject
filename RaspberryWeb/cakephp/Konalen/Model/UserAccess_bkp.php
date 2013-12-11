<?php
App::uses('AppModel', 'Model');
/**
 * UserAccess Model
 *
 * @package       Konalen.Model
 * @property UserPartner $UserPartner
 * @author Ismael Valenzuela <iavalenzu@gmail.com>
 */
class UserAccess extends AppModel {

    /**
     * BelongsTo Associations
     * 
     * @var array
     */

	public $belongsTo = array(
		'UserPartner' => array(
			'className' => 'UserPartner',
			'foreignKey' => 'user_partner_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

        /**
         * 
         * @return string En caso de no lograr generar el nuevo id de sesion retorna false.
         */
        
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
        
        /**
         * 
         * @param UserPartner $user_partner
         * @param string $user_agent
         * @param string $user_ip_address
         * @return UserAccess
         * @throws InternalErrorException
         */
        
        public function createAccess($user_partner = null){

            if(empty($user_partner))
                return false;
            
            $dataSource = $this->getDataSource();
            
            $dataSource->begin();
            
            $session_id = $this->createSessionId();
            
            $session_duration = $user_partner['Partner']['session_duration'];
            
            $user_access = array(
                'UserAccess' => array(
                    'user_partner_id' => $user_partner['UserPartner']['id'],
                    'user_agent' => Utilities::clientUserAgent(),
                    'ip_address' => Utilities::clientIp(),
                    'session_id' => $session_id,
                    'session_expire' => date('Y-m-d H:i:s', time() + $session_duration)
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
        
        /**
         * 
         * @param string $session_id
         * @param Partner $partner
         * @return UserAccess En caso que el id de sesion provisto sea invalido se retorna false, en caso contrario se retorna una nueva session.
         */
        
        public function checkSessionId($session_id = null, $partner = null){
            
            if(empty($session_id) || empty($partner))
                return false;
            
            $dataSource = $this->getDataSource();
            
            $dataSource->begin();
            
            $user_access = $this->find('first', array(
                'conditions' => array(
                    'UserAccess.session_id' => $session_id,
                    'UserAccess.session_expire >' => date('Y-m-d H:i:s') 
                ),
                'order' => array('UserAccess.id DESC')
            ));
            
            if(empty($user_access))
                return false;
            
            $new_session_id = $this->createSessionId();
            $session_duration = $partner['Partner']['session_duration'];
            
            $user_access['UserAccess']['session_id'] = $new_session_id;
            $user_access['UserAccess']['session_expire'] = date('Y-m-d H:i:s', time() + $session_duration);

            
            if($new_session_id && $this->save($user_access)){
                if($dataSource->commit())
                    return $this->findById($this->id);
            }else{
                $dataSource->rollback();
            }

            return false;
            
        }
        
}

?>