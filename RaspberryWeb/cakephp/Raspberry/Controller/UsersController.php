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

    public function testExec($pid) {

        $cmd = "kill -SIGCONT " . $pid;
        
        debug($cmd);
        
        //$return = exec("ls .", $output, $return2);
        //$return = exec($cmd, $output, $return2);
        $return = system($cmd, $output);



        debug($return);
        debug($output);
        debug($return2);
    }

    public function sendSignals($active_connections = null) {

        if (empty($active_connections))
            return;

        foreach ($active_connections as $active_connection) {

            $pid = $active_connection['Connection']['pid'];

            if (!empty($pid)) {
                //Se hace la llamada enviando SIGCONT a cada proceso

                debug("Llamando: kill -SIGCONT " . $pid);

                $return = exec("/bin/kill -SIGCONT " . $pid, $output, $return2);

                debug($return);
                debug($output);
                debug($return2);
            }
        }
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

            if ($this->Notification->save($this->request->data)) {

                $connections_notifications = array();

                foreach ($active_connections as $active_connection) {
                    $connections_notifications[] = array(
                        'notification_id' => $this->Notification->id,
                        'connection_id' => $active_connection['Connection']['id'],
                        'status' => 'PENDING'
                    );
                }

                if ($this->ConnectionNotification->saveMany($connections_notifications)) {

                    $this->sendSignals($active_connections);

                    $this->Session->setFlash(__('Notification enviada'));
                } else {
                    $this->Session->setFlash(__('The notification could not be sent, Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The notification could not be deleted, Please, try again.'));
            }
        }
    }

}
