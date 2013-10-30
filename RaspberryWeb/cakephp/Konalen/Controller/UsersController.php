<?php
App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');

App::import('Lib', 'Utilities');
App::import('Lib', 'ResponseStatus');



/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'RequestHandler');

        public $uses = array('User', 'Partner', 'UserPartner');
        
        public function beforeFilter() {
            parent::beforeFilter();

            //$this->autoLayout = false;

        }
        
        //curl --request POST --data '{"email":"iavalenzu@gmail.com", "password": "holas"}' -H 'Authorization:key=03nh5IvWhvz04OkSZLJ21S0LBLUEFUpbSY2gHoJE9aaugahT07NvY6JoziB6f0d6i476l5' -H 'Content-Type:application/json' -v "http://localhost/sandbox/cakephp/Konalen/users/register.json"

        public function register() {
            
            $authorizedPartner = $this->Partner->getAuthorizedPartner();
            
            //Se obtiene la data correspondiente al nuevo usuario
            $post_data = Utilities::getRawPostData(true);

            //Se obtienen los parametros
            $email = Utilities::exists($post_data, 'email', true, false);
            $password = Utilities::exists($post_data, 'password', true, false);
            
            $response = $this->UserPartner->register($email, $password, $authorizedPartner);
   
            $this->set('response', $response);
            $this->set('_serialize', array('response'));
            
        }
        
        public function login(){
            
            $authorizedPartner = $this->Partner->getAuthorizedPartner();

            //Se obtiene la data correspondiente al nuevo usuario
            $post_data = Utilities::getRawPostData(true);

            //Se obtienen los parametros
            $email = Utilities::exists($post_data, 'email', true, false);
            $password = Utilities::exists($post_data, 'password', true, false);
            $user_agent = Utilities::exists($post_data, 'user_agent', true, false);
            $user_ip_address = Utilities::exists($post_data, 'ip_address', true, false);
            $recaptcha_challenge_field = Utilities::exists($post_data, 'recaptcha_challenge_field', false, false);
            $recaptcha_response_field = Utilities::exists($post_data, 'recaptcha_response_field', false, false);
            
            $response = $this->UserPartner->login($email, $password, $user_agent, $user_ip_address, $authorizedPartner, $recaptcha_challenge_field, $recaptcha_response_field);
            
            $this->set('response', $response);
            $this->set('_serialize', array('response'));
            
        }
        
        public function activate(){
            
            $this->autoLayout = false;
            
            //Se obtienen los parametros
            $code = Utilities::exists($this->request->query, 'code', true, false);
            
            $response = $this->UserPartner->activate($code);
            
            if($response['msg'] == ResponseStatus::$activation_success){
                
                if(isset($response['data']['redirect_url'])){

                    $url = $response['data']['redirect_url'];
                    unset($response['data']['redirect_url']);
                    $url = $url . "?" . http_build_query($response);

                    $this->redirect($url);

                }
                
            }
            
        }
        
        public function setpreferences(){
            
            
            
        }
        
        public function changepassword(){
            
            $authorizedPartner = $this->Partner->getAuthorizedPartner();

            //Se obtiene la data correspondiente al nuevo usuario
            $post_data = Utilities::getRawPostData(true);

            //Se obtienen los parametros
            $session_id = Utilities::exists($post_data, 'session_id', true, false);
            $new_password = Utilities::exists($post_data, 'new_password', true, false);
            
            $response = $this->UserPartner->changepassword($session_id, $new_password, $authorizedPartner);
            
            $this->set('response', $response);
            $this->set('_serialize', array('response'));
            
            
        }
        public function forgotpassword(){
            
        }

        
        
        public function myredirect(){
            
            debug($this->request);
            
        }
        
        
	
        

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/*        
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}
*/
/**
 * add method
 *
 * @return void
 */
/*	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}
*/
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/*	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}
*/
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/*	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
*/
/**
 * admin_index method
 *
 * @return void
 */
/*	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}
*/
/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/*	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}
*/
/**
 * admin_add method
 *
 * @return void
 */
/*	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}
*/
/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/*	public function admin_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}
*/
/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/*	public function admin_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
 */ 
 }
