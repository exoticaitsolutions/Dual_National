<?php
// if(!empty(@$livescore->success) == '1' ){
    foreach (array_slice($livescore->data->match, 0, 3) as $key => $value) {
?>

<div class="col-sm-12 col-md-6-col-lg-4 col-xl-4 mb-4 mb-xl-0" live_score_id="    <?php echo $value->id;?>">
    <div class="live_scor_card">
        <div class="live_scor_head">
            <div class="club_img_logo">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/fcb.png" alt="">
            </div>
            <div class="club_img_name">
                <h3><?php echo $value->away_name ;?>: <?php echo $value->competition_name ;?></h3>
            </div>
        </div>
        <ul class="club_listing_names">
            <li>
                <div class="club_listing">
                    <div class="club_listing_img">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/club_listing_img-1.png"
                            alt="">
                        <p><?php echo $value->home_name ;?></p>
                    </div>
                    <div class="club_listing_score">
                        <p><?php echo $value->score ;?> </p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<?php 
          
    }
// }
?>

<div class="ply_er_stats_btn">

                                <a href="#" class="theme_btn">View More</a>
                            </div>