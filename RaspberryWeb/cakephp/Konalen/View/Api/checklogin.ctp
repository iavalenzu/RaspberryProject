<?php

if(!empty($service_id) && !empty($account_identity_id) && !empty($transaction_id) && !empty($checksum) && !empty($checksum_key) ){

echo $this->Form->create(null, array(
    'url' => array('controller' => 'api', 'action' => 'checkcode'),
    'type' => 'post'
));
echo $this->Form->input(null, array('name' => 'code', 'label' => 'Code', 'value'=>''));
echo $this->Form->hidden(null, array('name' => 'service_id', 'value'=> $service_id));
echo $this->Form->hidden(null, array('name' => 'account_identity_id', 'value'=> $account_identity_id));
echo $this->Form->hidden(null, array('name' => 'transaction_id', 'value'=> $transaction_id));
echo $this->Form->hidden(null, array('name' => 'checksum', 'value'=> $checksum));
echo $this->Form->hidden(null, array('name' => 'checksum_key', 'value'=> $checksum_key));

echo $this->Form->end('Enviar');

}

?>