<?php

//debug($service_form);



echo $this->Form->create(null, array(
    'url' => array('controller' => 'api', 'action' => 'checklogin'),
    'type' => 'post'
));
echo $this->Form->input(null, array('name' => 'user_id', 'label' => 'User'));
echo $this->Form->input(null, array('name' => 'user_pass', 'label' => 'Password', 'type' => 'password'));
echo $this->Form->hidden(null, array('name' => 'form_id', 'value' => $form_id));
echo $this->Form->hidden(null, array('name' => 'service_id', 'value' => $service_id));
echo $this->Form->hidden(null, array('name' => 'form_checksum', 'value' => $form_checksum));
echo $this->Form->end('Acceder');

?>