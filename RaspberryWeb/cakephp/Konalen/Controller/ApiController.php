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
    public $uses = array('Partner');

    public function beforeFilter() {
        parent::beforeFilter();
        
        $partner = $this->Partner->getAuthorizedPartner();
        
        debug($partner);
        
        
        
    }
    
    public function register(){
        
        $this->autoLayout = false;
        $this->autoRender = false;
        
        
        
    }
    

}
