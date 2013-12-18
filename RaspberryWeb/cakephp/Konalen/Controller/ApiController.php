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

        $this->autoLayout = false;
        
        //Se obtienen las credenciales de autentificacion de konalen
        $konalen_user = Utilities::exists($this->request->query, 'User', true, true, false);
        $konalen_key = Utilities::exists($this->request->query, 'Key', true, true, false);
        $konalen_service_id = Utilities::exists($this->request->query, 'Service', true, true, false);
        
        $partner = $this->Partner->checkCredentials($konalen_user, $konalen_key);

        $service = $this->Service->getService($partner, $konalen_service_id);
        
        $service_form = $this->ServiceForm->createForm($service);
        
        /*
        
        $konalen_user = Utilities::exists($this->request->data, 'form_id', true, true, false);
        $user_id = Utilities::exists($this->request->data, 'user_id', true, true, false);
        $user_pass = Utilities::exists($this->request->data, 'user_pass', true, true, false);
        */
        
        
        $this->set('service_form', $service_form);
        
    }

    public function checklogin(){
        
        $this->autoLayout = false;
        $this->autoRender = false;
        
        $form_id = Utilities::exists($this->request->data, 'form_id', true, true, false);
        $user_id = Utilities::exists($this->request->data, 'user_id', true, true, false);
        $user_pass = Utilities::exists($this->request->data, 'user_pass', true, true, false);
         
        $form = $this->ServiceForm->findByFormId($form_id);

        if(empty($form)){
            
        }
            
        
        
        $identity = $this->Identity->findByIdentificator($user_id);
        
        if(empty($identity)){
            //Escribimos un login error
        }
        
        debug($identity);
        
        
        
        
    }
    

}
