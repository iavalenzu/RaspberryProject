<?php

App::uses('AppController', 'Controller');
App::import('Lib', 'Utilities');

App::import('Lib', 'SecurePacket');
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
    public $uses = array('User', 'Partner', 'Identity', 'Service', 'ServiceForm', 'Account');

    public function beforeFilter() {
        parent::beforeFilter();
        
        
        //debug($partner);
        
        
        
        
    }
    
    public function register(){
        
        $this->autoLayout = false;
        $this->autoRender = false;
        
    }
    
    public function loginform(){
        
        $this->Components->unload('DebugKit.Toolbar');

        $this->layout = 'api';
        
        //Se obtienen las credenciales de autentificacion de konalen
        $konalen_user = Utilities::exists($this->request->query, 'User', true, true, false);
        $konalen_key = Utilities::exists($this->request->query, 'Key', true, true, false);
        $konalen_service_id = Utilities::exists($this->request->query, 'Service', true, true, false);
        $form_id = Utilities::exists($this->request->query, 'FormId', true, true, false);

        
        $partner = $this->Partner->checkCredentials($konalen_user, $konalen_key);

        $service = $this->Service->getService($partner, $konalen_service_id);
        
        /*
         * Se obtiene el form asociado al id
         */
        $service_form = $this->ServiceForm->getForm($form_id);
        
        if(empty($service_form)){
            $service_form = $this->ServiceForm->createForm($service);
        }

        $service_id =  $service['Service']['id'];
        $form_id = $service_form['ServiceForm']['form_id'];
        $form_data = $service_form['ServiceForm']['data'];
        $form_checksum = Utilities::checksum(array($form_id, $service_id));
      
        $this->set('form_id', $form_id);
        $this->set('form_data', $form_data);
        $this->set('service_id', $service_id);
        $this->set('form_checksum', $form_checksum);
       
    }

    public function checklogin(){
        
        $this->autoLayout = false;
        $this->autoRender = false;
        
        $service_id = Utilities::exists($this->request->data, 'service_id', true, true, false);
        $form_id = Utilities::exists($this->request->data, 'form_id', true, true, false);
        $form_checksum = Utilities::exists($this->request->data, 'form_checksum', true, true, false);
        $user_id = Utilities::exists($this->request->data, 'user_id', true, true, false);
        $user_pass = Utilities::exists($this->request->data, 'user_pass', true, true, false);

        /*
         * Se verifica si el checksum es correcto
         */
        if(Utilities::checksum(array($form_id, $service_id)) != $form_checksum){
            throw new UnauthorizedException(ResponseStatus::$access_denied);
        }
        
        $service = $this->Service->findById($service_id);

        if(empty($service)){
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

            $response = $this->Account->login($service, $user_id, $user_pass);
            
            if($response['success'] === true){

                /*
                 * Creamos un mensajero seguro para enviar la data del usuario de acceso exitoso
                 */
                $sps = new SecureSender();
                $sps->setRecipientPublicKey($service['Partner']['public_key']);
                $sps->setSenderPrivateKey(Configure::read('KonalenPrivateKey'));

                $packet = new LoginPacket($response);
                
                /*
                 * Redireccionamos a la pagina de login exitoso del partner enviando la data encryptada
                 */
                $this->redirect($service['Service']['login_success'] . '?' . http_build_query(array('data' => $sps->encrypt($packet))));
                
            }else{
                
                $service_form['ServiceForm']['data'] = array(
                    'message' => "Fecha: " . date("Y-m-d H:i:s"),
                    'error' => $response['error']
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
