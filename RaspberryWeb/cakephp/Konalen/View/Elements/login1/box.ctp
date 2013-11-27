<?php if (isset($partner_form)): ?>

    <?php
    $session_expire = $partner_form['PartnerForm']['session_expire'];
    $session_id = $partner_form['PartnerForm']['session_id'];
    $data = $partner_form['PartnerForm']['data'];

    $captcha = isset($data['captcha']) ? true : false;
    $email = isset($data['fields']['email']['value']) ? $data['fields']['email']['value'] : '';

    $timeout_millis = (strtotime($session_expire) - time()) * 1000;

    ?>

    <div class="card<?php echo $id; ?> signin-card<?php echo $id; ?>">
        <!--<p class="profile-name"></p>-->
        <form novalidate="" method="post" action="" id="">
            <!--<span id="reauthEmail"></span>-->
            <input id="Email" name="Email" type="email" class="input-email<?php echo $id; ?>" placeholder="Email" >
            <input id="Password" name="Password" type="password" placeholder="Password" class="input-password<?php echo $id; ?>">
            <input id="SignIn" name="SignIn" class="input-submit<?php echo $id; ?> rc-button<?php echo $id; ?> rc-button-submit<?php echo $id; ?>" type="submit" value="Sign in">
        </form>
        <!--<a id="link-forgot-passwd" href="">  Need help?  </a>-->
    </div>

<?php endif; ?>