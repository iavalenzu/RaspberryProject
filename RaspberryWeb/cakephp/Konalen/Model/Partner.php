<?php
App::uses('AppModel', 'Model');
App::import('Lib', 'Utilities');
App::import('Model', 'IpAddressAccessAttempt');

/**
 * Partner Model
 *
 * @property Service $Service
 * @property UserPartner $UserPartner
 */
class Partner extends AppModel {

        public $IpAddressAccessAttempt;

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
		),
		'PartnerAccess' => array(
			'className' => 'PartnerAccess',
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

        public function __construct($id = false, $table = null, $ds = null) {

            $this->IpAddressAccessAttempt = new IpAddressAccessAttempt();
            parent::__construct($id, $table, $ds);
            
        }        
        
        public function getAuthorizedPartner(){
            
            //Si la ip del request esta bloqueada, denegamos el acceso
            if($this->IpAddressAccessAttempt->isIpAddressBlocked()){
                throw new UnauthorizedException();
            }
            
            //Se obtiene la llave secreta que viene en el header
            $secret_key = Utilities::getAuthorizationKey();
            
            //Se chequea que el codigo tenga el formato correcto, en caso contrario se crea un intento de acceso
            if(!Utilities::checkCode($secret_key)){
                $this->IpAddressAccessAttempt->attempt();
                throw new UnauthorizedException();
            }

            //Se busca al usuario correspondiente a la llave secreta
            $partner = $this->findBySecretKey($secret_key);
            
            //Si es vacio registramos un intento acceso, y denegamos el acceso
            if(empty($partner)){
                $this->IpAddressAccessAttempt->attempt();
                throw new UnauthorizedException();
            }
            
            //Dado que el ingreso fue exitoso, reseteamos los valores de intento de acceso
            $this->IpAddressAccessAttempt->reset();
            //Registramos la info del acceso
            $this->PartnerAccess->access($partner);
            
            return $partner;
           
       }
        
}
