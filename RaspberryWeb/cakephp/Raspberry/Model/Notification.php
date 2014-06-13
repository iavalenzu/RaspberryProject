<?php
App::uses('AppModel', 'Model');
/**
 * Notification Model
 *
 * @property Response $Response
 * @property DevicesNotifications $DevicesNotifications
 */
class Notification extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Response' => array(
			'className' => 'Response',
			'foreignKey' => 'notification_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'DevicesNotifications' => array(
			'className' => 'DevicesNotifications',
			'foreignKey' => 'notification_id',
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

}
