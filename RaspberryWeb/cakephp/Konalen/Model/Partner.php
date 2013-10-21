<?php
App::uses('AppModel', 'Model');
App::import('Lib', 'Utilities');

/**
 * Partner Model
 *
 * @property Service $Service
 * @property UserPartner $UserPartner
 */
class Partner extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Service' => array(
			'className' => 'Service',
			'foreignKey' => 'partner_id',
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
		'UserPartner' => array(
			'className' => 'UserPartner',
			'foreignKey' => 'partner_id',
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

        
        public function getAuthorizedPartner(){
           
            //Se obtiene la llave secreta que viene en el header
            $secret_key = Utilities::getAuthorizationKey();

            //Se chequea que el codigo tenga el formato correcto
            if(!Utilities::checkCode($secret_key))
                throw new UnauthorizedException();

            //Se busca al usuario correspondiente a la llave secreta
            $partner = $this->findBySecretKey($secret_key);
            
            return $partner;
           
       }
        
        
        
}
