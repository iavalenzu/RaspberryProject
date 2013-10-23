<?php
App::uses('AppModel', 'Model');
App::import('Lib', 'Utilities');


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
        
        public function add($partner = null){

            $data = array(
                'PartnerAccess' => array(
                    'user_agent' => Utilities::clientUserAgent(),
                    'ip_address' => Utilities::clientIp(),
                    'partner_id' => $partner['Partner']['id']
                )
            );

            return $this->save($data);
        }
        
        
}
