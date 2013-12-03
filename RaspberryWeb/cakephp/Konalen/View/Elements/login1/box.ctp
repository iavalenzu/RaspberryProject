<?php if (isset($partner_form)): ?>

    <?php

    $session_id = isset($partner_form['PartnerForm']['session_id']) ? $partner_form['PartnerForm']['session_id'] : '';
    
    $form_data = isset($partner_form['PartnerForm']['data']) ? $partner_form['PartnerForm']['data'] : array();
    
    $captcha = isset($form_data['captcha']) ? $form_data['captcha'] : '';
    $email = isset($form_data['fields']['email']['value']) ? $form_data['fields']['email']['value'] : '';


    ?>

    <div class="card<?php echo $id; ?> signin-card<?php echo $id; ?>">
        <!--<p class="profile-name"></p>-->
        <form novalidate="" method="post" action="" id="">
            <!--<span id="reauthEmail"></span>-->
            <input id="Email" name="Email" type="email" class="input-email<?php echo $id; ?>" placeholder="Email" >
            <input id="Password" name="Password" type="password" placeholder="Password" class="input-password<?php echo $id; ?>">
            <input id="SignIn" name="SignIn" class="input-submit<?php echo $id; ?> rc-button<?php echo $id; ?> rc-button-submit<?php echo $id; ?>" type="submit" value="Sign in">
            <input name="SessionId" type="hidden" value="<?php echo $session_id; ?>">
        </form>
        <!--<a id="link-forgot-passwd" href="">  Need help?  </a>-->
    </div>

<?php endif; ?>