<?php
App::uses('AppModel', 'Model');
/**
 * Fifo Model
 *
 * @property Device $Device
 */
class Fifo extends AppModel {
    
    
        public $type_out = 1;
        public $type_in = 2;

        
        public $status_connected = 21;
        public $status_disconnected = 22;

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
		'Device' => array(
			'className' => 'Device',
			'foreignKey' => 'device_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
