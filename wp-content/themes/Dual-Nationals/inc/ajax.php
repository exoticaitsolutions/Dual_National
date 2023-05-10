<?php
add_action( 'wp_ajax_nopriv_Save_wish_list_data', 'Save_wish_list_data' );
add_action( 'wp_ajax_Save_wish_list_data', 'Save_wish_list_data' );

//  Ajex for Wishlist Delete Functionalty 
add_action( 'wp_ajax_nopriv_Wishlist_delate_fucntionlaty', 'Wishlist_delate_fucntionlaty' );
add_action( 'wp_ajax_Save_Wishlist_delate_fucntionlaty', 'Wishlist_delate_fucntionlaty' );


// Edit_User_Profile_fucntionalty
add_action( 'wp_ajax_nopriv_Edit_User_Profile_fucntionalty', 'Edit_User_Profile_fucntionalty' );
add_action( 'wp_ajax_Save_Edit_User_Profile_fucntionalty', 'Edit_User_Profile_fucntionalty' );



// append_state_functionalty
add_action( 'wp_ajax_nopriv_country_state_fucntionlty_on_edit_page', 'country_state_fucntionlty_on_edit_page' );
add_action( 'wp_ajax_country_state_fucntionlty_on_edit_page', 'country_state_fucntionlty_on_edit_page' );

// Check User mail 

add_action( 'wp_ajax_nopriv_Login_fucntionalty', 'Login_fucntionalty' );
add_action( 'wp_ajax_nopriv_Login_fucntionalty', 'Login_fucntionalty' );


// 
// add_action( 'wp_ajax_login_form_submisssion', 'login_form_submisssion' );


add_action( 'wp_ajax_nopriv_dcsAjaxCallFormSubmit', 'dcsAjaxCallFormSubmit' );
add_action( 'wp_ajax_dcsAjaxCallFormSubmit', 'dcsAjaxCallFormSubmit' );


add_action( 'wp_ajax_nopriv_check_user_and_mail_by_user', 'check_user_and_mail_by_user' );
add_action( 'wp_ajax_check_user_and_mail_by_user', 'check_user_and_mail_by_user' );
?>