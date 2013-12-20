<?php

print_r($form_data['message']);
print_r($form_data['error']);

echo $this->Form->create(null, array(
    'url' => array('controller' => 'api', 'action' => 'checklogin'),
    'type' => 'post',
    'target' => '_parent'
));
echo $this->Form->input(null, array('name' => 'user_id', 'label' => 'User', 'value'=>'iavalenzu'));
echo $this->Form->input(null, array('name' => 'user_pass', 'label' => 'Password', 'type' => 'password', 'value'=>'password'));
echo $this->Form->hidden(null, array('name' => 'form_id', 'value' => $form_id));
echo $this->Form->hidden(null, array('name' => 'service_id', 'value' => $service_id));
echo $this->Form->hidden(null, array('name' => 'form_checksum', 'value' => $form_checksum));
echo $this->Form->end('Acceder');

?>