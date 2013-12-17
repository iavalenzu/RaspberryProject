<?php
App::uses('AppModel', 'Model');
/**
 * ServiceForm Model
 *
 * @property Service $Service
 */
class ServiceForm extends AppModel {


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
         * 
         * @param Partner $partner
         * @return PartnerForm 
         */
        
        public function getActiveSession($service = null){
            
            if(empty($service)){
                return false;
            }
            
            $service_form = $this->find('first', array(
                'conditions' => array(
                    'ServiceForm.service_id' => $service['Service']['id'],
                    'ServiceForm.form_expire >' => date('Y-m-d H:i:s') 
                ),
                'order' => array('ServiceForm.id DESC')
                
            ));            
            
            if(empty($service_form)){
                //Crea uno nuevo
                $service_form = $this->form($service);
                
            }
            
            return $service_form;
            
        }          
        
        public function form($service = null){
            
            if(empty($service)){
                return false;
            }
            
            $dataSource = $this->getDataSource();
            
            $dataSource->begin();
            
            $session_id = $this->createFormId();
            
            $session_duration = 10*60;
            
            $service_form = array(
                'ServiceForm' => array(
                    'service_id' => $service['Service']['id'],
                    'form_id' => $session_id,
                    'form_expire' => date('Y-m-d H:i:s', time() + $session_duration)
                )
            );

            $this->create();
            
            if($session_id && $this->save($service_form)){
                if($dataSource->commit()){
                    return $this->findById($this->id);
                }
            }else{
                $dataSource->rollback();
            }

            throw new InternalErrorException(ResponseStatus::$server_error);
                        
        }        
        
        
        /* 
         * @return string En caso de no lograr generar el nuevo id de sesion retorna false.
         */
        
        public function createFormId(){
            
            $max_attempts = Configure::read('SessionIdGenerationAttempts');
            
            for($i=0; $i<$max_attempts; $i++){
                
                $code = Utilities::getRandomString(50);
                
                $form = $this->findByFormId($code);
                
                if(empty($form)){
                    return $code;
                }
            }

            return false;
            
        }               
        
}
