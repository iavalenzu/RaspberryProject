<?php
App::uses('AppModel', 'Model');
/**
 * Identity Model
 *
 * @property User $User
 * @property Identificator $Identificator
 */
class Identity extends AppModel {


    
        /**
         * Define los tipos de identidad disponible
         * 
         * @static 
         * @var array
         */
    
        static public $TYPE_EMAIL = 1;
        static public $TYPE_PHONE = 2;    
        static public $TYPE_GCM = 3;    
        static public $TYPE_APPLE = 4;    
        static public $TYPE_NAME = 5;    
    
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
		'AccountIdentity' => array(
			'className' => 'AccountIdentity',
			'foreignKey' => 'identity_id',
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
