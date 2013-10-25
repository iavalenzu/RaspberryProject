<?php
App::uses('AppModel', 'Model');

class IpAddressAccessAttempt extends AppModel {

	public $displayField = '';
        public $primaryKey = 'ip_address';
        
        
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
        
        
        public function attempt(){
            
            $now = time();
            $ip_address = Utilities::clientIp();
            $user_agent = Utilities::clientUserAgent();
            $max_access_attempts = Configure::read('MaxAccessAttempts');

            $access = $this->findByIpAddress($ip_address);
            
            if($access){
                
                if($access['IpAddressAccessAttempt']['access_attempts'] >= $max_access_attempts){
                    $access['IpAddressAccessAttempt']['blocked_until'] = date('Y-m-d H:i:s', $now + 10*60);
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
