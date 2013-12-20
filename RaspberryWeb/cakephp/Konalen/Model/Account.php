<?php
App::uses('AppModel', 'Model');
/**
 * Account Model
 *
 * @property User $User
 * @property Service $Service
 * @property UserAccess $UserAccess
 */
class Account extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Service' => array(
			'className' => 'Service',
			'foreignKey' => 'service_id',
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
		'UserAccess' => array(
			'className' => 'UserAccess',
			'foreignKey' => 'account_id',
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
		'AccountIdentity' => array(
			'className' => 'AccountIdentity',
			'foreignKey' => 'account_id',
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
		'Notification' => array(
			'className' => 'Notification',
			'foreignKey' => 'account_id',
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
        
        
        public function login($service = null, $user_id = null, $user_pass = null){

            if(empty($service) || empty($user_id) || empty($user_pass)){
                return array(
                    'success' => false,
                    'error' => array(
                        'msg' => 'Login Error'
                    )
                );
            }
            
            $identity = $this->AccountIdentity->getIdentity($user_id);
            
            if(empty($identity)){
                return array(
                    'success' => false,
                    'error' => array(
                        'msg' => 'Login Error'
                    )
                );
            }
            
            $account = $this->find('first', array(
                'conditions' => array(
                    'Account.service_id' => $service['Service']['id'],
                    'Account.user_password' => sha1($user_pass)
                ),
                'recursive' => -1
            ));

            if(empty($account)){
                return array(
                    'success' => false,
                    'error' => array(
                        'msg' => 'Login Error'
                    )
                );
            }
            
            $account_identity = $this->AccountIdentity->check($account, $identity);
            
            if(empty($account_identity)){
                return array(
                    'success' => false,
                    'error' => array(
                        'msg' => 'Login Error'
                    )
                );
            }
            
            //TODO Ver que info se envia al usuario
            
            return array(
                'success' => true,
                'user' => $account_identity,
                'error' => ''
            );
            
        }
        

}
