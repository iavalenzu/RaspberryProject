<?php

debug($service_form);

echo $this->Form->create(null);
echo $this->Form->input('password');
echo $this->Form->hidden(null, array('name' => 'form_id', 'value' => $service_form['ServiceForm']['form_id']));
echo $this->Form->end();

?>