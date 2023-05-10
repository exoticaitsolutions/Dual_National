<?php 
get_header();
if (!defined('ABSPATH')) {
  die('You are not allowed to call this page directly.');
} ?>

<?php
if ( isset( $_POST['wp-submit'] ) && $_POST['wp-submit'] ) {
    $response =  (!empty(get_user_by('email',  $_REQUEST['mepr_user_or_email']))) ? '' : array("type" => "error", "message" => "This Email is not Exist ") ;
}

?>

<div id="mepro-login-hero" class="forget_passcode">
    <div class="container">
        <div class="mepro-boxed">
            <div class="mepro-login-contents">

                <div id="mepr-template-login" class="mp_wrapper">
                    <!-- <div class="alert alert-primary mepr_pro_error" role="alert">
                            This is a primary alert—check it out!
                        </div> -->
                    <h3><?php _ex('Request a Password Reset', 'ui', 'memberpress'); ?></h3>
                    <form id="mepr_forgot_password_form" class="mepro-form" method="post">

                        <input type="hidden" name="admin_url" id="admin_url_edit_page"
                            value="<?php echo admin_url( 'admin-ajax.php' );?>">
                        <?php /* nonce not necessary on this form seeing as the user isn't logged in yet */ ?>
                        <div class="mp-form-row mepr_forgot_password_input">
                            <label
                                for="mepr_user_or_email"><?php _ex('Enter Your  Email Address', 'ui', 'memberpress'); ?></label>
                            <input type="text" name="mepr_user_or_email" id="mepr_user_or_email"
                                value="<?php echo isset($mepr_user_or_email) ? esc_html($mepr_user_or_email) : ''; ?>" />
                        </div>
                        <?php if(!empty($response)) { ?>
                        <span class="error" id="mepr_user_or_email111-error"><?php echo $response["message"]; ?></span>
                        <?php }?>
                        <!-- -->

                        <?php MeprHooks::do_action('mepr-forgot-password-form'); ?>
                        <div class="submit">
                            <input type="submit" name="wp-submit" id="wp-submit" class="theme_btn"
                                value="<?php _ex('Request Password Reset', 'ui', 'memberpress'); ?>" />
                            <input type="hidden" name="action" value="forgot_password" />
                            <input type="hidden" name="mepr_process_forgot_password_form" value="true" />
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<?php get_footer();?>