<?php
App::uses('AppController', 'Controller');
/**
 * DevicesNotifications Controller
 *
 * @property DevicesNotification $DevicesNotification
 * @property PaginatorComponent $Paginator
 */
class DevicesNotificationsController extends AppController {

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
		$this->DevicesNotification->recursive = 0;
		$this->set('devicesNotifications', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DevicesNotification->exists($id)) {
			throw new NotFoundException(__('Invalid devices notification'));
		}
		$options = array('conditions' => array('DevicesNotification.' . $this->DevicesNotification->primaryKey => $id));
		$this->set('devicesNotification', $this->DevicesNotification->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DevicesNotification->create();
			if ($this->DevicesNotification->save($this->request->data)) {
				$this->Session->setFlash(__('The devices notification has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The devices notification could not be saved. Please, try again.'));
			}
		}
		$notifications = $this->DevicesNotification->Notification->find('list');
		$devices = $this->DevicesNotification->Device->find('list');
		$this->set(compact('notifications', 'devices'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->DevicesNotification->exists($id)) {
			throw new NotFoundException(__('Invalid devices notification'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DevicesNotification->save($this->request->data)) {
				$this->Session->setFlash(__('The devices notification has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The devices notification could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DevicesNotification.' . $this->DevicesNotification->primaryKey => $id));
			$this->request->data = $this->DevicesNotification->find('first', $options);
		}
		$notifications = $this->DevicesNotification->Notification->find('list');
		$devices = $this->DevicesNotification->Device->find('list');
		$this->set(compact('notifications', 'devices'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->DevicesNotification->id = $id;
		if (!$this->DevicesNotification->exists()) {
			throw new NotFoundException(__('Invalid devices notification'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DevicesNotification->delete()) {
			$this->Session->setFlash(__('The devices notification has been deleted.'));
		} else {
			$this->Session->setFlash(__('The devices notification could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->DevicesNotification->recursive = 0;
		$this->set('devicesNotifications', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->DevicesNotification->exists($id)) {
			throw new NotFoundException(__('Invalid devices notification'));
		}
		$options = array('conditions' => array('DevicesNotification.' . $this->DevicesNotification->primaryKey => $id));
		$this->set('devicesNotification', $this->DevicesNotification->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->DevicesNotification->create();
			if ($this->DevicesNotification->save($this->request->data)) {
				$this->Session->setFlash(__('The devices notification has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The devices notification could not be saved. Please, try again.'));
			}
		}
		$notifications = $this->DevicesNotification->Notification->find('list');
		$devices = $this->DevicesNotification->Device->find('list');
		$this->set(compact('notifications', 'devices'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->DevicesNotification->exists($id)) {
			throw new NotFoundException(__('Invalid devices notification'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DevicesNotification->save($this->request->data)) {
				$this->Session->setFlash(__('The devices notification has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The devices notification could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DevicesNotification.' . $this->DevicesNotification->primaryKey => $id));
			$this->request->data = $this->DevicesNotification->find('first', $options);
		}
		$notifications = $this->DevicesNotification->Notification->find('list');
		$devices = $this->DevicesNotification->Device->find('list');
		$this->set(compact('notifications', 'devices'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->DevicesNotification->id = $id;
		if (!$this->DevicesNotification->exists()) {
			throw new NotFoundException(__('Invalid devices notification'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DevicesNotification->delete()) {
			$this->Session->setFlash(__('The devices notification has been deleted.'));
		} else {
			$this->Session->setFlash(__('The devices notification could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
