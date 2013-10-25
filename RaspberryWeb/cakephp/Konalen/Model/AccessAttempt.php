<?php
App::uses('AppModel', 'Model');



/**
 * Partner Model
 *
 * @property Service $Service
 * @property UserPartner $UserPartner
 */
class AccessAttempt extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = '';

        public $belongsTo = array(
		'IpAddressAccessAttempt' => array(
			'className' => 'IpAddressAccessAttempt',
			'foreignKey' => 'ip_address',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        
}
