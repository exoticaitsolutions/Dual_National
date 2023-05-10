<?php
 /* Template Name: About  Us*/ 
if ( is_user_logged_in() ) {
   get_header('new');
} else {
   get_header();
} 
?>

    <div class="wraper">
    <section class="inner_banner bg_style" style="background-image: url('<?php echo get_field('about_us_banner_section_background_image');?>')">
    <div class="container">
        <div class="inner_bnner_txt text-center">
            <h1><?php echo get_field('about_us_banner_section_text');?></h1>
        </div>
    </div>
</section>
<section class="about_dual py_8">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5">
                <div class="about_dual_img">
                    <img src="<?php echo get_field('about_us_section_image');?>" alt="">
                </div>
            </div>
            <div class="col-md-7">
                <div class="about_dual_cntnt">
                    <div class="cap_txt">
                      <span><?php echo get_field('about_us_section_text');?></span>
                    </div>
                    <h6><?php echo get_field('about_us_section_heading_text');?></h6>
                    <p>
                    <?php echo get_field('about_us_section_description');?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
        <section class="ads_banner">
            <div class="ads_banner_img">
              <img src="<?php echo get_field('ads_banner_section_part_1_background_image_');?>" alt="">
            </div>
            <div class="close_ads_button">
            <button><img src="<?php echo get_field('ads_banner_section_close_image');?>" alt=""></button>
            </div>
        </section>
        <section class="league_table bg_style py_8" style="background-image: url('<?php echo get_field('league_table_section_background_image');?>');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5">
                <div class="league_table_img">
                    <img src="<?php echo get_field('league_table_section_images');?> " alt="">
                </div>
            </div>
            <div class="col-md-7">
                <div class="about_dual_cntnt">
                    <div class="cap_txt">
                      <span><?php echo get_field('about_us_section_text');?></span>
                    </div>
                    <h6><?php echo get_field('league_table_section_sub_title');?> </h6>
                    <p>
                    <?php echo get_field('league_table_section_description');?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
        <section class="ads_banner">
            <div class="ads_banner_img">
              <img src="<?php echo get_field('ads_banner_section_part_2_background_image');?> " alt="">
            </div>
            <div class="close_ads_button">
              <button><img src="<?php echo get_field('ads_banner_section_close_image');?>" alt=""></button>
            </div>
        </section>
        <section class="testi_monial_slider py_8">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-lg-6 col-xl-5">
            <div class="testi_monial_slider_txt">
                <div class="testi_monial_slider_box">
                <span class="cap_txt"><?php echo get_field('testimonials_section_title');?></span>
                <h3><?php echo get_field('testimonials_section_sub_title_');?> </h3>
                    <ul class="flex_arrow">
                    <li class="slide_controls text-left">
                    <div class="slide-prev slick-arrow" aria-disabled="false">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets//img/left-arrow.png" />
                    </div>
                    <div class="slide-next slick-arrow" aria-disabled="false">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets//img/right-arrow.png" />
                    </div>
                    </li>
                </ul>
                </div>
            </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-7">
                <div class="testi_monial_slider_slider">
                <?php  $related = new WP_Query(array('post_type' => 'testimonials', 'posts_per_page' =>-1 ));
                        if( $related->have_posts() ) : 
                            while( $related->have_posts() ): $related->the_post(); ?>
                    <div class="testi_monial_box">
                        <div class="testi_monial_inner">
                            <p> <?php the_content();?>
                            </p>
                            <div class="testi_monial_img">
                                <div class="testi_monial_user">
                                        <?php the_post_thumbnail('full');?>
                                </div>
                                <p><?php the_title();?></p>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php  endif; wp_reset_postdata(); ?>

                </div>
            </div>
        </div>
    </div>
</section>
    </div>
<?php get_footer();?>
