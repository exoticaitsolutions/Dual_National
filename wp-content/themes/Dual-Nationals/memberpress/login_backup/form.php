<?php if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');} ?>
<?php get_header(); ?>
<div class="wel_dual_net_form user_login_form">

<div class="mp_wrapper mp_login_form" id="ajax_form_data">

    <?php if(MeprUtils::is_user_logged_in()): ?>

    <?php if(!isset($_GET['mepr-unauth-page']) && (!isset($_GET['action']) || $_GET['action'] != 'mepr_unauthorized')): ?>
    <?php if(is_page($login_page_id) && isset($redirect_to) && !empty($redirect_to)): ?>
    <script type="text/javascript">
    window.location.href = "<?php echo urldecode($redirect_to); ?>";
    </script>
    <?php else: ?>
    <div class="mepr-already-logged-in">
        <?php printf(_x('You\'re already logged in. %1$sLogout.%2$s', 'ui', 'memberpress'), '<a href="'. wp_logout_url(urldecode($redirect_to)) . '">', '</a>'); ?>
    </div>
    <?php endif; ?>
    <?php else: ?>
    <?php echo $message; ?>
    <?php endif; ?>

    <?php else: ?>
    <?php echo $message; ?>
    <!-- mp-login-form-start -->
    <?php //DON'T GET RID OF THIS HTML COMMENT PLEASE IT'S USEFUL FOR SOME REGEX WE'RE DOING ?>
    <form name="mepr_loginform" id="mepr_loginform" class="mepr-form"
        method="post">
        <input type="hidden" name="admin_url" id="admin_url_edit_page" value="<?php echo admin_url( 'admin-ajax.php' );?>">

        <?php /* nonce not necessary on this form seeing as the user isn't logged in yet */ ?>
        <div class="mp-form-row mepr_username mp-form-row mepr_username" >
            <div class="mp-form-label">
                <?php $uname_or_email_str = MeprHooks::apply_filters('mepr-login-uname-or-email-str', _x('Email', 'ui', 'memberpress')); ?>
                <?php $uname_str = MeprHooks::apply_filters('mepr-login-uname-str', _x('Email', 'ui', 'memberpress')); ?>
                <label
                    for="user_login"><?php echo ($mepr_options->username_is_email)?$uname_or_email_str:$uname_str; ?></label>
                <?php /**/ ?>
            </div>
            <input  type="text" name="log" id="user_login" value="<?php echo (isset($_REQUEST['log'])?esc_html($_REQUEST['log']):''); ?>" />
            <span class="error" id="email-error"></span>
        </div>
        <div class="mp-form-row mepr_password mp-form-row mepr_username">
            <div class="mp-form-label">
                <label for="user_pass"><?php _ex('Password', 'ui', 'memberpress'); ?></label>
                <?php /* <span class="cc-error"><?php _ex('Password Required', 'ui', 'memberpress'); ?></span> */ ?>
                <div class="mp-hide-pw">
                    <input   type="password" name="pwd" id="user_pass" value="" />
                    <button type="button" class="button login_show_pwd mp-hide-pw hide-if-no-js" data-toggle="0"
                        aria-label="<?php esc_attr_e( 'Show password', 'memberpress' ); ?>">
                        <span class="dashicons dashicons-visibility" aria-hidden="true">
                        <i class="fa fa-eye" aria-hidden="true"></i>

                        </span>
                    </button>
                    <span class="error" id="password-error"></span>

                </div>
            </div>
        </div>
        <?php MeprHooks::do_action('mepr-login-form-before-submit'); ?>
        <div>
            <div class="remember_me">
                <label><input name="rememberme" type="checkbox" id="rememberme" value="forever"
                        <?php checked(isset($_REQUEST['rememberme'])); ?> />
                    <?php _ex('Remember Me', 'ui', 'memberpress'); ?></label>
            </div>
        </div>
        <div class="submit">
            <input type="submit" name="wp-submit" id="wp-submit" class="button-primary mepr-share-button "
                value="<?php _ex('Log In', 'ui', 'memberpress'); ?>" />
            <input type="hidden" name="redirect_to" value="<?php echo esc_attr($redirect_to); ?>" />
            <input type="hidden" name="mepr_process_login_form" value="true" />
            <input type="hidden" name="mepr_is_login_page" value="<?php echo ($is_login_page)?'true':'false'; ?>" />
        </div>
    </form>
    <div class="mepr-login-actions">
        <a href="<?php echo esc_url($forgot_password_url); ?>"><?php _ex('Forgot Password ?', 'ui', 'memberpress'); ?></a>
    </div>
    <!-- mp-login-form-end -->
    <?php //DON'T GET RID OF THIS HTML COMMENT PLEASE IT'S USEFUL FOR SOME REGEX WE'RE DOING ?>

    <?php endif; ?>
</div>
    </div>
    <style>
        i.fa.fa-eye {
    display: none !important;
}
        </style>
<?php get_footer(); ?>