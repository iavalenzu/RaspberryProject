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
    
    echo $this->Form->input('Form.code', array('label' => 'Code', 'value'=>''));
    
    if(isset($captcha_code)){
        echo $this->Captcha->image($captcha_code);
        echo $this->Form->input('Form.captcha_code', array('label' => 'Captcha', 'value' => ''));
    }
    
    /*
     * Identificadores
     */
    
    echo $this->Form->hidden('Form.service_id', array('value'=> $service_id));
    echo $this->Form->hidden('Form.form_id', array('value'=> $form_id));
    echo $this->Form->hidden('Form.transaction_id', array('value'=> $transaction_id));
    
    //echo $this->Form->hidden(null, array('name' => 'checksum', 'value'=> $checksum));
    //echo $this->Form->hidden(null, array('name' => 'checksum_key', 'value'=> $checksum_key));

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
    echo $this->Form->input('Form.user_id', array('label' => 'User', 'value'=>'iavalenzu', 'type'=>'text'));
    echo $this->Form->input('Form.user_pass', array('label' => 'Password', 'type' => 'password', 'value'=>'password'));

    if(isset($captcha_code)){
        echo $this->Captcha->image($captcha_code);
        echo $this->Form->input('Form.captcha_code', array('label' => 'Captcha', 'value' => ''));
    }
    

    /*
     * Identificadores
     */
    
    echo $this->Form->hidden('Form.service_id', array('value' => $service_id));
    echo $this->Form->hidden('Form.form_id', array('value' => $form_id));
    echo $this->Form->hidden('Form.transaction_id', array('value' => $transaction_id));

    //echo $this->Form->hidden(null, array('name' => 'checksum', 'value' => $checksum));
    //echo $this->Form->hidden(null, array('name' => 'checksum_key', 'value' => $checksum_key));

    echo $this->Form->end('Acceder');

}

?>