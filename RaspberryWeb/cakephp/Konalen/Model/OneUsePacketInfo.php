<?php
App::uses('AppModel', 'Model');

App::import('Lib', 'Packet');
App::import('Model', 'IpAddressAccessAttempt');


/**
 * OneTimeSecurePacket Model
 *
 */
class OneUsePacketInfo extends AppModel {

    
        public function __construct($id = false, $table = null, $ds = null) {

            $this->IpAddressAccessAttempt = new IpAddressAccessAttempt();
            parent::__construct($id, $table, $ds);
            
        }     

    
        public function garbageCollector(){
            
            $rand = rand(0,100);
            
            if($rand <= Configure::read('OneUsePacketInfoGarbageCollectorIndex')){

                $this->log("Borrando los registros OneUsePacketInfo expirados");
                
                $this->deleteAll(array(
                    'OneUsePacketInfo.expires <' => date('Y-m-d H:i:s')
                ), false);

                $this->deleteAll(array(
                    'OneUsePacketInfo.active' => 0
                ), false);
                
            }
            
        }    
        
        public function isValidPacket($key = false){
            
            //Si la ip del request esta bloqueada, denegamos el acceso
            if($this->IpAddressAccessAttempt->isIpAddressBlocked()){
                return false;
            }
            
            if(empty($key)){
                $this->IpAddressAccessAttempt->attempt();
                return false;
            }
            
            $this->garbageCollector();
            
            
            $one_time_packet = $this->find('first', array(
                'conditions' => array(
                    'OneUsePacketInfo.key' => $key,
                    'OneUsePacketInfo.expires >' => date('Y-m-d H:i:s') 
                )
            ));    

            if(empty($one_time_packet)){
                $this->IpAddressAccessAttempt->attempt();
                return false;
            }
             
            if($one_time_packet['OneUsePacketInfo']['active'] == 0){
                $this->IpAddressAccessAttempt->attempt();
                return false;
            }
            

            if($one_time_packet['OneUsePacketInfo']['active'] == 1){
                
                $one_time_packet['OneUsePacketInfo']['active'] = 0;
                
                if(!$this->save($one_time_packet)){
                    return false;
                }
                
                return true;
            }
            
            
            $this->IpAddressAccessAttempt->attempt();
            return false;
            
            
            
        }
        
        
    
       /**
         * 
         * @return string En caso de no lograr generar el nuevo id de sesion retorna false.
         */
        
        public function createKey(){
            
            $num_bits = 2048;
            $max_attempts = 10;
            
            for($i=0; $i<$max_attempts; $i++){
                
                $code = Utilities::getRandomCode($num_bits);
                
                $packet = $this->findByKey($code);
                
                if(empty($packet)){
                    return $code;
                }
                
            }

            $this->log('Fallé al crear una llave unica en el modelo "OneTimeSecurePacket", el numero de intentos de creacion se excedió!!');
            
            return false;
            
        }        

        /**
         * 
         * @param UserPartner $user_partner
         * @param string $user_agent
         * @param string $user_ip_address
         * @return UserAccess
         * @throws InternalErrorException
         */
        
        public function createPacket($data = null, $timeout = null){

            $checkurl = Configure::read('LoginSecurePacketCheckUrl');
            
            if(empty($data) || empty($timeout)){
                return null;
            }
            
            $dataSource = $this->getDataSource();
            
            $dataSource->begin();
            
            $key = $this->createKey();
            
            $one_time_secure_packet = array(
                'OneUsePacketInfo' => array(
                    'key' => $key,
                    'expires' => date('Y-m-d H:i:s', time() + $timeout),
                    'active' => 1
                )
            );

            if($key && $this->save($one_time_secure_packet)){
                if($dataSource->commit()){
                    return new LoginPacket($data, $key, $checkurl);
                }
            }else{
                $dataSource->rollback();
            }

            throw new InternalErrorException(ResponseStatus::$server_error);
            
        }        
        
        
}
