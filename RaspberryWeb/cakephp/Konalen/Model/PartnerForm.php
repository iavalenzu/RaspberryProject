<?php

App::uses('AppModel', 'Model');
App::import('Lib', 'ResponseStatus');
App::import('Model', 'IpAddressAccessAttempt');




/**
 * Description of PartnerForm
 *
 * @author Ismael Valenzuela <iavalenzu@gmail.com>
 */
class PartnerForm extends AppModel{
    
    /**
 * The Associations below have been created with all possible keys, those that are not needed can be removed
 * 
 * @var array 
 * 
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

        
        
        public function __construct($id = false, $table = null, $ds = null) {

            $this->IpAddressAccessAttempt = new IpAddressAccessAttempt();
            parent::__construct($id, $table, $ds);
            
        }          
        
        
 /**
         * 
         * @return string En caso de no lograr generar el nuevo id de sesion retorna false.
         */
        
        public function createSessionId(){
            
            $max_attempts = Configure::read('SessionIdGenerationAttempts');
            
            for($i=0; $i<$max_attempts; $i++){
                
                $code = Utilities::getRandomString(50);
                
                $access = $this->findBySessionId($code);
                
                if(empty($access))
                    return $code;
                
            }

            return false;
            
        }       
        
        
        public function getSession($session_id = null){

            if(empty($session_id))
                return false;
            
            if($this->IpAddressAccessAttempt->isIpAddressBlocked())
                return false;
            
            $partner_form = $this->find('first', array(
                'conditions' => array(
                    'PartnerForm.session_id' => $session_id,
                    'PartnerForm.session_expire >' => date('Y-m-d H:i:s') 
                ),
                'order' => array('PartnerForm.id DESC')
                
            ));            
            
            if(empty($partner_form)){
                //Crea un intento de acceso
                $this->IpAddressAccessAttempt->attempt();
                return false;
            }
            
            return $partner_form;
            
        }
        
        /**
         * 
         * @param Partner $partner
         * @return PartnerForm 
         */
        
        public function getActiveSession($partner = null){
            
            if(empty($partner))
                return false;
            
            $partner_form = $this->find('first', array(
                'conditions' => array(
                    'PartnerForm.partner_id' => $partner['Partner']['id'],
                    'PartnerForm.session_expire >' => date('Y-m-d H:i:s') 
                ),
                'order' => array('PartnerForm.id DESC')
                
            ));            
            
            if(empty($partner_form)){
                //Crea uno nuevo
                $partner_form = $this->form($partner);
                
            }
            
            return $partner_form;
            
        }        
        
        public function setCaptchaChecksum($session_id = null, $checksum = null){
            
            if(empty($session_id) || empty($checksum))
                return false;
            
            
            $partner_form = $this->findBySessionId($session_id);
            
            if($partner_form){
                
                $partner_form['PartnerForm']['captcha_checksum'] = $checksum;

                return $this->save($partner_form);
                
            }
            
            return false;
            
        }
        
        public function setData($session_id = null, $new_data = false){
            
            if(empty($session_id) || empty($new_data))
                return false;
            
            $this->recursive = 0;
            $partner_form = $this->findBySessionId($session_id);
            
            $partner_form['PartnerForm']['data'] = $new_data;
            
            return $this->save($partner_form);
            
        }
        
        
        public function form($partner = null){
            
            if(empty($partner))
                return false;
            
            $dataSource = $this->getDataSource();
            
            $dataSource->begin();
            
            $session_id = $this->createSessionId();
            
            $session_duration = 10*60;
            
            $partner_form = array(
                'PartnerForm' => array(
                    'partner_id' => $partner['Partner']['id'],
                    'session_id' => $session_id,
                    'session_expire' => date('Y-m-d H:i:s', time() + $session_duration)
                )
            );

            $this->create();
            
            if($session_id && $this->save($partner_form)){
                if($dataSource->commit())
                    return $this->findById($this->id);
            }else{
                $dataSource->rollback();
            }

            throw new InternalErrorException(ResponseStatus::$server_error);
                        
        }
        
        /**
         * Callback Method
         * 
         * @param array $options
         * @return boolean
         */
        
        public function beforeSave($options = array()) {
            
            if(isset($this->data['PartnerForm']['data'])){
                $this->data['PartnerForm']['data'] = json_encode($this->data['PartnerForm']['data']);
            }
            
            return true;
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
                if (isset($val['PartnerForm']['data'])) {
                    $results[$key]['PartnerForm']['data'] = json_decode($val['PartnerForm']['data'], true);
                }
            }
            return $results;
        }              
    
    
}

?>
