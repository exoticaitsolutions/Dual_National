<?php

clearstatcache();
if( !is_page( array( 'how-it-works' ) )){

//phpinfo();
?>
<!DOCTYPE html>
<html lang="en">

<head><?php header('Access-Control-Allow-Origin: *'); ?>

    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="cache-control" content="no-cache" /> <meta http-equiv="Pragma" content="no-cache" /> <meta http-equiv="Expires" content="-1" /> 

    <title>Dual Nationals</title>
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap.min.css" />
     <link rel="stylesheet"
        href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/dataTables.bootstrap5.min.css" />
    <!--slick CSS -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/slick.css" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/slick-theme.css" />
   
    <!-- main.css -->
    <link rel="stylesheet" href="<?php  echo get_stylesheet_directory_uri();?>/assets/css/main.css?<?php echo date('Y-m-d H:i:s');
?>">
    <link rel="stylesheet" href="<?php  echo get_stylesheet_directory_uri();?>/assets/css/toastr.min.css" />
    <link rel="stylesheet" href="<?php  echo get_stylesheet_directory_uri();?>/assets/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <!--bootstrap-toaster.css      -->
      <link rel="stylesheet" href="<?php  echo get_stylesheet_directory_uri();?>/assets/css/bootstrap-toaster.css" />  
        <!--fnon  -->
        <link rel="stylesheet" href="<?php  echo get_stylesheet_directory_uri();?>/assets/css/fnon.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css"> 
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1506978918624384"
     crossorigin="anonymous"></script>
    <?php wp_head(); ?>

<body <?php body_class(); ?>>
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
                                        alt=""></a></li>
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
                                        <!-- <li><a id="logouts" ><img
                                                    src="<?php //echo get_stylesheet_directory_uri(); ?>/assets/img/logout.png" alt="">Logout</a>
                                                </li> -->
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
                        array('theme_location'  => 'primary',	
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
                                <input type="text" name="s" placeholder="Search by country" id="searchs_coun"
                                    value="<?php the_search_query(); ?>" />
                                <input type="image" id="players_country" alt="Search"
                                    src="<?php  echo get_stylesheet_directory_uri();?>/assets/img/search-icon.svg" />
                            </div>
                        </li>
                        <p class="or_class">OR</p>
                        <li>
                            <div class="srch_input">
                                <input type="text" name="players" id="players_found" placeholder="Search by player">
                                <input type="image" alt="Search" id="players_serach"
                                    src="<?php  echo get_stylesheet_directory_uri();?>/assets/img/search-icon.svg">
                            </div>
                        </li>
                    </form>



                </ul>
            </div>
        </div>
         <div class="player_search_rslt ">
        <div class="container"> 
                <div id="results" class="players_searchlist"></div>
            </div>
       </div>
       
    </header>
    
   
    
    <?php } 
    