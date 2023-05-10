<?php if (!defined('ABSPATH')) {
  die('You are not allowed to call this page directly.');
} 
get_header();
?>

<div id="mepro-login-hero" class="forget_passcode success_full">
    <div class="container">
        <div class="mepro-boxed">
            <div class="mepro-login-contents">
                <?php
      $reset_error = isset($_REQUEST['error']) ? $_REQUEST['error'] : "";

      if (!empty($reset_error)) {
        $errors[] = $reset_error;
      ?>
                <h3><?php _ex('Password could not be reset.', 'ui', 'memberpress'); ?></h3>
                <?php MeprView::render('/shared/errors', get_defined_vars()); ?>
                <div><?php _ex('Please contact us for further assistance.', 'ui', 'memberpress'); ?></div>
                <?php
      } else {
      ?>
                <div class="mp_wrapper mepr_password_reset_requested">
                    <h3 style="color: green !important;"><?php _ex('Successfully requested password reset', 'ui', 'memberpress'); ?></h3>
                    <p style="color: green !important;"><?php _ex('Please click on the confirmation link that was just sent to your email address.', 'ui', 'memberpress'); ?>
                    </p>
                </div>
                <?php } ?>


            </div>
        </div>
    </div>

</div>
<?php get_footer(); ?>