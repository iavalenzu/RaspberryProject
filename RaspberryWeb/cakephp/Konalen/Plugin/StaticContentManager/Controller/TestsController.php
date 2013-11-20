<?

App::uses('StaticContentManagerAppController', 'StaticContentManager.Controller');

/* 
  App::uses('Security', 'Utility');
App::import('Lib', 'Utilities');
App::import('Lib', 'ResponseStatus');
App::import('Lib', 'SimpleCaptcha/SimpleCaptcha');
*/

class TestsController extends StaticContentManagerAppController {

    
    public $helpers = array('StaticContentManager.StaticContent');

    public function index(){
        
        $this->autoLayout = false;
        
        
        
    }
    
    
}


?>