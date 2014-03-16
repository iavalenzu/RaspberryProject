<?php
App::uses('AppController', 'Controller');
/**
 * Connections Controller
 *
 * @property Connection $Connection
 * @property PaginatorComponent $Paginator
 */
class ConnectionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Connection->recursive = 0;
		$this->set('connections', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Connection->exists($id)) {
			throw new NotFoundException(__('Invalid connection'));
		}
		$options = array('conditions' => array('Connection.' . $this->Connection->primaryKey => $id));
		$this->set('connection', $this->Connection->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Connection->create();
			if ($this->Connection->save($this->request->data)) {
				$this->Session->setFlash(__('The connection has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The connection could not be saved. Please, try again.'));
			}
		}
		$users = $this->Connection->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Connection->exists($id)) {
			throw new NotFoundException(__('Invalid connection'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Connection->save($this->request->data)) {
				$this->Session->setFlash(__('The connection has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The connection could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Connection.' . $this->Connection->primaryKey => $id));
			$this->request->data = $this->Connection->find('first', $options);
		}
		$users = $this->Connection->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Connection->id = $id;
		if (!$this->Connection->exists()) {
			throw new NotFoundException(__('Invalid connection'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Connection->delete()) {
			$this->Session->setFlash(__('The connection has been deleted.'));
		} else {
			$this->Session->setFlash(__('The connection could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
