<?php

App::uses('AppController', 'Controller');
App::import('Lib', 'Utilities');

App::import('Lib', 'SecureSender');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property RequestHandlerComponent $RequestHandler
 * @author Ismael Valenzuela <iavalenzu@gmail.com>
 * @package Konalen.Controller
 * 
*/
class FormsController extends AppController {
    

  public $uses = array('PartnerAccess', 'IpAddressAccessAttempt', 'User', 'Partner', 'Identity', 'Service', 'ServiceForm', 'Account', 'AccountAccess', 'OneUsePacketInfo');
    
  
  
  public function register(){

    $this->autoLayout = false;
    $this->autoRender = false;
    
  }  
  
  public function login(){
        
        $this->Components->unload('DebugKit.Toolbar');

        $this->layout = 'api';

        $form_id = Utilities::exists($this->request->query, 'FormId', true, true, false);
        $service_id = Utilities::exists($this->request->query, 'ServiceId', true, true, false);
        $transaction_id = Utilities::exists($this->request->query, 'TransactionId', true, true, false);
        
        $checksum_key_encrypted = Utilities::exists($this->request->query, 'CheckSumKey', true, true, false);
        $checksum = Utilities::exists($this->request->query, 'CheckSum', true, true, false);

        /*
         * Se verifica que la ip que hace la peticion no se encuentre bloqueada
         */
        if($this->IpAddressAccessAttempt->isIpAddressBlocked()){
            throw new UnauthorizedException(ResponseStatus::$ip_address_blocked);
        }        
        
        /*
         * Se obtiene el servicio asociado
         */
        $service = $this->Service->findById($service_id);

        if(empty($service)){
            $this->IpAddressAccessAttempt->attempt();
            throw new UnauthorizedException(ResponseStatus::$access_denied);
        }
        
        /*
         * Se crea un recibidor seguro de mensajes y desencriptamos el checksum
         */
        $spr = new SecureReceiver();
        $spr->setSenderPublicKey($service['Partner']['public_key']);
        $spr->setRecipientPrivateKey(Configure::read('KonalenPrivateKey'));

        $checksum_key_decrypted = $spr->decrypt($checksum_key_encrypted);        
 
        if(empty($checksum_key_decrypted)){
            $this->IpAddressAccessAttempt->attempt();
            throw new UnauthorizedException(ResponseStatus::$access_denied);
        }

        /*
         * Se verifica que el checksum corresponda a la data enviada
         */
        if(hash_hmac('sha256', implode('.', array($form_id, $service_id, $transaction_id)), $checksum_key_decrypted) !== $checksum){
            $this->IpAddressAccessAttempt->attempt();
            throw new UnauthorizedException(ResponseStatus::$access_denied);   
        }
        
        /*
         * Se obtiene el form asociado al id
         */
        
        $service_form = $this->ServiceForm->getForm($form_id);
        
        if(empty($service_form)){
            $service_form = $this->ServiceForm->createForm($service);
        }

        
        /*
         * Dado que el ingreso fue exitoso, reseteamos los valores de intento de acceso
         */
        $this->IpAddressAccessAttempt->reset();
        
        /*
         * Registramos la info del acceso
         */
        $this->PartnerAccess->access($service);        

            
        $form_data = $service_form['ServiceForm']['data'];
        $form_id = $service_form['ServiceForm']['form_id'];

        $this->set('form_data', $form_data);
        
        $this->set('form_id', $form_id);
        $this->set('service_id', $service_id);
        $this->set('transaction_id', $transaction_id);  
        
        $this->set('checksum', hash_hmac('sha256', implode('.', array($form_id, $service_id, $transaction_id)), $checksum_key_decrypted));        
        $this->set('checksum_key', $checksum_key_encrypted);        
        
    }    
    
    
    
}

?>