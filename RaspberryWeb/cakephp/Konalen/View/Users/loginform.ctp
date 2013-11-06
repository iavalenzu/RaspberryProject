
<?php if(isset($partner_form)): ?>


<?php 

    $session_expire = $partner_form['PartnerForm']['session_expire']; 
    $session_id = $partner_form['PartnerForm']['session_id']; 
    $data = $partner_form['PartnerForm']['data']; 

    $captcha = isset($data['captcha']) ? true : false; 
    $email = isset($data['fields']['email']['value']) ? $data['fields']['email']['value'] : ''; 
    
    $timeout_millis = (strtotime($session_expire) - time()) * 1000;
?>


<?php ob_start(); ?>

    <div class="login-container">
        <div class="login-header">
            <h4>Sign in</h4>
        </div>
        <form>
            <div class="login-field">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username">
                <i class="icon-user"></i>
            </div>
            <div class="login-field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password">
                <i class="icon-lock"></i>
            </div>
            <div class="login-button">
                <button type="submit" class="btn btn-large btn-block blue">SIGN IN <i class="icon-arrow-right"></i></button>
            </div>
            <div class="forgot-password">
                <a href="#">Forgot password?</a>
            </div>
        </form>
    </div>

<?php 

    $html = ob_get_contents();
    ob_end_clean();
    
    $html = preg_replace("/\s+/", " ", $html);
    
?>

<script>

<?php 
    ob_clean();
    ob_start();    
 ?>

$( document ).ready(function() {
 
    $('#loginform').html('<?php 
    
        echo $html;
    /*
            echo $this->Form->create(null, array(
                'type' => 'post',
                'url' => array('controller' => 'users', 'action' => 'checklogin')

            ));
            echo $this->Form->input(null, array('label' => 'Email', 'name' => 'email', 'value' => $email));
            echo $this->Form->input(null, array('label' => 'Password', 'type'=>'password', 'name' => 'password'));
            echo $this->Form->input(null, array('label' => 'Password', 'type' => 'hidden', 'name' => 'session_id', 'value' => $partner_form['PartnerForm']['session_id']));
            
            if($captcha){
                echo $this->Html->image(
                    $this->Html->url(array(
                        "controller" => "users",
                        "action" => "getCaptcha",
                        $session_id
                    )
                ), array('alt' => 'Captcha'));
                echo $this->Form->input(null, array('label' => 'Captcha', 'type' => 'text', 'name' => 'captcha_response', 'value' => ''));
            }
            
            
            echo $this->Form->end('Enviar');

            echo "<pre>";
            echo $captcha ? 'true' : 'false' .'<br>';
            echo $session_expire.'<br>';
            echo date('Y-m-d H:i:s').'<br>';
            echo $timeout_millis.'<br>';
            echo  str_replace("\n", "<br>", print_r($data,true));
            echo "</pre>";
            
            */
            
        ?>');
    
    <?php if($timeout_millis): ?>    
        setTimeout(function(){
            location.reload(true);
        },<?php echo $timeout_millis; ?>);    
    <?php endif; ?>
        
});

<?php 

    $javascript = ob_get_contents();
    ob_end_clean();
    
    $javascript = preg_replace("/\s+/", " ", $javascript);
 
?>

</script>

<?php 

    ob_clean();
    ob_start();
    
    echo $javascript;
?>

<?php endif; ?>
