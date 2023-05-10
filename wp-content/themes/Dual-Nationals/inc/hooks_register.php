<?php
  add_action( 'wp_enqueue_scripts', 'arisa_child_enqueue_styles' );
  add_action( 'wp_enqueue_scripts', 'wiio_child_theme_style' );
  add_action( 'after_setup_theme', 'mytheme_register_nav_menu', 0 );
  // add_action('check_admin_referer', 'logout_without_confirm', 10, 2);




  //  Short Code Register 


?>