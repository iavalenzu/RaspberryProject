<?php
App::uses('AppModel', 'Model');
/**
 * IpAddressAccessAttempt Model
 *
 * @property AccessAttempt $AccessAttempt
 */
class IpAddressAccessAttempt extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'ip_address';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'AccessAttempt' => array(
			'className' => 'AccessAttempt',
			'foreignKey' => 'ip_address',
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

        /**
         * Funcion encargada de resetear el numero de intentos de acceso y la fecha de bloqueo para la 
         * direccion ip que generó la peticion.
         * 
         * @access public
         * @return boolean
         */
        
        public function reset(){
            
            $ip_address = Utilities::clientIp();
            
            $access = $this->findByIpAddress($ip_address);
            
            if($access){
                
                $access['IpAddressAccessAttempt']['access_attempts'] = 0;
                $access['IpAddressAccessAttempt']['blocked_until'] = null;
                
                return $this->save($access);
                
            }
            
            return true;
            
        }

        /**
         * Genera un nuevo intento de acceso, si se supera el maximo de intentos de acceso se 
         * bloquea la direccion ip hasta una proxima fecha
         * 
         * @access public
         * @return boolean
         */
        
        public function attempt(){
            
            $now = time();
            $ip_address = Utilities::clientIp();
            $user_agent = Utilities::clientUserAgent();
            $max_access_attempts = Configure::read('MaxAccessAttempts');
            $blocked_period = Configure::read('BlockedPeriod');
            

            $access = $this->findByIpAddress($ip_address);
            
            if($access){
                
                if($access['IpAddressAccessAttempt']['access_attempts'] >= $max_access_attempts){
                    $access['IpAddressAccessAttempt']['blocked_until'] = date('Y-m-d H:i:s', $now + $blocked_period);
                    $access['IpAddressAccessAttempt']['access_attempts'] = 0;
                }else{
                    $access['IpAddressAccessAttempt']['access_attempts']++;
                }
                
            }else{
                
                $access = array(
                    'IpAddressAccessAttempt' => array(
                        'ip_address' => $ip_address, 
                        'access_attempts' => 1,
                        'blocked_until' => null
                    )
                );                
                
            }
            
            $access['AccessAttempt'] = array(
                array('user_agent' => $user_agent)
            ); 
            
            return $this->saveAssociated($access);
            
        }
        
        /**
         * Verifica si la ip que realizó la peticion se encuentra bloqueada
         * 
         * @access public
         * @return boolean
         */
        
        public function isIpAddressBlocked(){
            
            $now = time();
            $ip_address = Utilities::clientIp();
            
            $blocked = $this->find('first', array(
                'conditions' => array(
                    'IpAddressAccessAttempt.ip_address' => $ip_address,
                    'IpAddressAccessAttempt.blocked_until >=' => date('Y-m-d H:i:s', $now) 
                ),
                'order' => array('IpAddressAccessAttempt.created DESC')
            ));
            
            return ($blocked) ? true : false;
            
        }
        
        
        
}
