<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */
get_header('golkipper');
get_header('new');



if ( !is_user_logged_in() ) {
  ?>
  <script>window.location.href = "https://dualnationals.com/plans-pricing/";</script>
  <?php
}
$current_user = wp_get_current_user();
$user = new MeprUser( get_current_user_id());
$subscriptions = $user->active_product_subscriptions('ids');
$phone = get_user_meta($current_user->ID,'mepr_phone_number',true); 
$user_ID = get_current_user_id(); // get the user ID
 $member = new MeprUser(); // initiate the class
 $member->ID = $user->ID; // if using this in admin area, you'll need this to make user id the member id
 $result = $member->get_active_subscription_titles("<br/>");
 global $wpdb;


 ?>
            <!---------------------------------------Player Search start------->
            <?php $targetName = $_GET['players']; 

           
       
            if($targetName){
                if($result == 'Free Membership'){

                  $found_result = $wpdb->get_row( "SELECT * FROM `wp_player_details` WHERE name = '$targetName'" );
                   if(!$found_result){
                    ?>
                    <script>
                  jQuery( document ).ready(function() {
                    setTimeout(function () {
                      jQuery('.swal-overlay.swal-overlay--show-modal').html(' ');
                    }, 1100);
                    jQuery('.watch_list_table').html(' ' );
                    Swal.fire(
                      'Ops!', 'Please Enter Player Correct Name', 'warning')
                    }); 
                    </script><?php
                   }
                  $premium_result = $wpdb->get_results( "SELECT * FROM `wp_player_details` WHERE name = '$targetName'" );
                   foreach($premium_result as $pre_results){
                     $get_positions = $pre_results->main_position;
                     if($get_positions == 'Goalkeeper'){
                      /******************Golkeeper data********************/
                      get_template_part('/search-templates/free-membership/golkeeper-search');
                    }else{
                  /*********************Non Golkipper data******************/
                      get_template_part('/search-templates/free-membership/non-golkeeper');
                       //echo "Non Goalkeeper";
                       }
                   }
                  }
                
  /**************************Country Search End********************** */
  /****************Premium Search Start******************************* */
                  if($result == 'Premium Membership'){
                    $premium_result = $wpdb->get_results( "SELECT * FROM `wp_player_details` WHERE name = '$targetName'" );
                   foreach($premium_result as $pre_results){
                     $get_positions = $pre_results->main_position;
                     if($get_positions == 'Goalkeeper'){
                      /******************Golkeeper data********************/
                      get_template_part('/search-templates/premium-search/golkeeper-search');
                    }else{
                  /*********************Non Golkipper data******************/
                      get_template_part('/search-templates/premium-search/non-golkeeper');
                       //echo "Non Goalkeeper";
                       }
                   }
                 }
                /****************Premium Search End***************** */

                /****************Player membership Search Start*******/
                  if($result == 'Player Membership'){
                    
                    $premium_result = $wpdb->get_results( "SELECT * FROM `wp_player_details` WHERE name = '$targetName'" );
                   foreach($premium_result as $pre_results){
                     $get_positions = $pre_results->main_position;
                     if($get_positions == 'Goalkeeper'){
                      
                      /******************Golkeeper data********************/
                      get_template_part('/search-templates/player-search/golkeeper-search');
                    }else{ 
                  /*********************Non Golkipper data******************/
                      get_template_part('/search-templates/player-search/non-golkeeper');
                       //echo "Non Goalkeeper";
                       }
                   }
                 }
                /****************Player membership Search End***************** */
                
                 /*******************************************/
                  /*********************Administrator Membership Start**********************/
                if($result == 'Administrator Membership'){
                    $premium_result = $wpdb->get_results( "SELECT * FROM `wp_player_details` WHERE name = '$targetName'" );
                   foreach($premium_result as $pre_results){
                     $get_positions = $pre_results->main_position;
                     if($get_positions == 'Goalkeeper'){
                      /******************Golkeeper data********************/
                      get_template_part('/search-templates/administrator-search/golkeeper-search');
                    }else{
                  /*********************Non Golkipper data******************/
                      get_template_part('/search-templates/administrator-search/non-golkeeper');
                       //echo "Non Goalkeeper";
                       }
                   }
                 }
                }
                 /*********************Administrator Membership**********************/
  ?>
  
  <?php
  
  $countries_name = $_GET['inputcountry'];
  if($countries_name){

    get_template_part('/search-templates/country_search');

   }
  

  else {
    echo "no country";
  }
  ?>


<?php 
if($result == 'Free Membership'){ ?>
<script>
var rowCount = jQuery('#watch_list_datass tr').length;
if(rowCount >= 4){
  setTimeout(function () {
    jQuery('.view_mores').append('<button class="view-more theme_btn" type="button">View more</button>');
   }, 1500);
  }
  
// jQuery(".view_mores").on('click',function() {
//   setTimeout(function () {
//     Swal.fire({
//       text: 'Your limit is exceed players please purchase premium membership!',
//       footer: '<a href="/plans-pricing/" class="theme_btn">Ok</a>'
//     })
//     jQuery('button.swal2-confirm.swal2-styled').css('display' ,'none' , '!important');
//   }, 600);
// });
</script>
<?php } ?>
</section>
<script type="text/javascript">jQuery(document).ready(function () {
    jQuery('#watch_list_data_paginate').css('display' , 'none', '!imporant');
});
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
/****************************************/

setTimeout(function() {
    jQuery('button.swal-button.swal-button--confirm.swal-button--danger').text('Logout');
}, 300);
jQuery(document).on("click",".dupliate_players li",function() {
                            var selectedValue = jQuery(this).text(); // Get the text of clicked li
                            console.log(selectedValue);
                            jQuery('#Search_playres').val(selectedValue); // Set the value of input field
                            //jQuery('div#autoserach').hide();
                        });
// window.location.href = "https://dualnationals.com/plans-pricing/";
</script>
<?php //}
global $wpdb;

// Get the player name from the form submission


get_footer('golkipper');
get_footer();

 ?>