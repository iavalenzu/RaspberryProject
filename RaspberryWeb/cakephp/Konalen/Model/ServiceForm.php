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
        
        public function garbageCollector(){
            
            $rand = rand(0,100);
            
            if($rand <= Configure::read('ServiceFormGarbageCollectorIndex')){

                $this->log("Borrando los registros expirados");
                
                $this->deleteAll(array(
                    'ServiceForm.form_expire <' => date('Y-m-d H:i:s')
                ), false);
                
            }
            
        }
        
        /**
         * 
         * @param Partner $partner
         * @return PartnerForm 
         */
        
        public function getForm($form_id = null){

            /*
             * Llamamos al garbage collector que se encarga de eliminar de las BD los registros de formularios expirados
             */
            $this->garbageCollector();
            
            if(empty($form_id)){
                return false;
            }
            
            $service_form = $this->find('first', array(
                'conditions' => array(
                    'ServiceForm.form_id' => $form_id,
                    'ServiceForm.form_expire >' => date('Y-m-d H:i:s') 
                )
            ));            
            
            return $service_form;
            
        }          
        
        public function createForm($service = null){
            
            if(empty($service)){
                return false;
            }
            
            $dataSource = $this->getDataSource();
            
            $dataSource->begin();
            
            $form_id = $this->createFormId();
            
            $form_timeout = $service['Service']['form_timeout'];
            
            $service_form = array(
                'ServiceForm' => array(
                    'service_id' => $service['Service']['id'],
                    'form_id' => $form_id,
                    'form_expire' => date('Y-m-d H:i:s', time() + $form_timeout)
                )
            );

            $this->create();
            
            if($form_id && $this->save($service_form)){
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

            $num_bits = Configure::read('FormIdCodeBitsLength');
            $max_attempts = Configure::read('SessionIdGenerationAttempts');
            
            for($i=0; $i<$max_attempts; $i++){
                
                $code = Utilities::getRandomCode($num_bits);
                
                $form = $this->findByFormId($code);
                
                if($code && empty($form)){
                    return $code;
                }
            }

            return false;
            
        }      
        
        
        /**
         * Callback Method
         * 
         * @param array $options
         * @return boolean
         */
        
        public function beforeSave($options = array()) {
            
            if(isset($this->data['ServiceForm']['data'])){
                $this->data['ServiceForm']['data'] = json_encode($this->data['ServiceForm']['data']);
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
                if (isset($val['ServiceForm']['data'])) {
                    $results[$key]['ServiceForm']['data'] = json_decode($val['ServiceForm']['data'], true);
                }
            }
            return $results;
        }           
        
}
