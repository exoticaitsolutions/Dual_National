<?php 



 /* Template Name: Secondary Homepage */ 



?>    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php

   get_header('new');

?>
<div class="wraper">
        <section class="secondry_home py_8 seconday_page">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="wel_dual_net">
                            <div class="tittle_heading">
                                <h2>Welcome To Dual Nationals</h2>
                            </div>
                            <div class="wel_dual_net_form">
                            <?php echo do_shortcode('[mepr-login-form]'); ?>

                                <p><span>Or</span></p>
                               <?php //echo do_shortcode('[miniorange_social_login]');?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="wel_dual_net_img">
                            <?php $bnner_img = get_field('banner_image');
                            if($bnner_img){
                            ?>
                            <img src="<?php echo $bnner_img;?>" alt="img">
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="search_players_stat py_8">
            <div class="container">
                <div class="search_players_iner">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <?php $search_thous = get_field('search_thousands_of_player_stats');
                            if($search_thous){
                            ?>
                            <div class="tittle_heading">
                                <h2><?php echo $search_thous;?></h2>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="col-md-4">
                            <?php $view_all_butoon_link = get_field('view_all_butoon_link');
                            if($view_all_butoon_link){
                            ?>
                            <div class="search_players_view_all">
                                <a href="<?php echo $view_all_butoon_link;?>" class="theme_btn"><?php echo get_field('view_all_button');?></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="search_players_list py_8">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="search_players_list_box">
                            <div class="search_players_list_img">
                                <img src="<?php echo get_field('search_player_by_name_image');?>" alt="img">
                            </div>
                            <div class="search_players_list_text">
                                <h2><?php echo get_field('search_player_by_name');?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="search_players_list_box">
                            <div class="search_players_list_img">
                                <img src="<?php echo get_field('search_player_by_country_image');?>" alt="img">
                            </div>
                            <div class="search_players_list_text">
                                <h2><?php echo get_field('search_player_by_country');?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    </div>
    <script>
        jQuery('.mepr-already-logged-in a').attr('id', 'logouts');

    jQuery( ".mepr-already-logged-in a" ).on( "click",function(event) {
        event.preventDefault(); 
                    //  alert('sfs');
                       swal({
                          title: "Are you sure!",
                        //  className: "theme_btn",
                          text: "Do you really want logout?", 
                          buttons: true,
                          dangerMode: true,
                        }).then((willDelete) => {
                          if (willDelete) {
                            // swal("Yaa! you are logout now!", {
                            //   icon: "success",
                            // });
                            
                            jQuery(location).prop('href', '<?php echo esc_url( wp_logout_url() ); ?>    ')

                          }
                        });

});
    </script>
    <style>
        section.Latest_news_sec.py_7.latest_secondary_page {
    display: none;
}
    </style>
<?php
get_footer('new');