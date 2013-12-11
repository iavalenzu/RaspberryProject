<?php
App::uses('AppModel', 'Model');
/**
 * AccessAttempt Model
 *
 * @property AccessAttempt $
 */
class AccessAttempt extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
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
