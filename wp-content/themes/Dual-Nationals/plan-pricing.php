<?php
/*template name: New Subscription page  */
if ( is_user_logged_in() ) {
   get_header('new');
} else {
   get_header();
} 
$mepr_options = get_option('mepr_options');
$user_ID = get_current_user_id(); // get the user ID


  ?>


              <div class="wraper">
        <section class="pri_cing bg_style py_8" style="background-image: url('<?php echo get_field('banner');?>');">
            <div class="container">
                <div class="tittle_heading">
                    <h2>Choose Your Pricing Plan</h2>
                </div>
                <ul class="row g-0">
                    <?php
                    $args = array( 'post_type' => 'memberpressproduct','post_status'=>'publish', 'posts_per_page' => 4 , 'fields' => 'ids' ,'order' => 'ASC',);
                  $loop = new WP_Query( $args );
                  
                
                  ?>

                  <?php  while ( $loop->have_posts() ) : $loop->the_post(); 
                  $titles =  get_the_title();
                  $post_id= get_the_ID(  ) ; 
                  
                  $checkbox_values = get_field( 'highlighted', get_the_ID(), true );
                
                //    $highlighted =get_field('highlighted');
                //    foreach($highlighted as $highlights){
                   
                //         if($highlighted){
                    
                //     ?>
                  <script>
                //         $( document ).ready(function() {
                //             alert('rewr');
                //             setTimeout(function () {

                //         jQuery('.price_box').addClass('highlight');
                //     }, 2500);

                //         });
                //         </script>
                    
                   <?php //}
                    
                //    }
                  

                  ?>       
                    <li class="col-md-3 price_box <?php echo $checkbox_values['0'] ;?>">
                        <div class="pri_cing_crd">
                            <?php $membership_title = get_field('title');
                            if($membership_title){
                            ?>
                            <div class="pri_cing_head">
                                <?php 
                            $most_popular = $checkbox_values['0'] ; 
                            if($most_popular){?>
                              <p class="most_popular">Most Popular</p>  
                            <?php }
                            ?>
                            
                                <p><?php echo $membership_title; ?></p>
                            </div>
                            <?php } ?>
                            <div class="package_lists">
                                <ul class="package_list">
                            <?php 
                            // $posts = get_field('content');
                            foreach (get_field('content') as $key => $content) {
                                foreach($content as $contentss){
                               // 
                               if($contentss){
                              
                              // $discount_percent = ($regular_price - $discounted_price) / $regular_price * 100; 
                                ?>
                                <li><img src="assets/img/check-mark.png" alt=""><?php echo $contentss; ?></li>
                                <?php } } }?>

                            </ul>
                            <div class="price_list">
                                <?php  $regular_price = get_post_meta($post_id,'_mepr_product_price',true); 
                               $discounted_price = get_field('price');
                               ?>
                           
                            <?php if($discounted_price){?>
                                <del class="sales_price">$<?php echo $discounted_price;?> </del>
                            <?php } ?>
                            <?php if($regular_price){
                                if($regular_price != '0.00'){
                                ?>
                            <h5 class="regular_price">$<?php echo  $regular_price;?> </h5>
                            <?php  } } ?>
                            <div class="save _price"></div>
                                </div>
                               
                            </div>
                            <div class="footer_txt">
                                <p><?php echo get_field('footer_text'); ?></p>
                                <?php //the_content();?>
                            </div>
                            <div class="pri_cing_btn">
                                 <a href="<?php the_permalink() ;?>" class="theme_btn"><?php echo get_field('button_text');?></a>
                               
                            </div>
                        </div>
                    </li>
                          <?php endwhile; ?>
                </ul>
            </div>
        </section>
    </div>

    <?php
get_footer();
?>