<?php
App::uses('AppModel', 'Model');
App::import('Lib', 'Utilities');
App::import('Model', 'IpAddressAccessAttempt');



/**
 * Partner Model
 *
 * @property Service $Service
 * @property UserPartner $UserPartner
 */
class PartnerAccess extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = '';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

        public $belongsTo = array(
		'Partner' => array(
			'className' => 'Partner',
			'foreignKey' => 'partner_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        public function access($partner = null){
 
            $ip_address = Utilities::clientIp();
            $user_agent = Utilities::clientUserAgent();
            $partner_id = $partner['Partner']['id'];

            $data = array(
                'PartnerAccess' => array(
                    'user_agent' => $user_agent,
                    'ip_address' => $ip_address,
                    'partner_id' => $partner_id
                )
            );

            return $this->save($data);
        }
        
        
}
