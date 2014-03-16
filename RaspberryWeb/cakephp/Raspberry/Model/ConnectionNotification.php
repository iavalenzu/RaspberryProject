<?php
App::uses('AppModel', 'Model');
/**
 * ConnectionNotification Model
 *
 * @property Notification $Notification
 * @property Connection $Connection
 */
class ConnectionNotification extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Notification' => array(
			'className' => 'Notification',
			'foreignKey' => 'notification_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Connection' => array(
			'className' => 'Connection',
			'foreignKey' => 'connection_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
