<?php
App::uses('AppModel', 'Model');

App::import('Lib', 'SecurePacket');

/**
 * OneTimeSecurePacket Model
 *
 */
class OneTimePacket extends AppModel {


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
                'OneTimePacket' => array(
                    'key' => $key,
                    'expires' => date('Y-m-d H:i:s', time() + 3600)
                )
            );

            if($key && $this->save($one_time_secure_packet)){
                if($dataSource->commit()){
                    return new OneTimeSecurePacket($data, $timeout, $key, $checkurl);
                }
            }else{
                $dataSource->rollback();
            }

            throw new InternalErrorException(ResponseStatus::$server_error);
            
        }        
        
        
}
