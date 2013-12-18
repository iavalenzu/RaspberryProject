<?php

App::uses('AppController', 'Controller');
App::import('Lib', 'Utilities');

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
    public $uses = array('User', 'Partner', 'Identity', 'Service', 'ServiceForm');

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
        
        $partner = $this->Partner->checkCredentials($konalen_user, $konalen_key);

        $service = $this->Service->getService($partner, $konalen_service_id);
        
        $service_form = $this->ServiceForm->createForm($service);

        $service_id =  $service['Service']['id'];
        $form_id = $service_form['ServiceForm']['form_id']; 
        $form_checksum = Utilities::checksum(array($form_id, $service_id));
      
        $this->set('form_id', $form_id);
        $this->set('service_id', $service_id);
        $this->set('form_checksum', $form_checksum);
       
       
       
       
    }

    public function checklogin(){
        
        $this->autoLayout = false;
        $this->autoRender = false;
        
        $service_id = Utilities::exists($this->request->data, 'service_id', true, true, false);
        $form_id = Utilities::exists($this->request->data, 'form_id', true, true, false);
        $user_id = Utilities::exists($this->request->data, 'user_id', true, true, false);
        $user_pass = Utilities::exists($this->request->data, 'user_pass', true, true, false);
        
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
        }
        
        debug($service_form);
        
        
    }
    

}
