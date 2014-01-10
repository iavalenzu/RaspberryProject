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
		'AccountIdentity' => array(
			'className' => 'AccountIdentity',
			'foreignKey' => 'account_identity_id',
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
        
        public function createNotification($account_identity = null, $data = null, $status = null, $action = null){
            
            if(empty($account_identity) || empty($data) || empty($status) || empty($action)){
                return false;
            }
            
            $notification = array(
                'Notification' => array(
                    'account_identity_id' => $account_identity['AccountIdentity']['id'],
                    'data' => $data,
                    'status' => $status,
                    'action' => $action
                )
            );
            
            return $this->save($notification);
            
        }        
        
}
