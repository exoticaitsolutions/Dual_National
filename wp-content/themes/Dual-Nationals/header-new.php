<?php
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php header('Access-Control-Allow-Origin: *'); ?>

    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="cache-control" content="no-cache" /> <meta http-equiv="Pragma" content="no-cache" /> <meta http-equiv="Expires" content="-1" /> 

    <title>Dual Nationals</title>
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap.min.css" />
    <!--slick CSS -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/slick.css" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/slick-theme.css" />
    <!-- main.css -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/main.css?<?php echo date('Y-m-d H:i:s');?>" />
    <link rel="stylesheet" href="<?php  echo get_stylesheet_directory_uri();?>/assets/css/toastr.min.css" /> 
    <!--fnon  -->
     <!--bootstrap-toaster.css      -->
    <link rel="stylesheet" href="<?php  echo get_stylesheet_directory_uri();?>/assets/css/bootstrap-toaster.css" />  
    
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
     <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1506978918624384"
     crossorigin="anonymous"></script>
</head>
<?php wp_head();?>
<body>
<div id="loader">
<span class="loaders"></span>
</div>
<div id="cover-spin"></div>
    <header class="main_header">
        <div class="tire_1">
            <div class="container">
                <div class="tire_flex">
                <div class="header_logo">
                        <?php  $logo = get_field('logo', 'option');?>
                        <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo;?>" alt=""></a>
                    </div>
                    <div class="social_link">
                    <ul>
                            <?php while(has_sub_field('social_icons', 'option')): 
                                $image  =  get_sub_field('image'); 
                                $link  =  get_sub_field('link'); 
                                if($image || $link){?>
                                <li><a href="<?php echo $link;?>"><img src="  <?php echo get_sub_field('image'); ?> "
                                 alt=""></a>
                                </li>
                            <?php } ?>
                            <?php endwhile; ?>
                        </ul>
                    </div>
					<nav class="navbar navbar-expand-sm">
                        <div class="login_acnt">

                            <!-- <select>
                                <?php if ( !is_user_logged_in() ) { ?>
                                
                                    <div class="user_login">
                                        <a href="/user-login"><img
                                                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/user_login.png"
                                                alt="">Login</a>
                                    </div>
                               
                                <?php }else{ ?>
                                <option><?php $current_user = wp_get_current_user();
                                    echo substr($current_user->display_name, 0, 30);
                                    ?>

                                    <div class="drop_down">
                                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/user_login.png"
                                                alt="">  <a
                                            href="http://18.188.169.10/wp-login.php?action=logout&redirect_to=%2Fhow-it-works%2F&_wpnonce=00a0f5ffc1"><img
                                                src="http://18.188.169.10/wp-content/uploads/2023/02/logout.png"
                                                alt="">Logout</a>
                                    </div>
                                </option>
                                <?php }?>
                            </select> -->
                            <ul class="admin_logout">
                                <li>
                                    <?php if ( !is_user_logged_in() ) {?>
                                    <div class="user_login">
                                        <a href="/user-login"><img
                                                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/user_login.png"
                                                alt="">Login</a>
                                    </div>

                                </li>
                                <?php } else{?>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/user_login.png"
                                    alt=""><?php $current_user = wp_get_current_user();
                                    echo $current_user->display_name;?>
                                <div class="drop_down">
                                    <ul>
                                    <li><a href="/my-account/" ><img style="filter: invert(1)!important;" src=<?php echo get_stylesheet_directory_uri(); ?>/assets/img/user_login.png" alt=""> My Account</a></li>
                                    <li><a id="logouts"  href="javascript:void(0)">
                                    <input type="hidden" name="log_out_url" id="log_out_url" value="<?php echo esc_url( wp_logout_url() ); ?>">
                                    <img
                                                    src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logout.png" alt="">Logout</a>
                                </li>
                                               
                                    </ul>
                                </div>

                                <?php }?>
                            </ul>
                        </div>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <!-- <div id="google_translate_element"></div> -->
                                <?php echo do_shortcode('[gtranslate]'); ?>

                            </li>
                            <li class="nav-item">
                                <!--                                 
                                <div class="switch">
                                    <input type="checkbox" id="myCheck" onclick="myFunction()">
                                    <label for="myCheck"></label>
                                </div> -->
                            </li>
                        </ul>
                    </nav>
    
                 
                </div>
            </div>
        </div>
        <div class="tire_2">
            <div class="container">
                <div class="nav_bar">
                <?php wp_nav_menu(
                        array('theme_location'  => 'seconday_header',	
                        'menu_class'      => 'menu-wrapper','container_class' => 'primary-menu-container',
                        'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
                        'fallback_cb'     => false,
                        ));?>
                </div>
            </div>
            
        </div>
        <div class="tire_3">
            <div class="container">
            <ul class="search_fields">
                    <form action="/" method="get">
                        <li>
                            <div class="srch_input">
                                <input type="text" name="player_country" placeholder="Search by country" id="search_con"
                                    value="<?php the_search_query(); ?>" />
                                <input type="image" id="players_country" alt="Search"
                                    src="<?php  echo get_stylesheet_directory_uri();?>/assets/img/search-icon.svg" />
                                    <div id="autoserach"></div>
                            </div>
                        </li>
                        <p class="or_class">OR</p>
                        <li>
                            
                            <div class="srch_input">
                                <input type="text" name="players" placeholder="Search by player" id ="Search_playres">
                                <input type="image" alt="Search" id="players_serach"
                                    src="<?php  echo get_stylesheet_directory_uri();?>/assets/img/search-icon.svg">
                                    <div id="autoserach_play"></div>
                                </div>
                        </li>
                    </form>



                </ul>
            </div>
        </div>
       
    </header>
    <script>
    jQuery(document).ready(function () {
        
        jQuery(document).on('keypress',function(e) {
    if(e.which == 13) {
      
    // Get the value you want to insert into the database.
    var targetName = jQuery('#Search_playres').val();
console.log(targetName);
    // Make an AJAX call to the PHP script.
    $.ajax({
      type: 'POST',
      url: '<?php echo admin_url('admin-ajax.php'); ?>',
      data: {
        action: 'insert_into_database',
        targetName: targetName
      },
      success: function(response) {
        // Handle the response from the server.
        console.log(response);
      }
    });
    }
});
     jQuery(document).on("click", "#players_serach", function(event) {
          event.preventDefault()
    // Get the value you want to insert into the database.
    var targetName = jQuery('#Search_playres').val();
console.log(targetName);
    // Make an AJAX call to the PHP script.
    $.ajax({
      type: 'POST',
      url: '<?php echo admin_url('admin-ajax.php'); ?>',
      data: {
        action: 'insert_into_database',
        targetName: targetName
      },
      success: function(response) {
        // Handle the response from the server.
        console.log(response);
      }
    });
  });

      jQuery(document).on("click", ".dupliate_players li", function(event) {
     event.preventDefault()
    console.log('dfdds');
    // Get the value you want to insert into the database.
    var targetName = jQuery(this).text();
    console.log(targetName);
    // Make an AJAX call to the PHP script.
    $.ajax({
      type: 'POST',
      url: '<?php echo admin_url('admin-ajax.php'); ?>',
      data: {
        action: 'insert_into_database',
        targetName: targetName
      },
      success: function(response) {
        // Handle the response from the server.
        console.log(response);
      }
    });
  });


jQuery('.tooltip_dots').on('click', function(event) {
     jQuery('.tooltiplink').toggleClass('show_tooltips');
});

        jQuery("#logouts").click(function(event) {

  event.preventDefault();
  setTimeout(function () {
        jQuery('button.swal-button.swal-button--confirm.swal-button--danger').text('Logout');     
       
      },
      200);
  new swal({
    title: "Are you sure you really want to logout?",
    buttons: true,
    dangerMode: true,
    confirmButtonText: "Logout" // set the confirm button text to "Logout"
  }).then((willDelete) => {
    if (willDelete) {
      window.location.href = '<?php echo wp_logout_url(); ?>';
    }
  });
});

/***************************load *************/
        jQuery(document).on("click", ".dupliate_players li", function() {
  var selectedValue = jQuery(this).text(); // Get the text of clicked li
  console.log(selectedValue);
  var selected_vlss = jQuery('#Search_playres').val(selectedValue); // Set the value of input field
              setTimeout(function() {

  var url = "https://dualnationals.com/?s=&players=" + encodeURIComponent(selected_vlss.val()) + "&x=2&y=17";
  window.location.replace(url);
              }, 500);

});
          jQuery(document).on("click", "#players_serach", function() {
  var selectedValue = jQuery('#Search_playres').val(); // Get the text of clicked li
  console.log(selectedValue);
  var selected_vlss = jQuery('#Search_playres').val(selectedValue); // Set the value of input field
              setTimeout(function() {

  var url_player = "https://dualnationals.com/?s=&players=" + encodeURIComponent(selected_vlss.val()) + "&x=2&y=17";
  window.location.replace(url_player);
              }, 500);

});
/******************************************/



/***************************load *************/

          jQuery(document).on("click", "#players_country", function() {
  var selectedconValue = jQuery('#search_con').val(); // Get the text of clicked li
  console.log('playerbtn');
  console.log(selectedconValue);
  var selected_con_vlss = jQuery('#search_con').val(selectedconValue); // Set the value of input field
              setTimeout(function() {

  var url = "https://dualnationals.com/?s=&inputcountry=" + encodeURIComponent(selected_con_vlss.val()) + "&x=2&y=17";
  window.location.replace(url);
              }, 1500);

});
/******************************************/






  jQuery('#Search_playres').on('keypress', function(event) {
     setTimeout(function () {
       var count_li_search = $("#list li").length;
    

       if(count_li_search >= 6){
       
        jQuery('.dupliate_players').addClass('search_entries');
        
    }
    }, 1000);

            jQuery('#autoserach_play').addClass('players_search');

            var inputValue = $(this).val();
            jQuery.ajax({
                type: 'GET',
                url    : my_ajax_object.ajax_url,
                processData: true,
                data: {"action": "filter_texonomy",inputValue:inputValue },
                success: function(response) {
                    jQuery("#autoserach_play").html(response);
                 //   return false;
                }
            });
        });
        jQuery('#search_con').on('keypress', function(event) {
            jQuery('#autoserach').addClass('countries_search');
          //  if (event.which === 8 || event.key === "Backspace") {
           
                    var inputcountry = $(this).val();
                    jQuery.ajax({
                        type: 'GET',
                        url    : my_ajax_objects.ajax_urls,
                        //processData: true,
                        data: {"action": "filter_texonomys",inputcountry:inputcountry },
                        success: function(response) {
                            jQuery("#autoserach").html(response);
                           // return false;
                           }
                           });
                        // }
                         });
                         jQuery("#Search_playres").click(function(){
                            jQuery('#search_con').val('');
                        });
                    });
                    
                        
     </script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> -->
      