<?php
App::uses('AppModel', 'Model');
/**
 * Service Model
 *
 * @property Partner $Partner
 */
class Notification extends AppModel {

    
        static public $types = array(
            'EMAIL' => 1,
            'PHONE' => 2
        );

        static public $status = array(
            'PENDING' => 1,
            'DELIVERED' => 2
        );
        
        
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
	);

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
        
        public function createNotification($user = null, $data = null, $type = null, $status = null){

            
            if(empty($user) || empty($data) || empty($type) || empty($status))
                return false;
            
            $notification = array(
                'Notification' => array(
                    'user_id' => $user['User']['id'],
                    'data' => json_encode($data),
                    'type' => $type,
                    'status' => $status
                )
            );
            
            return $this->save($notification);
            
        }
        
        
}
