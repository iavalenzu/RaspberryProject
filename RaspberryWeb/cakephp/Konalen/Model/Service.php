<?php
App::uses('AppModel', 'Model');
/**
 * Service Model
 *
 * @property Partner $Partner
 * @property Account $Account
 * @property ServiceForm $ServiceForm
 */
class Service extends AppModel {

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
		'Partner' => array(
			'className' => 'Partner',
			'foreignKey' => 'partner_id',
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
		'Account' => array(
			'className' => 'Account',
			'foreignKey' => 'service_id',
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
		'ServiceForm' => array(
			'className' => 'ServiceForm',
			'foreignKey' => 'service_id',
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

        public function getService($partner = null, $service_id = null){
            
            if(empty($partner) || empty($service_id)){
                return null;
            }
            
            $service = $this->find('first', array(
                'conditions' => array(
                    'Service.id' => $service_id,
                    'Service.partner_id' => $partner['Partner']['id']
                )
            ));
            
            if(empty($service)){
                throw new UnauthorizedException(ResponseStatus::$access_denied);
            }
            
            return $service;
            
        }
        
        
}
