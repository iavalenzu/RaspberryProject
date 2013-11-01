<?php
App::uses('AppModel', 'Model');
/**
 * Service Model
 *
 * @property Notification $Notification
 */
class Notification extends AppModel {

        /**
         * @static 
         * @var array
         */
    
        static public $types = array(
            'EMAIL' => 1,
            'PHONE' => 2
        );

        /**
         * @static 
         * @var array
         */
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

        /**
         * 
         * Crea una nueva notificacion que luego será despachada.
         * 
         * @param User $user
         * @param array $data
         * @param integer $type
         * @param integer $status
         * @return boolean
         */
        
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
