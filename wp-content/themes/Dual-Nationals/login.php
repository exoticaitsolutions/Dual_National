<?php /* Template Name: Login */ 

get_header();
///if ( !is_user_logged_in() ) {

?>
<div class="wel_dual_net_form user_login_form">
<?php echo do_shortcode('[mepr-login-form]'); ?>

</div>
<?php
get_footer();
?>