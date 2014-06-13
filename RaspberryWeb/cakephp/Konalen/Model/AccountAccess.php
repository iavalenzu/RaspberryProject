<?php
App::uses('AppModel', 'Model');
/**
 * UserAccess Model
 *
 * @property Account $Account
 */
class AccountAccess extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Account' => array(
			'className' => 'Account',
			'foreignKey' => 'account_id',
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
            
            $num_bits = Configure::read('AccessAccountSessionIdBitsLength');
            $max_attempts = Configure::read('SessionIdGenerationAttempts');
            
            for($i=0; $i<$max_attempts; $i++){
                
                $code = Utilities::getRandomCode($num_bits);
                
                $access = $this->findBySessionId($code);
                
                if(empty($access)){
                    return $code;
                }
                
            }

            $this->log('Fallé al crear un id de session unico en el modelo "AccountAccess", el numero de intentos de creacion se excedió!!');
            
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
        
        public function createAccess($account_id = null, $service_session_timeout = null){

            if(empty($account_id) || empty($service_session_timeout)){
                return false;
            }
            
            $dataSource = $this->getDataSource();
            
            $dataSource->begin();
            
            $session_id = $this->createSessionId();
            
            $account_access = array(
                'AccountAccess' => array(
                    'account_id' => $account_id,
                    'user_agent' => Utilities::clientUserAgent(),
                    'ip_address' => Utilities::clientIp(),
                    'session_id' => $session_id,
                    'session_expire' => date('Y-m-d H:i:s', time() + $service_session_timeout),
                    'active' => 1
                )
            );

            if($session_id && $this->save($account_access)){
                if($dataSource->commit()){
                    return $this->findById($this->id);
                }
            }else{
                $dataSource->rollback();
            }

            throw new InternalErrorException(ResponseStatus::$server_error);
            
        }        
        
        
}
