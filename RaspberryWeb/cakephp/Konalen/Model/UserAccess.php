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
            
        public function access($user_partner = null, $user_agent = null, $user_ip_address = null){

            if(empty($user_partner) || empty($user_agent) || empty($user_ip_address))
                return false;
            
            $user_access = array(
                'UserAccess' => array(
                    'user_partner_id' => $user_partner['UserPartner']['id'],
                    'user_agent' => $user_agent,
                    'ip_address' => $user_ip_address
                )
            );

            return $this->save($user_access);

        }
        
        
}

?>