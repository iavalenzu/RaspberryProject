<?php

if(isset($two_step_auth_form) && $two_step_auth_form){
    
    print_r($form_data['message']);
    print_r($form_data['error']);
    
    
    echo $this->Form->create(null, array(
        'url' => array('controller' => 'api', 'action' => 'checkcode'),
        'type' => 'post',
        'target' => '_parent'
    ));
    
    /*
     * Campos Editables
     */
    
    echo $this->Form->input(null, array('name' => 'code', 'label' => 'Code', 'value'=>''));
    
    if(isset($captcha_code)){
        echo $this->Captcha->image($captcha_code);
        echo $this->Form->input(null, array('name' => 'captcha_code', 'label' => 'Captcha', 'value' => ''));
    }
    
    /*
     * Identificadores
     */
    
    echo $this->Form->hidden(null, array('name' => 'service_id', 'value'=> $service_id));
    echo $this->Form->hidden(null, array('name' => 'form_id', 'value'=> $form_id));
    echo $this->Form->hidden(null, array('name' => 'transaction_id', 'value'=> $transaction_id));
    
    echo $this->Form->hidden(null, array('name' => 'checksum', 'value'=> $checksum));
    echo $this->Form->hidden(null, array('name' => 'checksum_key', 'value'=> $checksum_key));

    echo $this->Form->end('Enviar');
    
}else{

    print_r($form_data['message']);
    print_r($form_data['error']);

    echo $this->Form->create(null, array(
        'url' => array('controller' => 'api', 'action' => 'checklogin'),
        'type' => 'post',
        'target' => '_parent'
    ));
    
    /*
     * Campos Editables
     */
    echo $this->Form->input(null, array('name' => 'user_id', 'label' => 'User', 'value'=>'iavalenzu'));
    echo $this->Form->input(null, array('name' => 'user_pass', 'label' => 'Password', 'type' => 'password', 'value'=>'password'));

    if(isset($captcha_code)){
        echo $this->Captcha->image($captcha_code);
        echo $this->Form->input(null, array('name' => 'captcha_code', 'label' => 'Captcha', 'value' => ''));
    }
    

    /*
     * Identificadores
     */
    
    echo $this->Form->hidden(null, array('name' => 'form_id', 'value' => $form_id));
    echo $this->Form->hidden(null, array('name' => 'service_id', 'value' => $service_id));
    echo $this->Form->hidden(null, array('name' => 'transaction_id', 'value' => $transaction_id));

    echo $this->Form->hidden(null, array('name' => 'checksum', 'value' => $checksum));
    echo $this->Form->hidden(null, array('name' => 'checksum_key', 'value' => $checksum_key));

    echo $this->Form->end('Acceder');

}

?>