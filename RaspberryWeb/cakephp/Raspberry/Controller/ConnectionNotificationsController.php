<?php
App::uses('AppController', 'Controller');
/**
 * ConnectionNotifications Controller
 *
 * @property ConnectionNotification $ConnectionNotification
 * @property PaginatorComponent $Paginator
 */
class ConnectionNotificationsController extends AppController {

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
		$this->ConnectionNotification->recursive = 0;
		$this->set('connectionNotifications', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ConnectionNotification->exists($id)) {
			throw new NotFoundException(__('Invalid connection notification'));
		}
		$options = array('conditions' => array('ConnectionNotification.' . $this->ConnectionNotification->primaryKey => $id));
		$this->set('connectionNotification', $this->ConnectionNotification->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ConnectionNotification->create();
			if ($this->ConnectionNotification->save($this->request->data)) {
				$this->Session->setFlash(__('The connection notification has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The connection notification could not be saved. Please, try again.'));
			}
		}
		$notifications = $this->ConnectionNotification->Notification->find('list');
		$connections = $this->ConnectionNotification->Connection->find('list');
		$this->set(compact('notifications', 'connections'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ConnectionNotification->exists($id)) {
			throw new NotFoundException(__('Invalid connection notification'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ConnectionNotification->save($this->request->data)) {
				$this->Session->setFlash(__('The connection notification has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The connection notification could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ConnectionNotification.' . $this->ConnectionNotification->primaryKey => $id));
			$this->request->data = $this->ConnectionNotification->find('first', $options);
		}
		$notifications = $this->ConnectionNotification->Notification->find('list');
		$connections = $this->ConnectionNotification->Connection->find('list');
		$this->set(compact('notifications', 'connections'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ConnectionNotification->id = $id;
		if (!$this->ConnectionNotification->exists()) {
			throw new NotFoundException(__('Invalid connection notification'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ConnectionNotification->delete()) {
			$this->Session->setFlash(__('The connection notification has been deleted.'));
		} else {
			$this->Session->setFlash(__('The connection notification could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
