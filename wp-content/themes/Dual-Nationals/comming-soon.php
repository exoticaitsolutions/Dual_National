<?php /* Template Name: Comming soon */

if ( is_user_logged_in() ) {
$redirect_url = site_url( '/homepage2' );
wp_redirect( $redirect_url, 301 );
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dual Nationals </title>
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/main-comming.css?<?php echo date('Y-m-d H:i:s');?>" />
  <link rel="icon" href="assets/" sizes="any">
  <link rel="icon" href="/wp-content/uploads/2023/04/header_logo-2.png" type="image/svg+xml">
  <link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/favicons/apple-touch-icon.png">
  <link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/favicons/site.webmanifest">
  <meta name="theme-color" content="#24293E">
  <?php //wp_head(); ?>
</head>

<body>
  <div class="container">
    <div class="col">
      <div class="logo">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/main-comming/logo.png" alt="Dual Nationals" />
      </div>
      <h1>
        <div class="small">Our website is</div>
        <div class="accent-color">coming soon</div>
      </h1>
      <div class="text-content">
        <h5>Access a comprehensive database of eligible players for FAs all over the world. Perfect for fans, players,
          agents, and administrators.
        </h5>
        <!-- <p>Enter your email address below to be notified when our site launches.</p> -->
      </div>
      <!-- <form action="">
        <input type="email" placeholder="Email address">
        <button type="submit" class="submit-btn">Notify me!</button>
      </form> -->
      <ul class="social">
        <li> <a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/main-comming//social/instagram.svg" alt="Intagram" /></a> </li>
        <li> <a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/main-comming//social/youtube.svg" alt="youtube" /></a> </li>
        <li> <a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/main-comming//social/tiktok.svg" alt="tiktok" /></a> </li>
        <li> <a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/main-comming//social/twitter.svg" alt="twitter" /></a> </li>
      </ul>
    </div>
  </div>
</body>

</html>