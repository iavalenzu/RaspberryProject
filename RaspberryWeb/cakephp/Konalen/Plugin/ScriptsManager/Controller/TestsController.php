<?

App::uses('ScriptsManagerAppController', 'ScriptsManager.Controller');

/* 
  App::uses('Security', 'Utility');
App::import('Lib', 'Utilities');
App::import('Lib', 'ResponseStatus');
App::import('Lib', 'SimpleCaptcha/SimpleCaptcha');
*/

class TestsController extends ScriptsManagerAppController {

    
    public $helpers = array('ScriptsManager.Script');

    public function index(){
        
        $this->autoLayout = false;
        
        
        
    }
    
    
}


?>