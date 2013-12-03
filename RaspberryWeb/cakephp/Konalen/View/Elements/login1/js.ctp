<?php if (isset($partner_form)): ?>

    <?php 
    
        if(isset($partner_form['PartnerForm']['session_expire'])):
            $session_expire = $partner_form['PartnerForm']['session_expire'];
            $timeout_millis = (strtotime($session_expire) - time()) * 1000;
    ?>
    
      console.log('<?php echo $timeout_millis; ?>');

      /*Fijamos el timeout, antes que se recarge la pagina*/  
      setTimeout(function(){
      
          window.location.reload();
      
      }, <?php echo $timeout_millis; ?>);  


    <?php endif; ?>

<?php endif; ?>