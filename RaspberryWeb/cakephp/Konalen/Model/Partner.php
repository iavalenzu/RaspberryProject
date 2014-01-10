<?php
App::uses('AppModel', 'Model');
/**
 * Partner Model
 *
 * @property PartnerAccess $PartnerAccess
 * @property Service $Service
 */

App::import('Lib', 'SecurePacket');
App::import('Lib', 'SecureReceiver');
App::import('Model', 'IpAddressAccessAttempt');


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
		)
	);

        
        public function __construct($id = false, $table = null, $ds = null) {

            $this->IpAddressAccessAttempt = new IpAddressAccessAttempt();
            parent::__construct($id, $table, $ds);
            
        }    

        public function validCheckSum($service_id = null, $form_id = null, $transaction_id = null, $checksum = null){
            
            
            
            
            
        }
        
        
        public function checkAccess($partner = null, $data = null, &$plain_data = null){
            
            //Si la ip del request esta bloqueada, denegamos el acceso
            if($this->IpAddressAccessAttempt->isIpAddressBlocked()){
                throw new UnauthorizedException(ResponseStatus::$ip_address_blocked);
            }
            
            if(empty($partner) || empty($data)){
                $this->IpAddressAccessAttempt->attempt();
                throw new UnauthorizedException(ResponseStatus::$access_denied);
            }

            //Se crea un recibidor seguro de mensaje y desencriptamos el saludo con la llave publica del partner
            $spr = new SecureReceiver();
            $spr->setSenderPublicKey($partner['Partner']['public_key']);
            $spr->setRecipientPrivateKey(Configure::read('KonalenPrivateKey'));
        
            //Desencriptamos el mensaje
            $plain_data = $spr->decrypt($data);
            
            if(empty($plain_data)){
                $this->IpAddressAccessAttempt->attempt();
                throw new UnauthorizedException(ResponseStatus::$access_denied);
            }

            //Dado que el ingreso fue exitoso, reseteamos los valores de intento de acceso
            $this->IpAddressAccessAttempt->reset();
            //Registramos la info del acceso
            $this->PartnerAccess->access($partner);
            
            return true;
            
        }
        
        public function checkCredentials($name = null, $key = null){
            
            //Si la ip del request esta bloqueada, denegamos el acceso
            if($this->IpAddressAccessAttempt->isIpAddressBlocked()){
                throw new UnauthorizedException(ResponseStatus::$ip_address_blocked);
            }
            
            if(empty($name) || empty($key)){
                $this->IpAddressAccessAttempt->attempt();
                throw new UnauthorizedException(ResponseStatus::$access_denied);
            }

            //Se busca al usuario correspondiente al nombre de usuario
            $this->recursive = 0;
            $partner = $this->findByName($name);
            
            //Si es vacio registramos un intento acceso, y denegamos el acceso
            if(empty($partner)){
                $this->IpAddressAccessAttempt->attempt();
                throw new UnauthorizedException(ResponseStatus::$access_denied);
            }

            //Se crea un recibidor seguro de mensaje y desencriptamos el saludo con la llave publica del partner
            $spr = new SecureReceiver();
            $spr->setSenderPublicKey($partner['Partner']['public_key']);
            $spr->setRecipientPrivateKey(Configure::read('KonalenPrivateKey'));
        
            //Desencriptamos el mensaje
            $packet = $spr->decrypt($key);
            
            if(empty($packet) || $packet->isEmpty()){
                $this->IpAddressAccessAttempt->attempt();
                throw new UnauthorizedException(ResponseStatus::$access_denied);
            }

            //Chequeamos si el paquete corresponde a uno de tipo HELLO
            if(!$packet->isData(HelloPacket::$DATA)){
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
         * Autentifica a un Parner de acuerdo a sus credenciales, el nombre de usuario y la llave de acceso (saludo)
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
            
            //Se obtiene el nombre de usuario y el saludo inicial que viene en el header AUTHORIZATION
            $credentials = Utilities::getCredentials();
            
            if(empty($credentials)){
                $this->IpAddressAccessAttempt->attempt();
                throw new UnauthorizedException(ResponseStatus::$access_denied);
            }

            //Se busca al usuario correspondiente al nombre de usuario
            //$this->recursive = 0;
            $partner = $this->findByName($credentials->name);
            
            //Si es vacio registramos un intento acceso, y denegamos el acceso
            if(empty($partner)){
                $this->IpAddressAccessAttempt->attempt();
                throw new UnauthorizedException(ResponseStatus::$access_denied);
            }

            //Se obtiene la llave privade de KONALEN
            $KonalenPrivateKey = Configure::read('KonalenPrivateKey');
        
            //Se crea un recibidor seguro de mensaje y desencriptamos el saludo con la llave publica del partner
            $spr = new SecureReceiver();
            $spr->setSenderPublicKey($partner['Partner']['public_key']);
            $spr->setRecipientPrivateKey($KonalenPrivateKey);
        
            //Desencriptamos el mensaje
            $msg = $spr->decrypt($credentials->key);
            
            if(empty($msg)){
                $this->IpAddressAccessAttempt->attempt();
                throw new UnauthorizedException(ResponseStatus::$access_denied);
            }
            
            //Si el mensaje es distinto de AUTHENTICATE retornamos una excepcion
            if(strcasecmp(trim($msg), 'HELLO')){
                $this->IpAddressAccessAttempt->attempt();
                throw new UnauthorizedException(ResponseStatus::$access_denied);
            }
            
            //Dado que el ingreso fue exitoso, reseteamos los valores de intento de acceso
            $this->IpAddressAccessAttempt->reset();
            //Registramos la info del acceso
            $this->PartnerAccess->access($partner);
            

            return $partner;
            
       }        
        
        
}
