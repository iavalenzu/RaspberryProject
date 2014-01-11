<?php
App::uses('AppModel', 'Model');
/**
 * AccountIdentity Model
 *
 * @property AccountIdentity $AccountIdentity
 */
class AccountIdentity extends AppModel {


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
		),
		'Identity' => array(
			'className' => 'Identity',
			'foreignKey' => 'identity_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
        
        public $hasMany = array(
            'Notification' => array(
                'className' => 'Notification',
                'foreignKey' => 'account_identity_id',
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

        public function getTwoStepIdentity($account_id = null){

            
            $types = array(
                Identity::$TYPE_PHONE,
                Identity::$TYPE_EMAIL
            );
            
            foreach ($types as $type) {

                $account_identity = $this->find('first', array(
                    'conditions' => array(
                        'AccountIdentity.account_id' => $account_id,
                        'Identity.type' => $type,
                        'AccountIdentity.authenticated' => 1
                    )
                ));
                
                if(!empty($account_identity)){
                    return $account_identity;
                }
                
            }
            
            return null;             
            
        }        
        
        
        public function getIdentity($user_id = null){
            
            if(empty($user_id)){
                return null;
            }

            return $this->Identity->find('first', array(
                'conditions' => array(
                    'Identity.identificator' => $user_id
                ),
                'recursive' => -1
            ));
            
        }
        
        public function check($account = null, $identity = null){
            
            if(empty($account) || empty($identity)){
                return null;
            }
            
            return $this->find('first', array(
                'conditions' => array(
                    'AccountIdentity.account_id' => $account['Account']['id'],
                    'AccountIdentity.identity_id' => $identity['Identity']['id'],
                    'AccountIdentity.authenticated' => 1
                )
            ));
        }
        
}
