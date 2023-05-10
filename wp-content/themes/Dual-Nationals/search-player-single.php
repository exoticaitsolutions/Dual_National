<?php /* Template Name: single profile */
get_header('golkipper');

get_header();

 global $wpdb;
$ids = $_GET['id'];
$current_user = wp_get_current_user();
$user = new MeprUser( get_current_user_id());
$subscriptions = $user->active_product_subscriptions('ids');
$phone = get_user_meta($current_user->ID,'mepr_phone_number',true); 
$user_ID = get_current_user_id(); // get the user ID
 $member = new MeprUser(); // initiate the class
 $member->ID = $user->ID; // if using this in admin area, you'll need this to make user id the member id
 $result = $member->get_active_subscription_titles("<br/>");
 global $wpdb;
 $get_positions  = $wpdb->get_results( "SELECT main_position  FROM wp_player_details WHERE id = '$ids'" ); 
$main_position = $get_positions[0]->main_position;
/************************Free Membership***********************/
if($result == 'Free Membership'){
 if($main_position == 'Goalkeeper'){
/******************Golkeeper data********************/
get_template_part('/view-states/free-membership/golkeeper-search');
}else{
    /*********************Non Golkipper data******************/
    get_template_part('/view-states/free-membership/non-golkeeper');
}
 }
 /*************adminstrator membership*********************/
 if($result == 'Administrator Membership'){
 if($main_position == 'Goalkeeper'){
/******************Golkeeper data********************/
get_template_part('/view-states/administrator-search/golkeeper-search');
}else{
    /*********************Non Golkipper data******************/
    get_template_part('/view-states/administrator-search/non-golkeeper');
}
 }
 /*******************Player Membership*************************/
 if($result == 'Player Membership'){
 if($main_position == 'Goalkeeper'){
/******************Golkeeper data********************/
get_template_part('/view-states/player-search/golkeeper-search');
}else{
    /*********************Non Golkipper data******************/
    get_template_part('/view-states/player-search/non-golkeeper');
}
 }
 /**********Premium Membership*****************/
 if($result == 'Premium Membership'){
 if($main_position == 'Goalkeeper'){
/******************Golkeeper data********************/
get_template_part('/view-states/premium-search/golkeeper-search');
}else{
    /*********************Non Golkipper data******************/
    get_template_part('/view-states/premium-search/non-golkeeper');
}
 }
?>
<script>

  /**************Golkeeper Js**********************/
  jQuery(document).ready(function() {
  var $temp = $("<input>");
var $url = $(location).attr('href');

jQuery('.clipboard').on('click', function() {
  jQuery("body").append($temp);
  $temp.val($url).select();
  document.execCommand("copy");
  $temp.remove();
})
 var counts_li = jQuery('ul#li_counts li').length;
for (var i = 0; i < counts_li; i++) {
  jQuery('ul#append_lise').append('<li class="appends counts_li' + i + '"></li>');
}
    var counts_li = jQuery('ul#li_counts_lise li').length;
for (var i = 0; i < counts_li; i++) {
  jQuery('ul#append_liseJoin').append('<li class="appends counts_li' + i + '"></li>');
}
 var counts_li = jQuery('ul#li_countss_debut li').length;
console.log(counts_li);
for (var i = 0; i < counts_li; i++) {
  jQuery('ul#append_liss').append('<li class="appends counts_li' + i + '"></li>');
}
 var counts_li = jQuery('ul#current_session_cpount li').length;
console.log(counts_li);
for (var i = 0; i < counts_li; i++) {
  jQuery('ul#append_lis').append('<li class="appends counts_li' + i + '"></li>');
}
/****************************************/
/******************Non goolkeeper js**********************/
var append_debut_lis = jQuery('ul#li_cunt_get_debut li').length;
console.log(append_debut_lis);
for (var i = 0; i < append_debut_lis; i++) {
  jQuery('ul#append_debut_lis').append('<li class="appends counts_li' + i + '"></li>');
}
 var get_history_li = jQuery('ul#club_his_count li').length;
console.log(get_history_li);
for (var i = 0; i < get_history_li; i++) {
  jQuery('ul#get_history_li').append('<li class="appends counts_li' + i + '"></li>');
}
 var get_count_session = jQuery('ul#get_count_session li').length;
console.log(get_count_session);
for (var i = 0; i < get_count_session; i++) {
  jQuery('ul#append_current_states').append('<li class="appends counts_li' + i + '"></li>');
}
});
</script>
<?php
get_footer('golkipper');
get_footer();