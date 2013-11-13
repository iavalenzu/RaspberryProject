<?php

App::uses('AppController', 'Controller');


/**
 * Description of LoginFormsController
 *
 * @author Ismael Valenzuela <iavalenzu@gmail.com>
 */
class LoginFormsController extends AppController {

    
    public function viewLogin(){
        
        $this->autoRender = false;
        $this->autoLayout = false;
        
        $this->render("/Users/loginform");
        
    }
    
    
}

?>
