<?php
if ( is_user_logged_in() ) {

get_header();
/**
 * Template Name: User Profile
 *
 * Allow users to update their profiles from Frontend.
 *
 */
// echo get_user_meta(get_current_user_id(),'mepr_phone_number',);die;
/* Get user info. */
// echo do_shortcode('[avatar_upload]');
global $wpdb; 
$user_ID = get_current_user_id(); // get the user ID
$user = new MeprUser( get_current_user_id());
///$user_id = 123; // replace with the ID of the user you want to update
$phone_numbers = get_user_meta($user_ID,'mepr_phone_number',true); 

 $member = new MeprUser(); // initiate the class
 $member->ID = $user->ID; // if using this in admin area, you'll need this to make user id the member id
 $result = $member->get_active_subscription_titles("<br/>"); //MeprUser function that gets subscription title
 $txn = new MeprTransaction();
 //foreach($txn as $tx){

//  //}
if ( isset( $_POST['update_user_profile'] ) && $_POST['update_user_profile'] ) {
    // echo '<pre>'; print_r($_POST);die;
    $user_id = get_current_user_id();
  $user_data = array(
    'ID'           => $user_id,
    'user_email'   => $_POST['user_email'],
    'mepr_phone_number'  => $_POST['mepr_phone_number'],
    'mepr-address-one'  => $_POST['mepr_address_one'],
    'mepr-address-two'  => $_POST['mepr_address_two'],
    'mepr-address-city'  => $_POST['mepr_address_city'],
    'mepr-address-country'  => $_POST['mepr_address_country'],
    'mepr-address-state'  => $_POST['mepr_address_state'],
    'mepr-address-zip'  => $_POST['mepr_address_zip'],

   'first_name' => $_POST['first_name']
);

$phone_number = $_POST['mepr_phone_number'];
$address = $_POST['mepr_address_one'];
$address_one = $_POST['mepr_address_two'];
$city = $_POST['mepr_address_city'];
$country = $_POST['mepr_address_country'];
$zip_code = $_POST['mepr_address_zip'];

$states = $_POST['mepr_address_state'];

$country_code = $_POST['country_code']; 
$country_code_name = $_POST['country_code_name']; 
update_user_meta( $user_ID, 'phone_number', $phone_number );
update_user_meta( $user_ID, 'country_code', $country_code);
update_user_meta( $user_ID, 'country_code_name', $country_code_name );
// update the user meta field for the phone number with the country code
update_user_meta( $user_ID, 'mepr_phone_number', $country_code . $phone_number );
$pdatesss = update_user_meta( $user_id, 'mepr-address-one', $address );
$addpress_twos = update_user_meta( $user_id, 'mepr-address-two', $address_one );
$update_city = update_user_meta( $user_id, 'mepr_address_city', $city );
$update_country = update_user_meta( $user_id, 'mepr_address_country', $country );
$update_state = update_user_meta( $user_id, 'mepr_address_state', $states );
$update_zip = update_user_meta( $user_id, 'mepr_address_zip', $zip_code );
$country_code_name = update_user_meta( $user_id, 'country_code_name', $country_code_name );
//print_r($pdatesss);
$user_id = wp_update_user($user_data);
header('Location:'.site_url('my-account'));exit;
}
if(!empty( $_FILES['user_image'] )){
    echo '<pre>'; print_r($_FILES);die;
  require_once ABSPATH . '/wp-admin/includes/image.php';
  require_once(ABSPATH . "wp-admin" . '/includes/image.php');
  require_once(ABSPATH . "wp-admin" . '/includes/file.php');
  require_once(ABSPATH . "wp-admin" . '/includes/media.php');
      $file = $_FILES['user_image'];
				$name = isset( $file['name'] ) ? sanitize_file_name( $file['name'] ) : '';
				$type = isset( $file['type'] ) ? sanitize_mime_type( $file['type'] ) : '';
        if(!empty($name) || !empty($type)){
            $fileinfo = @getimagesize($_FILES["user_image"]["tmp_name"]);
            $allowed_image_extension = array(
                "png",
                "jpg",
                "jpeg"
            );
            $file_extension = pathinfo($_FILES["user_image"]["name"], PATHINFO_EXTENSION);
if (! in_array($file_extension, $allowed_image_extension)) {
        $response = array(
            "type" => "error",
            "message" => "Upload valiid images. Only PNG and JPEG are allowed."
        );
    }else if (($_FILES["file-input"]["size"] > 2000000)) {
        $response = array(
            "type" => "error",
            "message" => "Image size exceeds 2MB"
        );
    } else{

 
        $filesadas = wp_handle_upload( $file, array(
					'test_form' => false,
				) );
        $name_parts = pathinfo( $name );
        $name       = trim($name );
        $url        = $filesadas['url'];
        $file       = $filesadas['file'];
        $title      = $name;
        $attachment = array(
          'guid'			 => $url,
          'post_mime_type' => $type,
          'post_title'	 => $title,
          'post_content'	 => '',
        );
        $attachment_id = wp_insert_attachment( $attachment, $file );
       
        if ( isset( $attachment['ID'] ) ) {
          unset( $attachment['ID'] );
        }
        $user_id = get_current_user_id();

     if ( ! is_wp_error( $attachment_id ) ) {

        
							// Delete other uploads by user
							$q = array(
								'author'         => $user_id,
								'post_type'      => 'attachment',
								'post_status'    => 'inherit',
								'posts_per_page' => '-1',
								'meta_query'     => array(
									array(
										'key'     => '_wp_attachment_wp_user_avatar',
										'value'   => '',
										'compare' => '!=',
									),
								),
							);

							$avatars_wp_query = new WP_Query( $q );

							while ( $avatars_wp_query->have_posts() ){
								$avatars_wp_query->the_post();

								wp_delete_attachment($post->ID);
							}

							wp_reset_query();

							wp_update_attachment_metadata( $attachment_id, wp_generate_attachment_metadata( $attachment_id, $file ) );
							// Remove old attachment postmeta
							delete_metadata( 'post', null, '_wp_attachment_wp_user_avatar', $user_id, true );
							// Create new attachment postmeta
							update_post_meta( $attachment_id, '_wp_attachment_wp_user_avatar', $user_id );
							// Update usermeta
							update_user_meta( $user_id, $wpdb->get_blog_prefix( $blog_id ) . 'user_avatar', $attachment_id );
                            header('Location:'.site_url('my-account'));exit;
						}
          }
        } 
}

?>

<section class="my_account_sec">

    <?php if(!empty($response)) { ?>
    <div class="response <?php echo $response["type"]; ?>"><?php echo $response["message"]; ?></div>
    <?php }?>
    <form id="contactForm1s" method="post" enctype="multipart/form-data">
        <div class="my_account_bg">
            <div class="container">
                <div class="my_account_head">
                    <h1>Edit Account</h1>
                </div>
                <input type="hidden" name="admin_url" id="admin_url_edit_page" value="<?php echo admin_url( 'admin-ajax.php' );?>">
                <input type="hidden" name="ajax_action" id="ajax_action" value="append_state_functionalty">

                <div class="edit_profiel">
                    <img id="img-preview" src="<?php echo esc_url( get_avatar_url( $current_user->ID ) ); ?>" alt="" />
                    <div class="img_upload">
                        <label for="img_upload" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Only PNG and JPEG file types and a 2MB maximum image size are allowed."><img
                                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/edit-img.png"
                                alt="" /></label>
                        <input type="file" name="user_image" id="img_upload" class="d-none" onchange="readURL(this)" />
                    </div>
                </div>
            </div>
        </div>
        <div class="profiel_details edit_profiel_details bg_style"
            style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/my_account_bg.png')">
            <div class="container">
            <div id="append_data"> </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="profiel_details_crd">
                            <h6>Name</h6>
                            <div class="edit_profiles">
                                <img src="<?php echo site_url('wp-content/themes/Dual-Nationals/assets/img/edit.png');?>"
                                    alt="">
                                <input type="text" class="max_state" name="first_name"
                                    value="<?php echo esc_attr(get_the_author_meta('first_name', get_current_user_id())); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="profiel_details_crd">
                            <h6>Email</h6>

                            <input type="email" name="user_email" readonly
                                value="<?php echo esc_attr(get_the_author_meta('user_email', get_current_user_id())); ?>">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="profiel_details_crd">
                            <h6>Phone Number</h6>
                            <div class="edit_profiles">
                                <img src="<?php echo site_url('wp-content/themes/Dual-Nationals/assets/img/edit.png');?>"
                                    alt="">
                                <input type="tel" id="mobile" name="mepr_phone_number"
                                    value="<?php echo $phone_numbers; ?>"maxlength="10">
                                <input type="hidden" id="country_code" name="country_code"
                                    value="<?php echo get_user_meta(get_current_user_id(),'country_code',true);?>">
                                <input type="hidden" id="country_code_name" name="country_code_name"   value="<?php echo get_user_meta(get_current_user_id(),'country_code_name',true);?>">\
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="profiel_details_crd">
                            <h6>Membership</h6>

                            <?php if($result){?>
                            <p class="image_edit"><a href="/plans-pricing">
                                    <img src="<?php echo site_url('wp-content/themes/Dual-Nationals/assets/img/edit.png');?>"
                                        alt="">
                                </a><?php echo $result;?></p>

                            <?php
                        } else {
                           ?>
                            <p>You dont have any membership</p><a href="<?php echo site_url('plans-pricing');?>">Click Here </a><span style="color:wight">to buy membership</span>
                            <?php
                        }
                        ?>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="profiel_details_crd">
                            <h6>Billing Info</h6>
                            <a href="/plans-pricing"><img
                                    src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/edit.png"
                                    alt="" />Credit Card</a>
                            <a href="/plans-pricing/"><img
                                    src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/edit.png"
                                    alt="" />Other Payment</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="profiel_details_crd">
                            <h6>Billing Address Line 1:*</h6>
                            <div class="edit_profiles">
                                <img src="<?php echo site_url('wp-content/themes/Dual-Nationals/assets/img/edit.png');?>"
                                    alt="">
                                <input type="text" name="mepr_address_one"
                                    value="<?php echo get_user_meta(get_current_user_id(),'mepr-address-one',true); ?>"
                                    autocomplete="on">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="profiel_details_crd">
                            <h6>Billing Address Line 2:</h6>
                            <div class="edit_profiles">
                                <img src="<?php echo site_url('wp-content/themes/Dual-Nationals/assets/img/edit.png');?>"
                                    alt="">
                                <input type="text" name="mepr_address_two"
                                    value="<?php echo get_user_meta(get_current_user_id(),'mepr-address-two',true) ;?>"
                                    autocomplete="on">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="profiel_details_crd">
                            <h6>City:*</h6>
                            <div class="edit_profiles">
                                <img src="<?php echo site_url('wp-content/themes/Dual-Nationals/assets/img/edit.png');?>"
                                    alt="">
                                <input type="text" name="mepr_address_city" class="max_state"
                                    value="<?php echo get_user_meta(get_current_user_id(),'mepr-address-city',true) ;?>"
                                    autocomplete="on">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="profiel_details_crd">
                            <h6>Country:*</h6>
                            <div class="edit_profiles">
                                <img src="<?php echo site_url('wp-content/themes/Dual-Nationals/assets/img/edit.png');?>"
                                    alt="">
                                <input hidden type="text" id="selected_countries" class="max_state"
                                    value="<?php echo get_user_meta(get_current_user_id(),'mepr-address-country',true) ;?>"
                                    autocomplete="on">
                                <select id="country" name="mepr_address_country">
                                    <?php
                                  $result_counties = $wpdb->get_results ( "SELECT * FROM wp_countries WHERE flag = 1 ORDER BY name ASC");
                                  foreach ($result_counties as $key => $value) {
                                    $cou= get_user_meta(get_current_user_id(),'mepr-address-country',true);
                                    $selected = (isset($cou) && $cou ==  $value->name) ? 'selected' : ''; ?>
                                    <option value="<?php echo $value->name;?>" id="<?php echo $value->id;?>"
                                        iso2="<?php echo strtolower($value->iso2);?>" <?php echo  $selected;?>>
                                        <?php echo $value->name;?></option>
                                    <?php  } ?>
                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="profiel_details_crd">
                            <h6>State/Province:*</h6>
                            <div class="edit_profiles">
                               
                                <input hidden id="state_name_list" type="text"
                                    value="<?php echo get_user_meta(get_current_user_id(),'mepr-address-state',true) ;?>">
                                <div id="stete"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="profiel_details_crd">
                            <h6>Zip/Postal Code:*</h6>
                            <div class="edit_profiles">
                                <img src="<?php echo site_url('wp-content/themes/Dual-Nationals/assets/img/edit.png');?>"
                                    alt="">
                                <input type="text" class="field_max" name="mepr_address_zip"
                                    value="<?php echo get_user_meta(get_current_user_id(),'mepr-address-zip',true) ;?>"
                                    autocomplete="on">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="edit_profiel_btn text-center">
                    <a href="/account/?action=subscriptions" class="theme_btn cancel_btn">Cancel Subscriptions</a>
                    <input type="submit" class="theme_btn" name="update_user_profile" value="Save">
                </div>

            </div>
        </div>
    </form>
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
                   
                    global $wpdb;
                    $tablename = $wpdb->prefix.'Wishlist_data_list';
                    $user_id = get_current_user_id();
                     $results = $wpdb->get_results ("SELECT * FROM  $tablename where User_id = $user_ID ");
                     foreach ($results as  $detail_item) {
                      $id = $detail_item->id;
                      $playerProfile = $detail_item->playerProfile;
                      $json_decodes = json_decode($playerProfile , true);
                    
                      $playerImage = $json_decodes['playerImage'];
                      $playerName  = $json_decodes['playerName'];
                      $club =    $json_decodes['club'];
                      $clubImage   =  $json_decodes['clubImage'];
                      $birthplaceCountryImage = $json_decodes['birthplaceCountryImage'];
                      $marketValue = $json_decodes['marketValue'];
                      $age   =   $json_decodes['age'];
                    
                    //}
                    ?>
                        <tr>
                            <td>
                                <div class="player_data">
                                    <div class="pla_yer_img">
                                        <img src="<?php echo $playerImage; ?>" alt="">
                                    </div>
                                    <div class="pla_yer_name">
                                        <h6><?php echo $playerName ; ?></h6>
                                        <p><?php echo $club;?></p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <img class="watchlist_club_logo" src="<?php echo $clubImage; ?>" alt="">
                            </td>
                            <td><?php echo $age;?></td>
                            <td>
                                <img class="bith_img" src="<?php echo $birthplaceCountryImage ;?>" alt="">
                            </td>
                            <td><?php echo $marketValue;?></td>
                            <td>
                                <button class="trash" id="<?php echo $id;?>">


                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/trash.png" alt="">

                                </button>
                            </td>
                        </tr>
                        <?php 

                    } ?>
                        <script>
                        // jQuery('#mobile').mouseleave(function(e) {
                        //     // if (!jQuery('#mobile').val().match('[0-9]{10}')) {
                        //     //     swal("Please put 10 digit mobile number", {
                        //     //         icon: "warning",

                        //     //     });
                        //     //     $(':input[type="submit"]').prop('disabled', true);
                        //     // }
                        //     // if (jQuery('#mobile').val().match('[0-9]{10}')) {
                        //     //     $(':input[type="submit"]').prop('disabled', false);
                        //     // }
                        // });
                        jQuery('.trash').on('click', function(event) {
                            event.preventDefault();
                            var id = $(this).attr('id');
                            swal({
                                title: "Are you sure!",
                                text: "Do you really want to remove this wishlist?",
                                buttons: true,
                                icon: "success",
                                dangerMode: true,
                            }).then((willDelete) => {
                                if (willDelete) {
                                    swal("Yaa! wishlist successfully deleted!", {
                                        icon: "success",
                                    });
                                    jQuery.ajax({
                                        url: ' <?php echo get_stylesheet_directory_uri()."/delete.php";?>',
                                        method: 'POST',
                                        data: {
                                            id: id
                                        },
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
<?php
}else{
    wp_redirect( "/login", 301 );
  
  } ?>
<?php
get_footer();
?>