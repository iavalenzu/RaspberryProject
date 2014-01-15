<?php
App::uses('AppModel', 'Model');
/**
 * Notification Model
 *
 * @property User $User
 */
class Notification extends AppModel {


        

        /**
         * Define el estado en que se encuentra una notificacion en particular
         * 
         * @static 
         * @var array
         */

        static public $STATUS_PENDING = 1;
        static public $STATUS_DELIVERED = 2;

        /*
         * Actions
         */
        
        static public $ACTION_NONE = 1;
        static public $ACTION_LOGIN = 2;
        static public $ACTION_ACTIVATE = 3;
        
        
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Account' => array(
			'className' => 'Account',
			'foreignKey' => 'account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        /**
         * 
         * Crea una nueva notificacion.
         * 
         * @access public
         * @param User $user
         * @param array $data
         * @param integer $type
         * @param integer $status
         * @return boolean
         */
        
        public function createNotification($account = null, $data = null, $status = null, $action = null, $type = null){
            
            if(empty($account) || empty($data) || empty($status) || empty($action) || empty($type)){
                return false;
            }
            
            $notification = array(
                'Notification' => array(
                    'account_id' => $account['Account']['id'],
                    'data' => $data,
                    'status' => $status,
                    'action' => $action,
                    'type' => $type
                )
            );
            
            return $this->save($notification);
            
        }        
        
}
