<?php
App::uses('AppModel', 'Model');
/**
 * Response Model
 *
 * @property Notification $Notification
 */
class Response extends AppModel {
    
    public $status_pending = 0;
    public $status_received = 1;


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
		)
	);
}
