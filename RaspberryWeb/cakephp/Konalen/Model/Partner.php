<?php
App::uses('AppModel', 'Model');
App::import('Lib', 'Utilities');
App::import('Model', 'IpAddressAccessAttempt');

/**
 * Partner Model
 *
 * @package       Konalen.Model
 * @property Service $Service
 * @property UserPartner $UserPartner
 * @property PartnerAccess $PartnerAccess
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
		),
		'PartnerForm' => array(
			'className' => 'PartnerForm',
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
        
        public function getPartnerByPublicKey($public_key = null){
            
            if(empty($public_key))
                return false;

            if($this->IpAddressAccessAttempt->isIpAddressBlocked())
                return false;
            
            $this->recursive = 0;
            $partner = $this->findByPublicKey($public_key);

            if(empty($partner))
                $this->IpAddressAccessAttempt->attempt();
            
            return $partner;
            
        }
        
        
        
        /**
         * Autentifica a un Parner de acuerdo a sus credenciales, la llave de acceso
         * viene definida en el header 'Authorization' de la peticion
         * 
         * @access public
         * @return Partner
         * @throws UnauthorizedException
         */
        
        public function getAuthorizedPartner(){
            
            //Si la ip del request esta bloqueada, denegamos el acceso
            if($this->IpAddressAccessAttempt->isIpAddressBlocked()){
                throw new UnauthorizedException(ResponseStatus::$ip_address_blocked);
            }
            
            //Se obtiene la llave secreta que viene en el header
            $secret_key = Utilities::getAuthorizationKey();
            
            //Se chequea que el codigo tenga el formato correcto, en caso contrario se crea un intento de acceso
            if(!Utilities::checkCode($secret_key)){
                $this->IpAddressAccessAttempt->attempt();
                throw new UnauthorizedException(ResponseStatus::$access_denied);
            }

            //Se busca al usuario correspondiente a la llave secreta
            $this->recursive = 0;
            $partner = $this->findByPrivateKey($secret_key);
            
            //Si es vacio registramos un intento acceso, y denegamos el acceso
            if(empty($partner)){
                $this->IpAddressAccessAttempt->attempt();
                throw new UnauthorizedException(ResponseStatus::$access_denied);
            }
            
            //Dado que el ingreso fue exitoso, reseteamos los valores de intento de acceso
            $this->IpAddressAccessAttempt->reset();
            //Registramos la info del acceso
            $this->PartnerAccess->access($partner);
            

            return $partner;
            
       }
 
       
        /**
         * Callback Method
         * 
         * @param mixed $results
         * @param boolean $primary
         * @return mixed
         */
        
        
        public function afterFind($results, $primary = false) {
            
            foreach ($results as $key => $val) {
                if (isset($val['Partner']['private_key'])) {
                    $results[$key]['Partner']['private_key'] = "******";
                }
            }
            return $results;
        }               
       
}
