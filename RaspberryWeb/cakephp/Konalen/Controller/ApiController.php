<?php

App::uses('AppController', 'Controller');
App::import('Lib', 'Utilities');

//App::import('Lib', 'Packet');
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
class ApiController extends AppController {
    

    /**
     * Uses
     *
     * @var array
     */
    public $uses = array('PartnerAccess', 'IpAddressAccessAttempt', 'User', 'Partner', 'Identity', 'Service', 'ServiceForm', 'Account', 'AccountAccess', 'OneUsePacketInfo', 'Notification', 'AccountIdentity');

    public $components = array('Session');
    
    public function beforeFilter() {
        parent::beforeFilter();
        
    }

    
    public function checksession(){

        $this->autoLayout = false;
        $this->autoRender = false;
        
        $form_id = Utilities::exists($this->request->data, 'form_id', true, true, false);
        
        
    }

    
    public function checkcode(){
        
        $this->autoLayout = false;
        $this->autoRender = false;
        
        $form_id = Utilities::exists($this->request->data, 'form_id', Utilities::$REQUIRED, Utilities::$EMPTY, false);
        $service_id = Utilities::exists($this->request->data, 'service_id', Utilities::$REQUIRED, Utilities::$EMPTY, false);
        $transaction_id = Utilities::exists($this->request->data, 'transaction_id', Utilities::$REQUIRED, Utilities::$EMPTY, false);
        
        $checksum = Utilities::exists($this->request->data, 'checksum', Utilities::$REQUIRED, Utilities::$EMPTY, false);
        $checksum_key = Utilities::exists($this->request->data, 'checksum_key', Utilities::$REQUIRED, Utilities::$EMPTY, false);
        
        $code = Utilities::exists($this->request->data, 'code', Utilities::$REQUIRED, Utilities::$EMPTY, false);
        $captcha_code = Utilities::exists($this->request->data, 'captcha_code', Utilities::$NOT_REQUIRED, Utilities::$EMPTY, false);
        
        
        /*
         * Se obtiene el servicio asociado
         */
        $service = $this->Service->findById($service_id);

        if(empty($service)){
            $this->IpAddressAccessAttempt->attempt();
            throw new UnauthorizedException(ResponseStatus::$access_denied);
        }
        
        /*
         * Si la ip del request esta bloqueada, revisamos si el captcha coincide
         */
        if($this->IpAddressAccessAttempt->isIpAddressBlocked()){
            
            if(!$this->IpAddressAccessAttempt->unblock($captcha_code)){
                /*
                 * Se hace un redirect indicando el id del formulario
                 */

                $this->redirect($service['Service']['login_url'] . '?' . http_build_query(array('FormId' => $form_id)));
            }
            
        }         
                
        /*
         * Se crea un recibidor seguro de mensajes y desencriptamos el checksum
         */
        $spr = new SecureReceiver();
        $spr->setSenderPublicKey($service['Partner']['public_key']);
        $spr->setRecipientPrivateKey(Configure::read('KonalenPrivateKey'));

        $checksum_key_decrypted = $spr->decrypt($checksum_key);        
 
        if(empty($checksum_key_decrypted)){
            $this->IpAddressAccessAttempt->attempt();
            throw new UnauthorizedException(ResponseStatus::$access_denied);
        }
        
        
        /*
         * Se verifica que el checksum corresponda a la data enviada
         */
        if(hash_hmac('sha256', implode('.', array($form_id, $service_id, $transaction_id)), $checksum_key_decrypted) !== $checksum){
            $this->log("El checksum no coincide!!");
            $this->IpAddressAccessAttempt->attempt();
            throw new UnauthorizedException(ResponseStatus::$access_denied);   
        }        
        
        
        $service_form = $this->ServiceForm->getForm($form_id);
  
        if(empty($service_form)){
            /*
             * Hacemos un redirect a la pagina de login del partner
             */
            $this->redirect($service['Service']['login_url']);

        }else{
            
            $account_id = $service_form['ServiceForm']['two_step_auth_account_id'];
            
            /*
             * Se verifica si existe una notificacion con el codigo entregado
             */
            
            $notification = $this->Notification->find('first', array(
                'conditions' => array(
                    'Notification.account_id' => $account_id,
                    'Notification.data' => $code,
                    'Notification.status' => Notification::$STATUS_DELIVERED,
                    'Notification.action' => Notification::$ACTION_LOGIN
                )
            ));
        
            if(empty($notification)){
                
                $this->IpAddressAccessAttempt->attempt();
                
                
                $service_form['ServiceForm']['data'] = array(
                    'message' => "Fecha: " . date("Y-m-d H:i:s"),
                    'error' => 'Codigo Incorrecto'
                );

                if(!$this->ServiceForm->save($service_form)){
                    $this->log("Error al guardar en la BD");
                }                
                
                /*
                 * Se hace un redirect indicando el id del formulario
                 */

                $this->redirect($service['Service']['login_url'] . '?' . http_build_query(array('FormId' => $form_id)));
                

            }else{
        
                $account = $this->Account->find('first', array(
                    'conditions' => array(
                        'Account.id' => $account_id,
                        'Account.active' => 1,
                        'Account.service_id' => $service_id
                    ),
                    'recursive' => 0
                ));

                if(empty($account)){
                    $this->IpAddressAccessAttempt->attempt();
                    throw new UnauthorizedException(ResponseStatus::$access_denied);
                }        

                /*
                 * El acceso es exitoso por lo tanto se crea un registro  de acceso de usuario
                 */
                $account_access = $this->AccountAccess->createAccess($account);

                //Dado que el ingreso fue exitoso, reseteamos los valores de intento de acceso
                $this->IpAddressAccessAttempt->reset();        

                /*
                 * Creamos un mensajero seguro para enviar la data del usuario de acceso exitoso
                 */
                $sps = new SecureSender();
                $sps->setRecipientPublicKey($service['Partner']['public_key']);
                $sps->setSenderPrivateKey(Configure::read('KonalenPrivateKey'));

                $data = array(
                    'user' => $account_access,
                    'transaction_id' => $transaction_id
                );

                /*
                 * Redireccionamos a la pagina de login exitoso del partner enviando la data encryptada
                 */
                $this->redirect($service['Service']['login_success'] . '?' . http_build_query(array('data' => $sps->encrypt($data))));

            }
        }
      
    }
    
    public function checklogin(){
        
        $this->autoLayout = false;
        //$this->autoRender = false;
        
        $form_id = Utilities::exists($this->request->data, 'form_id', Utilities::$REQUIRED, Utilities::$NOT_EMPTY, false);
        $service_id = Utilities::exists($this->request->data, 'service_id', Utilities::$REQUIRED, Utilities::$NOT_EMPTY, false);
        $transaction_id = Utilities::exists($this->request->data, 'transaction_id', Utilities::$REQUIRED, Utilities::$NOT_EMPTY, false);

        $checksum = Utilities::exists($this->request->data, 'checksum', Utilities::$REQUIRED, Utilities::$NOT_EMPTY, false);
        $checksum_key = Utilities::exists($this->request->data, 'checksum_key', Utilities::$REQUIRED, Utilities::$NOT_EMPTY, false);

        $user_id = Utilities::exists($this->request->data, 'user_id', Utilities::$REQUIRED, Utilities::$EMPTY, false);
        $user_pass = Utilities::exists($this->request->data, 'user_pass', Utilities::$REQUIRED, Utilities::$EMPTY, false);
        $captcha_code = Utilities::exists($this->request->data, 'captcha_code', Utilities::$NOT_REQUIRED, Utilities::$EMPTY, false);
        
        /*
         * Se obtiene el servicio asociado
         */
        $service = $this->Service->findById($service_id);

        if(empty($service)){
            $this->IpAddressAccessAttempt->attempt();
            throw new UnauthorizedException(ResponseStatus::$access_denied);
        }
        
        
        /*
         * Si la ip del request esta bloqueada, revisamos si el captcha coincide
         */
        if($this->IpAddressAccessAttempt->isIpAddressBlocked()){
            
            if(!$this->IpAddressAccessAttempt->unblock($captcha_code)){
                /*
                 * Hacemos un redirect a la pagina de login del partner
                 */
                $this->redirect($service['Service']['login_url']);
            }
            
        }         
                
        
        
        /*
         * Se crea un recibidor seguro de mensajes y desencriptamos el checksum
         */
        $spr = new SecureReceiver();
        $spr->setSenderPublicKey($service['Partner']['public_key']);
        $spr->setRecipientPrivateKey(Configure::read('KonalenPrivateKey'));

        $checksum_key_decrypted = $spr->decrypt($checksum_key);        
 
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
                
        $service_form = $this->ServiceForm->getForm($form_id);
  
        if(empty($service_form)){
            /*
             * Hacemos un redirect a la pagina de login del partner
             */
            $this->redirect($service['Service']['login_url']);
            
        }else{
            
            /*
             * Se chequea los datos de acceso
             * en caso de exito se redirecciona a la url de login success del partner
             */

            $account_identity = $this->Account->login($service, $user_id, $user_pass);
            
            if($account_identity){

                
                $this->log($account_identity);
                
                if($service['Service']['two_step_auth'] == 1){
                    
                    /*
                     * Si esta activado la verificacion de dos pasos
                     */

                    /*
                     * Se debe obtener el tipo de la notificacion, en particular el canal por el cual sera enviada la notificacion
                     * si esta asociado un 
                     * 
                     */
                    
                    $account_id = $account_identity['AccountIdentity']['account_id'];
                    
                    /*
                     * Se obtiene el medio por el cual se enviara el codigo de autentificacion
                     */
                    
                    $notification_type = $this->Account->getTwoStepNotificationType($account_id);
                    
                    
                    if($notification_type){
                    
                        $code = mt_rand(10000, 99999);

                        $this->Notification->createNotification($account_identity, $code, Notification::$STATUS_PENDING, Notification::$ACTION_LOGIN, $notification_type);

                        /*
                         * Se define el 
                         */
                        $service_form['ServiceForm']['two_step_auth'] = 1;
                        $service_form['ServiceForm']['two_step_auth_account_id'] = $account_id;
                        
                        if(!$this->ServiceForm->save($service_form)){
                            $this->log("Ocurrio un error!!");
                        }
                        
                        /*
                         * Se hace un redirect indicando el id del formulario
                         */

                        $this->redirect($service['Service']['login_url'] . '?' . http_build_query(array('FormId' => $form_id)));

                    }else{
                        $this->log("No existe medio para enviar el codigo de autorizacion en la cuenta de id: " . $account_id);
                    }
                    
                }else{
                    
                    
                    /*
                     * El acceso es exitoso por lo tanto se crea un registro  de acceso de usuario
                     */
                    $account_access = $this->AccountAccess->createAccess($service);

                    /*
                     * Creamos un mensajero seguro para enviar la data del usuario de acceso exitoso
                     */
                    $sps = new SecureSender();
                    $sps->setRecipientPublicKey($service['Partner']['public_key']);
                    $sps->setSenderPrivateKey(Configure::read('KonalenPrivateKey'));

                    $data = array(
                        'user' => false,
                        'transaction_id' => $transaction_id
                    );

                    /*
                     * Redireccionamos a la pagina de login exitoso del partner enviando la data encryptada
                     */
                    $this->redirect($service['Service']['login_success'] . '?' . http_build_query(array('data' => $sps->encrypt($data))));
                    
                    
                }
                

                         
            }else{
                
                $service_form['ServiceForm']['data'] = array(
                    'message' => "Fecha: " . date("Y-m-d H:i:s"),
                    'error' => 'Login Error'
                );

                if(!$this->ServiceForm->save($service_form)){
                    $this->log("Error al guardar en la BD");
                }
                
                
                /*
                 * Se hace un redirect indicando el id del formulario
                 */

                $this->redirect($service['Service']['login_url'] . '?' . http_build_query(array('FormId' => $form_id)));
                
            }
            
        }
        
    }

}
