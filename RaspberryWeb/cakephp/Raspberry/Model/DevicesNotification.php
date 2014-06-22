<?php
App::uses('AppModel', 'Model');
/**
 * DevicesNotification Model
 *
 * @property Notification $Notification
 * @property Device $Device
 */
class DevicesNotification extends AppModel {
    
    public $status_pending = 0;
    public $status_sent = 1;


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
		'Device' => array(
			'className' => 'Device',
			'foreignKey' => 'device_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
