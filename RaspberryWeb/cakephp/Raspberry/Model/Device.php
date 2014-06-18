<?php
App::uses('AppModel', 'Model');
/**
 * Device Model
 *
 * @property User $User
 * @property DevicesNotifications $DevicesNotifications
 */
class Device extends AppModel {
    
    
        public $status_disconnected = 0;
        public $status_connected = 1;
    

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'DevicesNotifications' => array(
			'className' => 'DevicesNotifications',
			'foreignKey' => 'device_id',
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
