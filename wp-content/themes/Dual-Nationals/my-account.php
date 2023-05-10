
<?php
/*template name: New account page  */
// echo "asdsad";die();
// echo phpinfo();die;
get_header('new');


$banner = get_field('banner');
if ( is_user_logged_in() ) {

$current_user = wp_get_current_user();
$user = new MeprUser( get_current_user_id());

$subscriptions = $user->active_product_subscriptions('ids');
$phone = get_user_meta($current_user->ID,'mepr_phone_number',true); 
$user_ID = get_current_user_id(); // get the user ID
 $member = new MeprUser(); // initiate the class
 $member->ID = $user->ID; // if using this in admin area, you'll need this to make user id the member id
 $result = $member->get_active_subscription_titles("<br/>"); //MeprUser function that gets subscription title
 $txn = new MeprTransaction(get_current_user_id());
 $phone = get_user_meta($current_user->ID,'mepr_phone_number',true); 
 $mepr_agency_name = get_user_meta($current_user->ID,'mepr_agency_name',true);
 $mepr_agent_name = get_user_meta($current_user->ID,'mepr_agent_name',true); 
 $mepr_agent_phone = get_user_meta($current_user->ID,'mepr_agent_phone',true); 
 $mepr_agent_email = get_user_meta($current_user->ID,'mepr_agent_email',true); 
 $mpr_states = get_user_meta($current_user->ID,'mepr-address-state',true); 
?>


<div class="wraper">

<section class="my_account_sec">
        <div class="my_account_bg">
          <div class="container">
            <div class="my_account_head">
              <h1>My Account</h1>
            </div>
            <div class="edit_profiel">
              <img src="<?php echo esc_url( get_avatar_url( $current_user->ID ) ); ?>" alt="" />
              <div class="img_upload">
           
                <input type="file" id="img_upload" class="d-none" />
              </div>
            </div>
          </div>
        </div>
        <div
          class="profiel_details bg_style"
          style="background-image: url('<?php echo get_stylesheet_directory_uri();?>/assets/img/my_account_bg.png')"
        >
          <div class="container">
            <div class="row">
              <div class="edit_btn text-center">
              <a href="<?php bloginfo('url');?>/edit-profile/" class="theme_btn"> Edit Profile</a>
              </div>
              <div class="col-md-4 mb-3">
                <div class="profiel_details_crd">
                  <h6>Name</h6>
                  <p><?php  echo $current_user->display_name;?></p>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="profiel_details_crd">
                  <h6>Email</h6>
                  <p><?php echo $current_user->user_email;?></p>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="profiel_details_crd">
                  <h6>Phone Number</h6>
                  <div></div>
                  <input id="mobile" maxlength="10" name="mepr_phone_number"
                            value="<?php echo get_user_meta(get_current_user_id(),'mepr_phone_number',true); ?>" readonly>
                  <input readonly type="hidden" id="country_code"  name="country_code" value="<?php echo get_user_meta(get_current_user_id(),'country_code',true);?>">
                        <input type="hidden" id="country_code_name"  name="country_code_name" value="<?php echo get_user_meta(get_current_user_id(),'country_code_name',true);?>">
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="profiel_details_crd">
                  <h6>Edit / Update Membership</h6>
                  <?php if($result){?>
                            <p><?php echo $result;?></p>
                            <?php
                        } else {
                           ?>
                           <p>You dont have any membership</p>
                           <?php
                        }
                        ?>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="profiel_details_crd">
                  <h6>Billing Info</h6>
                  <?php 
                  if($result !=='Free Membership'){
                  require_once __DIR__ . '/vendor/autoload.php';
                  \Stripe\Stripe::setApiKey('sk_test_51Mj4tXDk7jBZtOXLrFOw37wL30SHUmTpERQU51FFQz6vpVFrUtAP37BBXgdeMCmqmxUYLrGOlPvMok64gGai83AI001ao9l3BO');
                  $current_user_id = get_current_user_id();
                  $customer_id = get_user_meta($current_user_id, '_mepr_stripe_customer_id_rr3gp9-1vm_test_USD', true);
                  $payment_sources = \Stripe\PaymentMethod::all([
                    'customer' => $customer_id,
                    'type' => 'card',
                  ]);
                if (!empty($payment_sources->data)) {

                  ?>
                  <p>XXXX-XXXX-XXXX-<?php echo $payment_sources->data[0]->card->last4; ?>
                </p>
              <?php } }else{ ?>
                <?php

              }?>
                </div> 
              </div>
              <div class="col-md-4 mb-3">
                        <div class="profiel_details_crd">
                            <h6>Billing Address Line 1:*</h6>
                            <div class="edit_profiler">
                           
                            <input readonly  type="text"  name="mepr-address-one" value="<?php echo get_user_meta(get_current_user_id(),'mepr-address-one',true); ?>" autocomplete="on">
                        </div>
                        </div>
                      
              </div>

              <div class="col-md-4 mb-3">
                        <div class="profiel_details_crd">
                            <h6>Billing Address Line 2:</h6>
                            <div class="edit_profiler">
                            
                            <input readonly  type="text"  name="mepr-address-two" value="<?php echo get_user_meta(get_current_user_id(),'mepr-address-two',true) ;?>" autocomplete="on">
                        </div>
                        </div>
              </div>
              <div class="col-md-4 mb-3">
                        <div class="profiel_details_crd">
                            <h6>City:*</h6>
                            <div class="edit_profiler">
                           
                            <input readonly  type="text" name="mepr-address-city" class="max_state" value="<?php echo get_user_meta(get_current_user_id(),'mepr-address-city',true) ;?>" autocomplete="on">
                        </div>
                        </div>
              </div>
              <div class="col-md-4 mb-3">
                        <div class="profiel_details_crd">
                            <h6>Country:*</h6>
                            <div class="edit_profiler">
                            
                            <input readonly type="text" name="mepr-address-country" class="max_state" value="<?php echo get_user_meta(get_current_user_id(),'mepr-address-country',true) ;?>" autocomplete="on">
                        </div>
                        </div>
                </div>
                <div class="col-md-4 mb-3">
                        <div class="profiel_details_crd">
                            <h6>State/Province:*</h6>
                            <div class="edit_profiler">
                            
                            <input readonly  type="text" name="mepr-address-state" class="max_state" value="<?php echo get_user_meta(get_current_user_id(),'mepr-address-state',true) ;?>" autocomplete="on">
                        </div>
                        </div>
                </div>
                <div class="col-md-4 mb-3">
                        <div class="profiel_details_crd">
                            <h6>Zip/Postal Code:*</h6>
                            <div class="edit_profiler">
                           
                            <input readonly type="text" maxlength="7" class="field_max" name="mepr-address-zip" value="<?php echo get_user_meta(get_current_user_id(),'mepr-address-zip',true) ;?>" autocomplete="on">
                        </div>
                        </div>
                </div>
                 <div class="col-md-4 mb-3">
                        <div class="profiel_details_crd">
                            <a> <h6>Upgrade Membership</h6>
                               <?php echo $result;?>
                           </a>
                        </div>
                </div>
             
                
                

            </div>
          </div>
        </div>
      </section>


        <section class="watch_list py_8">
          <div class="container">
            <div class="row">
              <div class="tittle_heading">
                <h2> Watchlist</h2>
              </div>
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
                          <th><span>Remove</span></th>
                      </tr>
                  </thead>
                  <tbody>
                    
                     
                    <?php 
                       $user_ID = get_current_user_id(); 

                    global $wpdb;
                    $tablename = $wpdb->prefix.'Wishlist_data_list';
                     $results = $wpdb->get_results ("SELECT * FROM  $tablename  where User_id = $user_ID ");

                    // $playerProfile = $results['playerProfile'];
                    $rows_count = $wpdb->num_rows;
                    $count = 0 ;
                 
                     foreach ($results as  $detail_item) {
                      $id = $detail_item->id;
                      $playerProfile = $detail_item->playerProfile;
                      $json_decodes = json_decode($playerProfile , true);
                       foreach ($json_decodes as  $detail_items) {
                    // echo '<pre>';
                    //  print_r($detail_items); die;
                      $playerImage = $detail_items['headshot'];
                      $playerName  = $detail_items['name'];
                      $club =    $detail_items['club'];
                      $main_position =    $detail_items['main_position'];
                      $clubImage   =  $detail_items['leagueLogo'];
                      $birthplaceCountryImage = $detail_items['national_team_flag'];
                      $marketValue = $detail_items['market_value'];
                      $age   =   $detail_items['age'];
                      
                    //}
                      $count++;
                    ?>
                      <tr class="my_acc_tr">
                        <td>
                          <div class="player_data">
                            <div class="pla_yer_img">
                              <img src="<?php echo $playerImage; ?>" alt="">
                            </div>
                            <div class="pla_yer_name">
                              <h6><?php echo $playerName ; ?></h6>
                              <p><?php echo $main_position;?></p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p><?php echo $club; ?></p>
                        </td>
                        <td><?php echo $age;?></td>
                        <td>
                          <img class="bith_img" src="<?php echo $birthplaceCountryImage ;?>" alt="">
                        </td>
                        <td>€<?php echo $marketValue;?></td>
                        <td>
                          <button class="trash" id="<?php echo $id;?>">
                          

                            <img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/trash.png" alt="">
                          
                          </button>
                        </td>
                      </tr>
                      <?php 
                 
                   // $table = 'eLearning_progress';
                  
                    } } 
                    if( $count >= 10){
                      echo $count;
                       ?>
                       <script>
                         setTimeout(function () {
                        jQuery('#watch_list_data_paginate').show();
                                         }, 700);

                       </script>
                       <?php
                      } else{ echo $count;?>
                        <script>
                           setTimeout(function () {
                        jQuery('#watch_list_data_paginate').hide();
                                         }, 700);

                       </script><?php } ?>
                    <script>

                      jQuery('.trash').on('click', function(event) {
                      event.preventDefault(); 
                      setTimeout(function () {
                       
                        jQuery('button.swal-button.swal-button--confirm.swal-button--danger').text('Remove');
                                         }, 100);
                       var id = $(this).attr('id');
                       swal({
                          title: "Are you sure?",
                          text: "Remove this player from my watchlist?", 
                          buttons: true,
                          dangerMode: true,
                          // icon: "success",
                        }).then((willDelete) => {
                          if (willDelete) {
                            swal("Wishlist successfully deleted!", {
                              // icon: "success",
                            });
                            jQuery.ajax({
                              url: ' <?php echo get_stylesheet_directory_uri()."/delete.php";?>',
                              method: 'POST',
                              data: {id: id},
                              success: function(response) {
                                location.reload();
                                jQuery('#search-results').html(response);
                              }
                            });
                          }
                        });
                      });

                      </script>
                  </tbody>
              </table>
              </div>
            </div>
          </div>
        </section>
    </div>
    <script>
      jQuery(document).ready(function () {
    jQuery('#watch_list_data').DataTable();
});
    </script>
<?php 

}
else{
  ?>
  <script>
    window.location.href = "https://dualnationals.com/user-login";

  </script>
<?php
}
get_footer();
?>


