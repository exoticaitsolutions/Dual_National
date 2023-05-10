<?php
get_header();
if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');} ?>

<div id="mepr-template-login" class="mp_wrapper forget_passcode new_passcode">
    <div class="container">
        <h3><?php _ex('Enter your new password', 'ui', 'memberpress'); ?></h3>
        <form name="mepr_reset_password_form" id="mepr_reset_password_form" class="mepr-form" action="" method="post">
            
            <?php /* nonce not necessary on this form seeing as the user isn't logged in yet */ ?>
            <div class="mp-form-row mepr_password">
                <div class="mp-form-label">
                    <label for="mepr_user_password"><?php _ex('Password', 'ui', 'memberpress'); ?>:</label>
                    <div class="mp-hide-pw">
                        <input type="password" name="mepr_user_password" id="mepr_user_password"
                            class="mepr-form-input mepr-forgot-password" tabindex="700" />
                        <button type="button" class="button button-secondary mp-hide-pw hide-if-no-js" data-toggle="0"
                            aria-label="<?php esc_attr_e( 'Show password', 'memberpress' ); ?>">
                            <span class="dashicons dashicons-visibility" aria-hidden="true"></span>
                        </button>

                        <div id="mepr_user_password_strength" style="display:none">
                                        <span class="indicator invalid" id="length">At least 8
                                            characters</span><span class="indicator invalid" id="capital">At
                                            least one capital letter</span> <span class="indicator invalid"
                                            id="special">At least one special character (!@#%^$&*)</span> <span
                                            class="indicator invalid" id="number">At least one number</span>
                                    </div>
                    </div>
                </div>
            </div>
            <div class="mp-form-row mepr_password_confirm">
                <div class="mp-form-label">
                    <label
                        for="mepr_user_password_confirm"><?php _ex('Password Confirmation', 'ui', 'memberpress'); ?>:</label>
                    <div class="mp-hide-pw">
                        <input type="password" name="mepr_user_password_confirm" id="mepr_user_password_confirm"
                            class="mepr-form-input mepr-forgot-password-confirm" tabindex="710" />
                        <button type="button" class="button button-secondary mp-hide-pw hide-if-no-js" data-toggle="0"
                            aria-label="<?php esc_attr_e( 'Show password', 'memberpress' ); ?>">
                            <span class="dashicons dashicons-visibility" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </div>
            <?php MeprHooks::do_action('mepr-reset-password-after-password-fields'); ?>

            <div class="mepr_spacer"> </div>
            <div class="submit">
                <input type="submit" name="wp-submit" id="wp-submit" class="button-primary mepr-share-button "
                    value="<?php _ex('Update Password', 'ui', 'memberpress'); ?>" tabindex="720" />
                <input type="hidden" name="action" value="mepr_process_reset_password_form" />
                <input type="hidden" name="mepr_screenname" value="<?php echo $mepr_screenname; ?>" />
                <input type="hidden" name="mepr_key" value="<?php echo $mepr_key; ?>" />
                <input type="hidden" name="mepr_is_login_page" value="true" />
            </div>
        </form>
    </div>
</div>

<script>
    jQuery( "#mepr_user_password" ).mouseleave(function(e) {
    
 if (jQuery('.indicator').hasClass('invalid')) {
  jQuery("#wp-submit").attr("disabled", true);
  jQuery('div#password_strength').css("display" ,"block" ,"!important");
}else{
     jQuery("#wp-submit").attr("disabled", false);
}
  
  });
     jQuery("#mepr_user_password").keyup(function() {
        jQuery('.mepr_password .cc-error ').text('');
        var password = jQuery(this).val();
        // console.log(password);
        if (password.length < 8) {
            jQuery("#length").removeClass("valid").addClass("invalid");
        } else {
            jQuery("#length").removeClass("invalid").addClass("valid");
        }
        // Validate capital letter
        if (password.match(/[A-Z]/)) {
            jQuery("#capital").removeClass("invalid").addClass("valid");
        } else {
            jQuery("#capital").removeClass("valid").addClass("invalid");
        }
        // Validate special character
        if (password.match(/[!@#$%^&*]/)) {
            jQuery("#special").removeClass("invalid").addClass("valid");
        } else {
            jQuery("#special").removeClass("valid").addClass("invalid");
        }
        // Validate number
        if (password.match(/[0-9]/)) {
            jQuery("#number").removeClass("invalid").addClass("valid");
        } else {
            jQuery("#number").removeClass("valid").addClass("invalid");
        }

    }).focus(function() {
        jQuery("#mepr_user_password_strength").css("display", "block", "!important");
    }).blur(function() {
        jQuery("#mepr_user_password_strength").css("display", "none", "!important");
    });
</script>
<?php get_footer(); ?>