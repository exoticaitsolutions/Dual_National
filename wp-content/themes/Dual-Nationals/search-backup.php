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

get_header('new');
if ( is_user_logged_in() ) {
 

$current_user = wp_get_current_user();
$user = new MeprUser( get_current_user_id());

$subscriptions = $user->active_product_subscriptions('ids');
$phone = get_user_meta($current_user->ID,'mepr_phone_number',true); 
$user_ID = get_current_user_id(); // get the user ID
 $member = new MeprUser(); // initiate the class
 $member->ID = $user->ID; // if using this in admin area, you'll need this to make user id the member id
 $result = $member->get_active_subscription_titles("<br/>");
 //echo $result;
 ?>

     <section class="watch_list py_8">
          <div class="container">
            <div class="row">
                <div class="tittle_heading">
                <h2> Player List</h2>
              </div>
             <div class="col-md-8">
              
              <div class="watch_list_table">
                <table id="watch_list_data" class="table table-striped" style="width:100%">
                  <thead>
                      <input type="hidden" name="admin_url" id="admin_url"
                                value="<?php echo admin_url( 'admin-ajax.php' );?>">
                      <tr>
                          <th><span>Players</span></th>
                          <th><span>Clubs</span></th>
                          <th><span>Age</span></th>
                          <th><span>Nat.</span></th>
                          <th><span>Market Value</span></th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $targetName = $_GET['players'];
                     
                    if($targetName){     ?>
                    <script>//jQuery('#searchs').val( '  ' );</script>
                    <?php
                    $found_result = $wpdb->get_row( "SELECT * FROM `wp_player_details` WHERE name = '$targetName'" );
                   
                  
                      if($result == 'Free Membership'){
                        global $wpdb;
                     $table_name = $wpdb->prefix . 'search';
                     $resrch_result = $wpdb->get_row("SELECT * FROM wp_search where user_id='".$user_ID."' && search_value ='".$targetName."'" );
                     $player_name = $resrch_result->search_value; 
                     $Seen = $resrch_result->Seen;
                     $count= 0;
                     $count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM wp_search WHERE user_id = %s", $user_ID ) );
                     //echo $count;
                     if($player_name != $targetName && $count < 3 && $found_result != null) {
                      $data = array( 'search_value' =>$targetName,'Seen'=>'Seen' ,'user_id' =>$user_ID);
                     $wpdb->insert( $table_name, $data );
                     }
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
                   //}, 500);
               }); 
               </script>
                      <?php
                }
                
                   //  $name_duplicate = $wpdb->get_row("SELECT * FROM wp_search where search_value='".$targetName."' && search_value ='".$targetName."'" ); 

                    if($count <= 2 || $player_name == $targetName){
                      
                   //  if($Seen == 'Seen'){
                      global $wpdb;

                      $results = $wpdb->get_results( "SELECT * FROM `wp_player_details` WHERE name = '$targetName'" );
                    //  print_r($results);
                      foreach($results as  $result){
                       $array = $result->citizenship;
                       $new_string = str_replace('"]', ' ', str_replace('["', '', $array));

                       $new_string1 = str_replace('"', '', $new_string);
                       ?>
                    <tr class="my_acc_tr">
                        <td>
                          <div class="player_data">
                            <div class="pla_yer_img">
                              <img src="<?php echo $result->headshot ?>" alt="">
                            </div>
                            <div class="pla_yer_name">
                            <?php echo $result->name ?></h6>
                              <p><?php echo $new_string1 ?></p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p><?php echo $result->club;?></p>
                          <!-- <img class="watchlist_club_logo" src="<?php //echo $result->national_team_flag ?>" alt=""> -->
                        </td>
                        <td><?php echo $result->age;?></td>
                        <td>
                          <img class="bith_img" src="<?php echo $result->place_of_birth_flag ?>" alt="">
                        </td>
                        <td><?php echo $result->market_value;?></td>
                        </tr>
                    <?php  } }
                    else{ ?>
                      <script>
                      jQuery( document ).ready(function() {
                          setTimeout(function () {
                          jQuery('.watch_list_table').html(' ' );
                          jQuery('.tittle_heading h2').text(' ' );
                          
                      // Swal.fire(
                      //  'Ops!', 'In free membership,  you will see 3 users data, for more results, kindly upgrade your membership !!!', 'warning')
                      
                      swal({
                              text: "In free membership,  you will see 3 users data, for more results, kindly upgrade your membership !!! ",
                              //icon: "warning",
                              buttons: true,
                              dangerMode: true,
                            })
                            .then((willDelete) => {
                              if (willDelete) {
                                // swal(" ", {
                                //  // icon: "success",
                                // });
                              } else {
                                window.location.href = "https://dualnationals.com/plans-pricing/";
                              }
                          });

                    },
                       1000);
                       setTimeout(function () {
                        jQuery('button.swal-button.swal-button--cancel').text('Upgrade Your membership');
                      },
                       1000);
                  }); 
                  </script> <?php
                    }
                   // echo $count;
                   
                    }
                      ?>
                     <?php
                      ?>

                     <?php

                    } 
                    
           $country_target = $_GET['s'];
           echo 'dddddd';
              if($country_target){
                echo 'ddd';
                $result_county = $wpdb->get_results( "SELECT * FROM `wp_player_details` WHERE `citizenship` = 'United States' order by cast(market_value as Decimal(5,2)) desc Limit 3");
             // $result_county ="SELECT * FROM `wp_player_details` WHERE `citizenship` = 'United States' order by cast(market_value as Decimal(5,2)) desc";
                // if($result == 'Free Membership'){
                 // print_r();
                  foreach($result_county as $countryies){
                  //  echo 'ssd';

                  //  print_r($countryies);
                    
                  ?>
                             <tr class="my_acc_tr custom<?php //echo $count;?>">
                        <td> <a href="/single-profile/?id=<?php echo $countryies->id;?>">
                          <div class="player_data">
                            <div class="pla_yer_img">
                              <img src="<?php echo $countryies->headshot;?>" alt="">
                            </div>
                            <div class="pla_yer_name">
                              <h6><?php echo $countryies->name ; ?></h6>
                              <p><?php echo $countryies->citizenship ; ?></p>
                            </div>
                          </div>
                        </td>
                    </a>
                        <td>
                          <p><?php echo $countryies->club;?></p>
                          <!-- <img class="watchlist_club_logo" src="<?php //echo $countryies->league_logo;?>" alt=""> -->
                        </td>
                        <td><?php echo $countryies->age;?></td>
                        <td>
                          <img class="bith_img" src="<?php echo $countryies->place_of_birth_flag ;?>" alt="">
                        </td>
                        <td><?php echo $countryies->market_value;?></td>
                        </tr>
                            <?php

                         }
                         //  $i++;
                         //}
                        $count++;
                     }
                    
              ?>
                   
                    
                </tbody>
                     

              </table>
              <!-- <div class="View_more"><a onclick="clickCounter()" href="/plans-pricing/" class="theme_btn">View more</a></div> -->
              </div>
            </div>
             <div class="col-md-4">
                    <div class="contact_ads_list">
                        <ul>
                            <li>
                                <div class="contact_ads_img">
                                    <img src="/wp-content/uploads/2023/04/nike-ads-1.jpg" alt="">
                                </div>
                            </li>
                            <li>
                                <div class="contact_ads_img">
                                    <img src="wp-content/uploads/2023/04/social-media-ads-1.jpg"
                                        alt="">
                                </div>
                            </li>
                            <li>
                                <div class="contact_ads_img">
                                    <img src="https://dualnationals.com/wp-content/uploads/2023/04/burger-ads.jpg" alt="">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
        </div>
          </div>
          <?php 
           if($result == 'Free Membership'){
            ?>
            <script>
                    jQuery(".View_more a").click(function() {
                        setTimeout(function () {

                                  //   jQuery('#watch_list_data_wrapper').html('<p>If you want to see more players please purchase premium membership!</p>' );
                                Swal.fire(
                                 'Ops!', 'Your limit is exceed players please purchase premium membership!', 'warning')
                                }, 600);
                    });
                    clickCounter();

function clickCounter() {
  if (localStorage.clickcount) {
    localStorage.clickcount = Number(localStorage.clickcount)+1;
  } else {
    localStorage.clickcount = 1;
  }
var countss = localStorage.clickcount;
console.log(countss);
// if(countss >= 3){
// setTimeout(function () {

//                                      jQuery('#watch_list_data_wrapper').html('<p>If you want to see more players please purchase premium membership!</p>' );
//                                 Swal.fire(
//                                  'Ops!', 'Your limit is exceed players please purchase premium membership!', 'warning')
//                                 }, 600);

// }
}
            </script>
            <?php
           }
          ?>
        </section>
<script type="text/javascript">jQuery(document).ready(function () {
   // jQuery('#watch_list_data').DataTable();
    jQuery('#watch_list_data_paginate').css('display' , 'none', '!imporant');
});</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
}else{
  ?>
  <script>
    window.location.href = "https://dualnationals.com/plans-pricing/";

    </script>
  <?php
}
get_footer();
 ?>