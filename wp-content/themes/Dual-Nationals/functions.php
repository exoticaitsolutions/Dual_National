<?php 

function PREFIX_remove_scripts() {
    wp_dequeue_style( 'parent-style' );
    wp_deregister_style( 'parent-style' );
    wp_dequeue_style( 'twenty-twenty-one-print-style' );
   wp_deregister_style( 'twenty-twenty-one-print-style' );
 
    // Now register your styles and scripts here
 }
 add_action( 'wp_enqueue_scripts', 'PREFIX_remove_scripts', 20 );






 function styleAndScripts() {
    wp_enqueue_style( 'all', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css');
    wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() . '/assets/css/slick.css');
     wp_enqueue_style( 'theme-css', get_stylesheet_directory_uri() . '/assets/css/slick-theme.css');
     wp_enqueue_style( 'bootstrap-min', get_stylesheet_directory_uri() . '/assets/css/dataTables.bootstrap5.min.css');
     wp_enqueue_style( 'main-css', get_stylesheet_directory_uri() . '/assets/css/main.css');
     wp_enqueue_style( 'toastr-css', get_stylesheet_directory_uri() . '/assets/css/toastr.min.css');
     wp_enqueue_style( 'intlTelInput-css', get_stylesheet_directory_uri() . '/assets/css/intlTelInput.css');
     wp_enqueue_style( 'bootstrap-toaster-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap-toaster.css');
     wp_enqueue_style( 'fnon-min-css', get_stylesheet_directory_uri() . '/assets/css/fnon.min.css');


  
    //   wp_enqueue_script( 'cdnscr1','//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js');
    //   wp_enqueue_script( 'slicks2', get_stylesheet_directory_uri() . '/assets/js/bootstrap.bundle.min.js');  
    //   wp_enqueue_script( 'slicks22', get_stylesheet_directory_uri() . '/assets/js/slick.min.js'); 
    //   wp_enqueue_script( 'slicks222', get_stylesheet_directory_uri() . '/assets/js/main.js');  
    //   //wp_enqueue_script( 'lightbox', get_stylesheet_directory_uri() . '/assets/js/lightbox.js');
    //   wp_enqueue_script( 'custom-progressbar', get_stylesheet_directory_uri() . '/assets/js/jQuery-plugin-progressbar.js');
  }
  
  //add_action( 'wp_enqueue_scripts', 'styleAndScripts');














   include(dirname(__FILE__) . "/inc/custom-post-types.php");
 include(dirname(__FILE__) . "/inc/ajax.php");
 include(dirname(__FILE__) . "/inc/Apis-function.php");
  add_action( 'wp_enqueue_scripts', 'arisa_child_enqueue_styles' );
  function arisa_child_enqueue_styles() {
    //fontawesome
        wp_enqueue_style( 'all.min.css', get_template_directory_uri() . '/assets/all.min.css' ,array(), rand(111,9999)); 
        // bootstrap.min.css
        wp_enqueue_style( 'bootstrap.min.css', get_template_directory_uri() . '/assets/bootstrap.min.css',array()); 
            } 
        add_action( 'wp_enqueue_scripts', 'wiio_child_theme_style' );
       
             function wiio_child_theme_style() {
                 
                // wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/assets/main.css', array(), rand(111,9999), 'all' );
                 
             }

             if ( ! function_exists( 'mytheme_register_nav_menu' ) ) {

                function mytheme_register_nav_menu(){
                    register_nav_menus( array(
                        'primary_footer_leftmenu' => __( 'Footer Left', 'text_domain' ),
                        'footer_right'  => __( 'Footer Right', 'text_domain' ),
                        'footer_bootom'  => __( 'Footer Bootom', 'text_domain' ),
                        'seconday_header'  => __( 'Secondary Header', 'text_domain' ),
                        'seconday_footer_left'  => __( 'Secondary Footer Left', 'text_domain' ),
                        'seconday_footer_right'  => __( 'Secondary Footer Right', 'text_domain' ),
                        
                    ) );
                }
                add_action( 'after_setup_theme', 'mytheme_register_nav_menu', 0 );
            }


            if (current_user_can('administrator')) {
               if( function_exists('acf_add_options_page') ) { include(dirname(__FILE__) . "/inc/option-page.php");}
            
            }
            function wp_exist_post_by_title($title_str) {
                global $wpdb;
                return $wpdb->get_row( $wpdb->prepare( "SELECT * FROM " . $wpdb->posts . " WHERE post_title = '" . $title_str . "'" ), 'ARRAY_A')['ID'];
            }

            function fatch_players_by_player_id_using_acf() {
                if (strpos(get_current_screen()->id, "acf-options-player-stats") == true) {
                    $header = ['X-RapidAPI-Host: transfermarket.p.rapidapi.com','X-RapidAPI-Key: '.get_field('transfermarket_api', 'option') .'', 'Content-Type: application/json'];
                     $url = get_field('transfermarket_api_base_url_', 'option')."/players/get-profile?id=".get_field('player_id', 'option')."&domain=".get_field('transfermarket_api_domain_', 'option');
                     $curl_requst = json_decode(Curl_Api_Requst($url,'GET','',$header));  
                     $performance_url =  get_field('transfermarket_api_base_url_', 'option')."/players/get-performance-summary?id=".get_field('player_id', 'option')."&domain=".get_field('transfermarket_api_domain_', 'option');
                     $peromnce = json_decode(Curl_Api_Requst($performance_url,'GET','',$header));  
                    //  echo '<pre>'; print_r($peromnce);die;   
                    if (!empty($curl_requst)) {
                        $post_id = wp_exist_post_by_title($curl_requst->playerProfile->playerName);
                        if(empty($post_id)){
                            $post_array = array(
                                'post_title'=> $curl_requst->playerProfile->playerName, 
                                'post_type'=>'footballs_player', 
                                'post_content'=>$curl_requst->share->description,
                                'post_status' => 'publish',
                            );
                            $post_id = wp_insert_post($post_array);
                        }                 
                        add_post_meta($post_id, 'share', wp_json_encode($curl_requst->share));
                        add_post_meta($post_id, 'playerProfile', wp_json_encode($curl_requst->playerProfile));
                        add_post_meta($post_id, 'performanceSeasons', wp_json_encode($curl_requst->performanceSeasons));
                        add_post_meta($post_id, 'heroImages', wp_json_encode($curl_requst->heroImages)); 
                        add_post_meta($post_id, 'competitionPerformanceSummery', wp_json_encode($peromnce)); 
                    }
                }              
            }
            add_action('acf/save_post', 'fatch_players_by_player_id_using_acf', 20);
         

            function wp_api_credentials($keynaem){
                global $wpdb;
                $table = $wpdb->prefix.'api_credentials';
                return  $wpdb->get_results('SELECT * FROM '.$table.' where name="'.$keynaem.'"');
            }

                function wpb_set_post_views($postID) {
                    $count_key = 'wpb_post_views_count';
                    $count = get_post_meta($postID, $count_key, true);
                    if($count==''){
                        $count = 0;
                       //delete_post_meta($postID, $count_key);
                        add_post_meta($postID, $count_key, '0');
                    }else{
                        $count++;
                        update_post_meta($postID, $count_key, $count);
                    }
                }
                //To keep the count accurate, lets get rid of prefetching
                remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

                function wpb_track_post_views ($post_id) {
                    if ( !is_single() ) return;
                    if ( empty ( $post_id) ) {
                        global $post;
                        $post_id = $post->ID;    
                    }
                    wpb_set_post_views($post_id);
                }
                add_action( 'wp_head', 'wpb_track_post_views');
                function wpb_get_post_views($postID){
                    $count_key = 'wpb_post_views_count';
                    $count = get_post_meta($postID, $count_key, true);
                    // print_r($count);
                    // die;
                    if($count==''){
                       // delete_post_meta($postID, $count_key);
                        add_post_meta($postID, $count_key, '0');
                        return "0 View";
                    }
                    return $count.' Views';
                }                



                /*
* Creating a function to create our CPT
*/
  
function custom_post_typere() {
  
    // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Football players', 'Post Type General Name', 'twentytwentyone' ),
            'singular_name'       => _x( 'Football players', 'Post Type Singular Name', 'twentytwentyone' ),
            'menu_name'           => __( 'Football players ', 'twentytwentyone' ),
            'parent_item_colon'   => __( 'Parent Football players', 'twentytwentyone' ),
            'all_items'           => __( 'All Football players', 'twentytwentyone' ),
            'view_item'           => __( 'View Football players', 'twentytwentyone' ),
            'add_new_item'        => __( 'Add New Football players', 'twentytwentyone' ),
            'add_new'             => __( 'Add New', 'twentytwentyone' ),
            'edit_item'           => __( 'Edit Football players', 'twentytwentyone' ),
            'update_item'         => __( 'Update Football players', 'twentytwentyone' ),
            'search_items'        => __( 'Search Football players', 'twentytwentyone' ),
            'not_found'           => __( 'Not Found', 'twentytwentyone' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwentyone' ),
        );
          
    // Set other options for Custom Post Type
          
        $args = array(
            'label'               => __( 'Football players', 'twentytwentyone' ),
            'description'         => __( 'Football players news and reviews', 'twentytwentyone' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
            'taxonomies'          => array( 'genres' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest' => true,
      
        );
          
        // Registering your Custom Post Type
        register_post_type( 'Footballs_Player', $args );
      
    }
      
    /* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */
      
    add_action( 'init', 'custom_post_typere', 0 );



    // function my_logged_in_redirect() {
     
    //     if ( !is_user_logged_in() && is_page( 366 ) ) 
    //     {
    //         wp_redirect( get_permalink( 524 ) );
    //         die;
    //     }
         
    // }
    // add_action( 'template_redirect', 'my_logged_in_redirect' );


  
    
    
    function Save_wish_list_data(){
         // echo "ASdsadasdas";die;?
        header('Content-Type: application/json');
        global $wpdb;
        $table = $wpdb->prefix.'Wishlist_data_list';
        $player_id =trim($_POST['player_id']);
        $current_user_id =trim($_POST['current_user_id']);
        $wishlist_exit =trim($_POST['wishlist_exit']);
        $wishlist_id =trim($_POST['wishlist_id']);
        if (is_user_logged_in() == true && is_user_logged_in() == 1) {
            if (!empty($wishlist_id)) {
                $deleted_requst =  $wpdb->delete($table,array( 'id' => $wishlist_id ) );
                echo ($deleted_requst) ? json_encode(array('status' => 204, 'message' => 'Player successfully Removed in Watchlist','wishlist_exit'=>false ,'wishlist_id'=>'')) : json_encode(array('status' => 500, 'message' => 'SomeThing Wrong')) ;wp_die();
            }else{
                // $wishlist_count =  (int) get_user_meta( $current_user_id, 'wishlist_limit',true);
                $wishlist_count =  19;
                $num_rows =  (int) $wpdb->get_var('SELECT COUNT(*) FROM `'.$table.'` WHERE `User_id`='.$current_user_id.'');
                if ($wishlist_count === $num_rows || $wishlist_count >= $num_rows) {
                    
                    // echo "asdsadsad";die;
                    $fech_players_data = $wpdb->get_row("SELECT * FROM $table where Player_id=".$player_id." AND User_id=".$current_user_id."");
                    if($fech_players_data){
                        echo json_encode(array('status' => 200 , 'message' => 'This player is already in Watchlist for this User  '));   wp_die( );
                    }else{
                    $url2 = get_field('transfermarket_api_base_url_', 'option')."/players/get-profile?id=$player_id&domain=".get_field('transfermarket_api_domain_', 'option');
                    $header1 = ['X-RapidAPI-Host: transfermarket.p.rapidapi.com','X-RapidAPI-Key: '.get_field('transfermarket_api', 'option') .'', 'Content-Type: application/json'];

                    $playerProfile = $wpdb->get_results( "SELECT * FROM wp_player_details WHERE id = $player_id" );
                    // echo '<pre>';
                    // print_r($playerProfile);
                    //$playerProfile = json_decode(Curl_Api_Requst($url2,'GET','',$header1) ,true)['playerProfile'];
                    $json_daa_reqest = array('Player_id' => $player_id??null, 'User_id' => $current_user_id??null, 'playerProfile' =>  wp_json_encode($playerProfile)??null);
                    $wpdb->insert($table,$json_daa_reqest);
                    $my_id = $wpdb->insert_id;
                    echo ($my_id) ? json_encode(array('status' => 201, 'message' => 'Player successfully added in Watchlist' ,'wishlist_exit'=>true ,'wishlist_id'=>$my_id)) : json_encode(array('status' => 500, 'message' => 'SomeThing Wrong')) ;wp_die();
                    }                   
                }else{
                    // echo "json_encode";die;

                    echo json_encode(array('status' => 403 , 'message' => "Sorry, you've reached the maximum limit of players that you can add to your Watchlist. To add a new player, please remove one from your current Watchlist first.")); wp_die();
                }
            }
        }else{
            echo json_encode(array('status' => 401, 'message' => 'Unable to add Player In Watchlist Please Login '));  wp_die();
        }
    }

 

    function convert_country_name_to_code($country_name) {
 
        global $wpdb;
        $table = $wpdb->prefix.'countries';
        
        $record = $wpdb->get_row("SELECT * FROM  $table WHERE `name` = '".ucfirst($country_name)."'");
        return $record->iso2;
      }



      add_action('check_admin_referer', 'logout_without_confirm', 10, 2);
      function logout_without_confirm($action, $result)
      {
          /**
           * Allow logout without confirmation
           */
          if ($action == "log-out" && !isset($_GET['_wpnonce'])) {
              $redirect_to = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : site_url( );
              $location = str_replace('&amp;', '&', wp_logout_url($redirect_to));
              header("Location: $location");
              die;
          }
      }



      function append_wishlist_table_by_perticular_user(){
        if (is_user_logged_in() == true && is_user_logged_in() == 1) {
            global $wpdb;
            $table = $wpdb->prefix.'Wishlist_data_list';
            $fetch_all_football_player = $wpdb->get_row("SELECT * FROM $table where  User_id=". get_current_user_id()."");
            if($fetch_all_football_player){
            ob_start();
            include_once  get_stylesheet_directory() . '/pages/layout/append_wishlist_data.php';
            return ob_get_clean();
            }
        }
      }
      add_shortcode('append_wishlist_table', 'append_wishlist_table_by_perticular_user');

function country_state_fucntionlty_on_edit_page(){
    
    header('Content-Type: application/json');
    global $wpdb;    
    $selected_state =trim($_POST['selected_state']);
    $name =trim($_POST['country_name']);
    $iso2 =trim($_POST['country_id']);
    $result_state = $wpdb->get_results ("SELECT * FROM wp_states WHERE country_id = ".$iso2." AND flag = 1 ORDER BY name ASC");
    include_once  get_stylesheet_directory() . '/pages/ajax/populate_state_on_the_basis_contries.php';
    $response['content'] = ob_get_clean();
    echo wp_json_encode($response);wp_die( );
}

//  Login Functionalty  In 


function login_form_submisssion(){
    $login_email = sanitize_text_field($_REQUEST['user_login']);
    $login_pass = sanitize_text_field($_REQUEST['user_pass']);
    $rememberme = sanitize_text_field($_REQUEST['remember']);
    $user = wp_signon(array(
        'user_login'    => $login_email,
        'user_password' =>  $login_pass ,
        'remember'      =>  $rememberme
    ), false );

    if ( is_wp_error( $user ) ) {
        $responsedaya['type'] ='error';
        $responsedaya['message'] =$user->get_error_message();
        $responsedaya['url'] ='';
    }else{
        $responsedaya['type'] ='true';
        $responsedaya['message'] ='Login Successfully';  
        //$responsedaya['url'] =site_url(); 
        $responsedaya['url'] = site_url( '/homepage2/', 'https' );
         
    }
    echo wp_json_encode($responsedaya);wp_die( );
}

add_action( 'wp_logout', 'auto_redirect_user_after_logout');
function auto_redirect_user_after_logout(){
  wp_redirect( 'https://dualnationals.com/homepage2' );
  exit();
}

add_filter( 'mepr-checkout-paypal-powered-by', '__return_false' );
add_action( 'wp_enqueue_scripts', 'my_enqueue' );
function my_enqueue()
{
    wp_enqueue_script( 'ajax-script', plugins_url( 'js/formAdd_.js', __FILE__ ), array( 'jquery' ) );

    wp_localize_script( 'ajax-script', 'ajax_object', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'we_value' => 'test'
    ) );
}


function dcsAjaxCallFormSubmit(){
    global $wpdb; 
    header('Content-Type: application/json');
    $user_id = get_current_user_id();
    if ( isset( $_POST ) && $_POST ) {
        // echo '<pre>'; print_r($_POST);die;
        $phone_number = $_POST['mepr_phone_number'];
        $address = $_POST['mepr_address_one'];
        $address_one = $_POST['mepr_address_two'];
        $city = $_POST['mepr_address_city'];
        $country = $_POST['mepr_address_country'];
        $zip_code = $_POST['mepr_address_zip'];
        
        $states = $_POST['mepr_address_state'];
        
        $country_code = $_POST['country_code']; 
        $country_code_name = $_POST['country_code_name']; 
            $user_id = get_current_user_id();
          $user_data = array(
            'ID'           => $user_id,
            'first_name' => strtok($_POST['first_name'], ' '),
            'last_name' => strstr($_POST['first_name'], ' '),
            'display_name'   => $_POST['first_name'],
            'user_email'   => $_POST['user_email'],
            'mepr_phone_number'  => $country_code . $phone_number ,
            'mepr-address-one'  => $_POST['mepr_address_one'],
            'mepr-address-two'  => $_POST['mepr_address_two'],
            'mepr-address-city'  => $_POST['mepr_address_city'],
            'mepr-address-country'  => $_POST['mepr_address_country'],
            'mepr-address-state'  => $_POST['mepr_address_state'],
            'mepr-address-zip'  => $_POST['mepr_address_zip'],
        );
        
            // echo '<pre>'; print_r($user_data);die;
        
        update_user_meta( $user_id, 'phone_number', $phone_number );
        update_user_meta( $user_id, 'country_code', $country_code);
        update_user_meta( $user_id, 'country_code_name', $country_code_name );
        update_user_meta( $user_id, 'mepr_phone_number', $country_code . $phone_number );
        $pdatesss = update_user_meta( $user_id, 'mepr-address-one', $address );
        $addpress_twos = update_user_meta( $user_id, 'mepr-address-two', $address_one );
        $update_city = update_user_meta( $user_id, 'mepr-address-city', $city );
        $update_country = update_user_meta( $user_id, 'mepr-address-country', $country );
        $update_state = update_user_meta( $user_id, 'mepr-address-state', $states );
        $update_zip = update_user_meta( $user_id, 'mepr-address-zip', $zip_code );
        $user_id = wp_update_user($user_data);
        if(!empty( $_FILES['user_image'] )){
            require_once ABSPATH . '/wp-admin/includes/image.php';
            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
            require_once(ABSPATH . "wp-admin" . '/includes/file.php');
            require_once(ABSPATH . "wp-admin" . '/includes/media.php');
            $file = $_FILES['user_image'];
            $name = isset( $file['name'] ) ? sanitize_file_name( $file['name'] ) : '';
            $type = isset( $file['type'] ) ? sanitize_mime_type( $file['type'] ) : '';
            if(!empty($name) || !empty($type)){
                $filesadas = wp_handle_upload( $file, array(    'test_form' => false,) );
                $name_parts = pathinfo( $name );
                $name       = trim($name );
                $url        = $filesadas['url'];
                $file       = $filesadas['file'];
                $title      = $name;
                $attachment = array(
                    'guid'           => $url,
                    'post_mime_type' => $type,
                    'post_title'     => $title,
                    'post_content'   => '',
                  );
                  $attachment_id = wp_insert_attachment( $attachment, $file );
                  if ( isset( $attachment['ID'] ) ) {  unset( $attachment['ID'] );  }
                  if ( ! is_wp_error( $attachment_id ) ) {

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
                    delete_metadata( 'post', null, '_wp_attachment_wp_user_avatar', $user_id, true );
                    update_post_meta( $attachment_id, '_wp_attachment_wp_user_avatar', $user_id );
                    update_user_meta( $user_id, $wpdb->get_blog_prefix( $blog_id ) . 'user_avatar', $attachment_id );

                    echo json_encode(array('status' => 201 , 'message' => "Your Data is successfully Updated" ,'redirct_url' => site_url('my-account'))); wp_die();
                }


            }else{
                echo json_encode(array('status' => 201 , 'message' => "Your Data is successfully Updated" ,'redirct_url' => site_url('my-account'))); wp_die();
            }
        }

    }
//     // echo "asdsadsadsa";die;
//    
//   
//         $phone_number = $_POST['mepr_phone_number'];
//         $address = $_POST['mepr_address_one'];
//         $address_one = $_POST['mepr_address_two'];
//         $city = $_POST['mepr_address_city'];
//         $country = $_POST['mepr_address_country'];
//         $zip_code = $_POST['mepr_address_zip'];
        
//         $states = $_POST['mepr_address_state'];
        
//         $country_code = $_POST['country_code']; 
//         $country_code_name = $_POST['country_code_name']; 
//         $user_data = array(
//             'ID'           => $user_id,
//             'first_name' => strtok($_POST['first_name'], ' '),
//             'last_name' => strstr($_POST['first_name'], ' '),
//             'display_name'   => $_POST['first_name'],
//             'user_email'   => $_POST['user_email'],
//             'mepr_phone_number'  => $country_code . $phone_number,
//             'mepr-address-one'  => $_POST['mepr_address_one'],
//             'mepr-address-two'  => $_POST['mepr_address_two'],
//             'mepr-address-city'  => $_POST['mepr_address_city'],
//             'mepr-address-country'  => $_POST['mepr_address_country'],
//             'mepr-address-state'  => $_POST['mepr_address_state'],
//             'mepr-address-zip'  => $_POST['mepr_address_zip'],
//         );
//         echo '<pre>'; print_r($user_data);die;

// update_user_meta( $user_id, 'phone_number', $phone_number );
// update_user_meta( $user_id, 'country_code', $country_code);
// update_user_meta( $user_id, 'country_code_name', $country_code_name );
// update_user_meta( $user_id, 'mepr_phone_number', $country_code . $phone_number );
// $pdatesss = update_user_meta( $user_id, 'mepr-address-one', $address );
// $addpress_twos = update_user_meta( $user_id, 'mepr-address-two', $address_one );
// $update_city = update_user_meta( $user_id, 'mepr-address-city', $city );
// $update_country = update_user_meta( $user_id, 'mepr-address-country', $country );
// $update_state = update_user_meta( $user_id, 'mepr-address-state', $states );
// $update_zip = update_user_meta( $user_id, 'mepr-address-zip', $zip_code );
// $user_id = wp_update_user($user_data);
// if(!empty( $_FILES['user_image'] )){
//     require_once ABSPATH . '/wp-admin/includes/image.php';
//     require_once(ABSPATH . "wp-admin" . '/includes/image.php');
//     require_once(ABSPATH . "wp-admin" . '/includes/file.php');
//     require_once(ABSPATH . "wp-admin" . '/includes/media.php');
//     $file = $_FILES['user_image'];
//     $name = isset( $file['name'] ) ? sanitize_file_name( $file['name'] ) : '';
//  $type = isset( $file['type'] ) ? sanitize_mime_type( $file['type'] ) : '';
//     if(!empty($name) || !empty($type)){
//         $fileinfo = @getimagesize($_FILES["user_image"]["tmp_name"]);
//         $filesadas = wp_handle_upload( $file, array(
//             'test_form' => false,
//         ) );
// $name_parts = pathinfo( $name );
// $name       = trim($name );
// $url        = $filesadas['url'];
// $file       = $filesadas['file'];
// $title      = $name;
// $attachment = array(
//   'guid'          => $url,
//   'post_mime_type' => $type,
//   'post_title'    => $title,
//   'post_content'  => '',
// );
// $attachment_id = wp_insert_attachment( $attachment, $file );
// if ( isset( $attachment['ID'] ) ) {
//     unset( $attachment['ID'] );
//   }
//   $user_id = get_current_user_id();
//   if ( ! is_wp_error( $attachment_id ) ) {
//     $q = array(
//         'author'         => $user_id,
//         'post_type'      => 'attachment',
//         'post_status'    => 'inherit',
//         'posts_per_page' => '-1',
//         'meta_query'     => array(
//             array(
//                 'key'     => '_wp_attachment_wp_user_avatar',
//                 'value'   => '',
//                 'compare' => '!=',
//             ),
//         ),
//     );
//     $avatars_wp_query = new WP_Query( $q );
//     while ( $avatars_wp_query->have_posts() ){
//         $avatars_wp_query->the_post();
//         wp_delete_attachment($post->ID);
//     }

//     wp_reset_query();

//   }


//         echo json_encode(array('status' => 201 , 'message' => "Your Data is successfully Updated")); wp_die();
//     }else{
//         echo json_encode(array('status' => 200 , 'message' => "Your Data is successfully Updated")); wp_die();
//     }

// }
      

//     }
}

//  check_user_email

function Login_fucntionalty(){
    header('Content-Type: application/json');

    $email = $_REQUEST['log'];
    $pwd = $_REQUEST['pwd'];
    $redirect_to = $_REQUEST['redirect_to'];
    $mepr_process_login_form = $_REQUEST['mepr_process_login_form'];
    $mepr_is_login_page = $_REQUEST['mepr_is_login_page'];
    $user = get_user_by('email',   $email);
    if(!empty($user)){
        $creds = array('user_login'    => $email ,'user_password' => $pwd,'remember'  => ($_REQUEST['rememberme'] =='forever') ? true : false );
        $user = wp_signon( $creds, false );
        if ( is_wp_error( $user ) ) {
            echo json_encode(array('status' => 401  , 'message' => "Password is invalid" ,'redirect_url' => '' )); wp_die();
        }else{
            echo json_encode(array('status' => 200  , 'message' => $user->get_error_message() ,'redirect_url' => $redirect_to  )); wp_die();
        }
    }else{
        echo json_encode(array('status' => 403  , 'message' =>'Your Email is not exist' ,'redirect_url' => '' )); wp_die();
    }

 
}


function check_user_and_mail_by_user(){
    header('Content-Type: application/json');
    echo (!empty(get_user_by('email',  $_REQUEST['mepr_user_or_email']))) ? '' : json_encode(array('status' => false  , 'message' => 'this Email is not found in our system')) ;
    wp_die();
}


function my_filter_plugin_updates( $value ) {
    if( isset( $value->response['memberpress/memberpress.php'] ) ) {        
       unset( $value->response['memberpress/memberpress.php'] );
     }
     return $value;
  }
  add_filter( 'site_transient_update_plugins', 'my_filter_plugin_updates' );

  function my_filter_plugin_updatesnew( $value ) {
    if( isset( $value->response['advanced-custom-fields-pro/acf.php'] ) ) {        
       unset( $value->response['advanced-custom-fields-pro/acf.php'] );
     }
     return $value;
  }
  add_filter( 'site_transient_update_plugins', 'my_filter_plugin_updatesnew' );



  /** Add Memberpress css */
  function mepr_change_stripe_text_color($style) {
   
    $style['variables']['colorText'] = 'white';
    $style['variables']['colorBackground'] = '#2D2E31';
    $style['variables']['borderRadius'] = '0px';
    $style['variables']['spacingGridRow'] = '20px';
    $style['variables']['spacing1'] = '10px';
    //print_r($style);
    
    return $style;
}
add_filter('mepr-stripe-elements-appearance', 'mepr_change_stripe_text_color');

//var(--spacingGridRow)



// function wpf_dev_stripe_card_field_style( $element_style ) {
     
//     $element_style = [
//         'base' => [
//             'iconColor' => '#b95d52',
//             'fontFamily' => 'Roboto, sans-serif',
//             'fontSize' => '16px',
//             'fontWeight' => '100',
//             'backgroundColor' => '#f6f6f6',
//             '::placeholder' => [
//                     'color' => '#b95d52',
//                     'font-family' => 'Roboto, sans-serif',
//                     'font-size' => '16px',
//                     'font-weight' => '100',
//             ]
//         ],
//     ];
     
//     return $element_style;
// }
 
// add_filter( 'mepr-stripe-elements-appearance', 'wpf_dev_stripe_card_field_style', 10, 1 );

// webhook handler
function mepr_capture_completed_transaction($event) {
 //   echo '<pre>'; print_r($event);die;
    $transaction = $event->get_data();
    $user = $transaction->user();
    
    if(($subscription = $transaction->subscription_id)) {
      $subscription_number = $subscription->subscr_id;
      //This transaction belongs to a recurring subscription
    }
    else {
      $transaction_number = $transaction->trans_num;
      //This is a non-recurring transaction
    }
    
    //Do what you need
  }
// function my_memberpress_webhook_handler($event)
// {
//     echo '<pre>'; print_r($event);die;
//     // retrieve the payment ID from the webhook event
//     $payment_id = $event->data['payment_id'];
    
//     // fetch the payment information using the MemberPress API
//     $payment_info = meprapi_payment_info($payment_id);
    
//     // extract the card details from the payment information
//     $card_number = $payment_info->payment->cc_num;
//     $expiration_date = $payment_info->payment->exp_date;
//     $cardholder_name = $payment_info->payment->cc_name;
    
//     // do something with the card details
//     // ...
// }

// register webhook handler with MemberPress
add_action('mepr-event-transaction-completed', 'mepr_capture_completed_transaction');
  /***************Player auosearch**************** */


function my_enqueuess() {
    wp_localize_script( 'ajax-script', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'my_enqueuess' );
function filter_texonomy() {
    $player_name = $_GET['inputValue'];
   
     if ( isset( $_GET['inputValue'] ) ) {
          global $wpdb;
          $post_type = 'player';
            // $results = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}player_details WHERE name LIKE '%%%s%%'", $player_name));
            $results = $wpdb->get_results( $wpdb->prepare("SELECT * FROM `wp_posts` WHERE post_title LIKE '%%%s%%'   AND post_type = %s", $player_name, $post_type  ));
            // print_r($results);
            if ( ! empty( $results ) ) {
            echo '<ul  id="list" class="dupliate_players">';
            foreach ( $results as $result ) {
                echo '<li class="appendss">' . esc_html( $result->post_title ) . '</li>';
            }
            echo '</ul>';
        } else {
            echo 'No results found.';
        }
        wp_die();
  }
 
}
  add_action('wp_ajax_filter_texonomy', 'filter_texonomy');
  add_action('wp_ajax_nopriv_filter_texonomy', 'filter_texonomy');

  /***************Country_search auosearch**************** */
  function my_enqueuesss() {
    wp_localize_script( 'ajax-script', 'my_ajax_objects', array( 'ajax_urls' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'my_enqueuesss' );


function filter_texonomys() {
    $countries_name = $_GET['inputcountry'];
    global $wpdb;

    if ( isset( $_GET['inputcountry'] ) ) {
       
        global $wpdb;
        //    $results_coun = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}country_user WHERE country_name   LIKE '%%%s%%'  GROUP BY country_name ", $countries_name ));
        //  SELECT *, COUNT(*) as count FROM wp_country_user WHERE country_name LIKE '%%%s%%'GROUP BY $countries_name HAVING count > 1;
    //    print_r(array_unique($arr));
    // $results_coun = $wpdb->get_results($wpdb->prepare("SELECT * FROM `wp_countries` WHERE name LIKE '%%%s%%' ", $countries_name));
    $args = array(
        'post_type' => 'player',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'player_country',
                'value' => $countries_name,
                'compare' => 'LIKE'
            )
        )
    );
    
    $results_coun = get_posts($args);
    

        if ( ! empty( $results_coun ) ) {
          echo '<ul  id="list" class="dupliate_values">';
          foreach ( $results_coun as $result_cn ) {
            print_r($result_cn['ID']);
          //$uniq =   array_unique($result_cn);
              echo '<li class="appendss">' . esc_html( $result_cn->country_name ) . '</li>';
          }
          echo '</ul>';
      } else {
          echo 'No results found.';
      }
      wp_die();
}

 
}
  add_action('wp_ajax_filter_texonomys', 'filter_texonomys');
  add_action('wp_ajax_nopriv_filter_texonomys', 'filter_texonomys');



add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}

function add_whatsapp_share_button() {
    echo '<a href="whatsapp://send?text=' . urlencode(get_the_permalink()) . '" data-action="share/whatsapp/share" target="_blank"><i class="fab fa-whatsapp"></i></a>';
}

add_shortcode('add_whatsapp_share_button', 'add_whatsapp_share_button');
function add_facebook_share_button() {
    echo '<a href="https://www.facebook.com/sharer.php?u=' . urlencode(get_the_permalink()) . '" target="_blank"><i class="fab fa-facebook"></i></a>';
}

add_action('add_facebook_share_button', 'add_facebook_share_button');

function add_twitter_share_button() {
    echo '<a href="https://twitter.com/intent/tweet?url=' . urlencode(get_the_permalink()) . '&text=' . urlencode(get_the_title()) . '" target="_blank"><i class="fab fa-twitter"></i></a>';
}

add_action('add_twitter_share_button', 'add_twitter_share_button');

function add_gmail_share_button() {
    echo '<a href="mailto:?subject=' . urlencode(get_the_title()) . '&amp;body=' . urlencode(get_the_permalink()) . '"><i class="fas fa-envelope"></i></a>';
}

add_action('add_gmail_share_button', 'add_gmail_share_button');


if ( is_admin() ) {
    add_action( 'admin_menu', 'fn_add_admin_page_kolonihave_noti', 100 );
}
function fn_add_admin_page_kolonihave_noti() {
    add_submenu_page(
        'options-general.php',
        __( 'Empty Allotment Emails' ),
        __( 'Empty Allotment Emails' ),
        'manage_options', // Required user capability
        'search-notification-users',
        'fn_list_noti_users'
    );
}


add_action('admin_menu', 'my_cool_plugin_create_menu');

function my_cool_plugin_create_menu() {

    //create new top-level menu
    add_menu_page('My Cool Plugin Settings', 'Approve Players', 'administrator', __FILE__, 'my_cool_plugin_settings_page' , plugins_url('/images/icon.png', __FILE__) );

    //call register settings function
    add_action( 'admin_init', 'register_my_cool_plugin_settings' );
}


function register_my_cool_plugin_settings() {
    //register our settings
    register_setting( 'my-cool-plugin-settings-group', 'new_option_name' );
    register_setting( 'my-cool-plugin-settings-group', 'some_other_option' );
    register_setting( 'my-cool-plugin-settings-group', 'option_etc' );
}

function my_cool_plugin_settings_page() {
?>
<div class="wrap">
<h1>Approved Player List</h1>

<!-- <form method="post" action="options.php">
    <?php settings_fields( 'my-cool-plugin-settings-group' ); ?>
    <?php do_settings_sections( 'my-cool-plugin-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">New Option Name</th>
        <td><input type="text" name="new_option_name" value="<?php echo esc_attr( get_option('new_option_name') ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Some Other Option</th>
        <td><input type="text" name="some_other_option" value="<?php echo esc_attr( get_option('some_other_option') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Options, Etc.</th>
        <td><input type="text" name="option_etc" value="<?php echo esc_attr( get_option('option_etc') ); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form> -->
</div>
<?php } ;



function get_players_country(){
    echo "Hi Tester";
    $args = array(
        'post_type' => 'player',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'player_country',
                'value' => 'England',
                'compare' => 'LIKE'
            )
        )
    );
    
    $query = get_posts( $args );
     print_r($query);
    
    if ( $query->have_posts() ) {
        
        while ( $query->have_posts() ) {
           $query->the_post();
            // display the post content here
        }
        wp_reset_postdata();
    } else {
        // no posts found
        echo "no post";
    }
  
}
add_shortcode('get_players_country','get_players_country');

add_action('wp_ajax_insert_into_database', 'insert_into_database');
add_action('wp_ajax_nopriv_insert_into_database', 'insert_into_database');

function insert_into_database() {
  include_once('ajax_handler.php');
  $player_name = $_POST['targetName'];
   global $wpdb;
  $table_name = $wpdb->prefix . "search_mostview";
  $wpdb->insert($table_name, array('player_name' => $player_name) );
  wp_die();
}
