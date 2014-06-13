<?php

App::uses('AppController', 'Controller');

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
    public $components = array('Paginator');
    public $uses = array('Connection', 'User', 'ConnectionNotification', 'Notification');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->Paginator->paginate('User'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
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

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
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

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
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

    public function writeNotification($fifo_name = null, $notification = null) {

        if (is_null($fifo_name) || is_null($notification))
            return false;

        $fifo = fopen("/Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServerNonBlocking/" . $fifo_name, 'w');

        if ($fifo) {
            if (fwrite($fifo, json_encode($notification))) {
                return true;
            }
            fclose($fifo);
        }

        return false;
    }

    public function sendNotification($user_id = null) {

        $active_connections = $this->Connection->find('all', array(
            'conditions' => array(
                'Connection.user_id' => $user_id,
                'Connection.status' => 'ACTIVE'
            ),
            'recursive' => -1
        ));

        $this->set('active_connections', $active_connections);

        if (!empty($this->request->data)) {

            $data = array();

            foreach ($this->request->data['Notification']['data'] as $item) {

                if (!empty($item['Name'])) {

                    if ($item['Name'] == "Pins") {
                        $data[strtoupper($item['Name'])] = json_decode($item['Value'], true);
                    } else {
                        $data[strtoupper($item['Name'])] = $item['Value'];
                    }
                }
            }

            $this->request->data['Notification']['data'] = json_encode($data);
            $this->request->data['Notification']['status'] = "";


            if ($this->Notification->save($this->request->data)) {

                foreach ($active_connections as $active_connection) {

                    $connections_notification = array(
                        'notification_id' => $this->Notification->id,
                        'connection_id' => $active_connection['Connection']['id'],
                        'status' => 'PENDING'
                    );

                    $this->ConnectionNotification->create();
                    if ($this->ConnectionNotification->save($connections_notification)) {

                        $notification = array(
                            'Id' => $this->Notification->id,
                            'Action' => $this->request->data['Notification']['action'],
                            'Data' => $data
                        );

                        $this->writeNotification($active_connection['Connection']['fifo_name'], $notification);
                    }
                }
            } else {
                $this->Session->setFlash(__('The notification could not be sent, Please, try again.'));
            }
        }
    }

}
