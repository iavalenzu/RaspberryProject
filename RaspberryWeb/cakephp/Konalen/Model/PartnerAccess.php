<?php
App::uses('AppModel', 'Model');
/**
 * PartnerAccess Model
 *
 * @property Partner $Partner
 */
class PartnerAccess extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Partner' => array(
			'className' => 'Partner',
			'foreignKey' => 'partner_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        /**
         * Crea un nuevo intento de acceso considerando info de la peticion como es 
         * la direccion ip y el user-agent.
         * 
         * @param Partner $partner
         * @return boolean
         */        
        
        public function access($partner = null){
            
            $ip_address = Utilities::clientIp();
            $user_agent = Utilities::clientUserAgent();
            $partner_id = $partner['Partner']['id'];

            $partner_access = array(
                'PartnerAccess' => array(
                    'user_agent' => $user_agent,
                    'ip_address' => $ip_address,
                    'partner_id' => $partner_id
                )
            );

            return $this->save($partner_access);
            
        }
                
        
}
