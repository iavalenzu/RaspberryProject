<?php

App::uses('AppController', 'Controller');

/**
 * Devices Controller
 *
 * @property Device $Device
 * @property PaginatorComponent $Paginator
 */
class DevicesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');
    public $uses = array('Device', 'DevicesNotification', 'Notification');

    
    public function websocket(){
        $this->autoLayout = false;
        
    }
    
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Device->recursive = 0;
        $this->set('devices', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Device->exists($id)) {
            throw new NotFoundException(__('Invalid device'));
        }
        $options = array('conditions' => array('Device.' . $this->Device->primaryKey => $id));
        $this->set('device', $this->Device->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Device->create();
            if ($this->Device->save($this->request->data)) {
                $this->Session->setFlash(__('The device has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The device could not be saved. Please, try again.'));
            }
        }
        $users = $this->Device->User->find('list');
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
        if (!$this->Device->exists($id)) {
            throw new NotFoundException(__('Invalid device'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Device->save($this->request->data)) {
                $this->Session->setFlash(__('The device has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The device could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Device.' . $this->Device->primaryKey => $id));
            $this->request->data = $this->Device->find('first', $options);
        }
        $users = $this->Device->User->find('list');
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
        $this->Device->id = $id;
        if (!$this->Device->exists()) {
            throw new NotFoundException(__('Invalid device'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Device->delete()) {
            $this->Session->setFlash(__('The device has been deleted.'));
        } else {
            $this->Session->setFlash(__('The device could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->Device->recursive = 0;
        $this->set('devices', $this->Paginator->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        if (!$this->Device->exists($id)) {
            throw new NotFoundException(__('Invalid device'));
        }
        $options = array('conditions' => array('Device.' . $this->Device->primaryKey => $id));
        $this->set('device', $this->Device->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Device->create();
            if ($this->Device->save($this->request->data)) {
                $this->Session->setFlash(__('The device has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The device could not be saved. Please, try again.'));
            }
        }
        $users = $this->Device->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        if (!$this->Device->exists($id)) {
            throw new NotFoundException(__('Invalid device'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Device->save($this->request->data)) {
                $this->Session->setFlash(__('The device has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The device could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Device.' . $this->Device->primaryKey => $id));
            $this->request->data = $this->Device->find('first', $options);
        }
        $users = $this->Device->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        $this->Device->id = $id;
        if (!$this->Device->exists()) {
            throw new NotFoundException(__('Invalid device'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Device->delete()) {
            $this->Session->setFlash(__('The device has been deleted.'));
        } else {
            $this->Session->setFlash(__('The device could not be deleted. Please, try again.'));
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

    public function sendNotification($id = null) {

        $device = $this->Device->findById($id);
        
        if (empty($device)) {
            throw new NotFoundException(__('Invalid device'));
        }
        
        $this->set('device', $device);

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
            $this->request->data['Notification']['status'] = "0";

            if ($this->Notification->save($this->request->data)) {

                $device_notification = array(
                    'notification_id' => $this->Notification->id,
                    'device_id' => $device['Device']['id'],
                    'status' => $this->DevicesNotification->status_pending
                );

                $this->DevicesNotification->create();
                if ($this->DevicesNotification->save($device_notification)) {

                    $notification = array(
                        'Id' => $this->Notification->id,
                        'Action' => $this->request->data['Notification']['action'],
                        'Data' => $data
                    );

                    if($this->writeNotification($device['Device']['output_fifo_name'], $notification)){
                        $this->Session->setFlash(__('Se ha enviado la notificacion.'));
                    }else{    
                        $this->Session->setFlash(__('Ha ocurrido un error. Por favor, intenta nuevamente.'));
                    }
                }
            } else {
                $this->Session->setFlash(__('The notification could not be sent, Please, try again.'));
            }
        }
    }

}
