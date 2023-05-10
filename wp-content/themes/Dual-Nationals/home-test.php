<?php /* Template Name: Homepageaaaa */ 

if ( is_user_logged_in() ) {
  get_header('new');
} else {
   get_header();
}

?>
<div class="wraper">
    <section class="hero_banner">
        <div class="row g-0">
            <div class="col-md-8">
                <div class="home_slider">
                    <?php 
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => "https://livescore-football.p.rapidapi.com/soccer/news-list?page=1",
                         CURLOPT_RETURNTRANSFER => true,
                         CURLOPT_ENCODING => "",
                         CURLOPT_MAXREDIRS => 10,
                         CURLOPT_TIMEOUT => 30,
                         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                         CURLOPT_CUSTOMREQUEST => "GET",
                         CURLOPT_HTTPHEADER => [
                            "X-RapidAPI-Host: livescore-football.p.rapidapi.com",
                            "X-RapidAPI-Key: 0d4fe157b8msh70698d15484952ap1b2a06jsn98060b013472"
                        ],
                    ]);
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    if ($err) {
                        echo "cURL Error #:" . $err;
                    } else {

                     $new_decodes = json_decode($response, true ); 
                    $new_decode = $new_decodes['data']; 
                     $temparr = array();
                     $i = 0;
                    for ($i=0; $i < 3 ; $i++) { 
                       // if(isset($new_decode[$i])){
                            $temparr[] = $new_decode[$i];
                    }
                    $new_decode = $temparr;                
                foreach ($new_decode as $key => $newss) { 
                  $publisedd = $newss['published'];  
               $datetime1 = new DateTime($publisedd);
                $datetime2 = new DateTime(); // current time
                $interval = $datetime1->diff($datetime2);
                    $title = $newss['title'];
                    $image = $newss['image'];
                    $url = $newss['url'];
                    $thumbnail_2 = $newss['thumbnail_2'];
                    $thumbnail_1 = $newss['thumbnail_1'];
                    $slug = $newss['slug'];  ?>
                    <div class="home_banner">
                        <div class="hero_slider bg_style" style="background-image: url('<?php echo $image;?>')">
                            <div class="hero_slider_cntnt">
                                <div class="d-flex">
                                    <div class="hero_slider_txt">
                                        <a  href="/all-news/" class="banner_news">
                                    <h1><?php
                                    echo  $title;
                                    // echo substr_replace($title, "...", 100);?></h1>
                                    </a>
                                    <p class="hours_times"> <?php if ($interval->y >= 1) {
                                        echo $interval->format('%y years ago');
                                    } elseif ($interval->m >= 1) {
                                        echo $interval->format('%m months ago');
                                    } elseif ($interval->d >= 1) {
                                        echo $interval->format('%d days ago');
                                    } elseif ($interval->h >= 1) {
                                        echo $interval->format('%h hours ago');
                                    } elseif ($interval->i >= 1) {
                                        echo $interval->format('%i minutes ago');
                                    } else {
                                        echo 'just now';
                                    }?></p>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <?php// } ?>
                    </div>
                    <?php } } ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="banner_player_stats">
                    <div class="banner_player_stats_bx">
                        <div class="banner_stats_head">
                            <h3><?php echo  the_field('player_stats_text_');?></h3>
                        </div>
                        <?php   $related = new WP_Query(array('post_type' => 'footballs_player', 'posts_per_page' =>2 ));
                        if( $related->have_posts() ) : 
                            while( $related->have_posts() ): $related->the_post(); 
                            $playerProfile = json_decode(get_post_meta(get_the_ID(), 'playerProfile' ,true)) ;  
                            $performanceSeasons = json_decode(get_post_meta(get_the_ID(), 'performanceSeasons' ,true)) ;
                            $peromnce = json_decode(get_post_meta(get_the_ID(), 'competitionPerformanceSummery' ,true)) ;
                            $goals = 0;
                            $assists = 0;
                            $minutesPlayed = 0;
                            foreach ($peromnce->competitionPerformanceSummery as $key => $competitionPerformanceSummery) {
                                $goals+=$competitionPerformanceSummery->performance->goals;
                                $assists+=$competitionPerformanceSummery->performance->assists;
                                $minutesPlayed+=$competitionPerformanceSummery->performance->minutesPlayed;
                            }
                            // 
                            ?>
                        <div class="ply_er_stats mb-4"
                            player_id="<?php echo  (!empty($playerProfile->playerID)) ? $playerProfile->playerID : '' ; ?>">
                            <div class="ply_er_stats_cntnt">
                                <div class="ply_er_stats_img">
                                    <img src="<?php echo  (!empty($playerProfile->playerImage)) ? $playerProfile->playerImage : '' ; ?>"
                                        alt="">
                                </div>
                                <div class="ply_er_stats_txt">
                                    <h6><?php echo  (!empty($playerProfile->playerName)) ? $playerProfile->playerName : '' ; ?>
                                    </h6>
                                    <ul>
                                        <li>Age: <?php echo  (!empty($playerProfile->age)) ? $playerProfile->age : '' ; ?> </li>
                                        <li>Height: <?php echo  (!empty($playerProfile->height)) ? $playerProfile->height .'M' : '' ; ?></li>
                                        <li>Postion: <?php echo  (!empty($playerProfile->playerMainPosition)) ? $playerProfile->playerMainPosition  : '' ; ?></li>
                                        <li> Market Value: <?php echo  (!empty($playerProfile->marketValue)) ? $playerProfile->marketValue  : '' ; ?>></li>
                                    </ul> 
                                  
                                </div>
                            </div>
                            <div class="ply_er_stats_data">
                                <ul>
                                    <li>Games: <span><?php echo  (!empty($playerProfile->internationalGames)) ? $playerProfile->internationalGames : '' ; ?></span>
                                    </li>
                                    <li>Goals: <span><?php echo  (!empty($goals)) ? $goals : '0' ; ?></span>
                                    </li>
                                    <li>Assists: <span><?php echo  (!empty($assists)) ? $assists : '0' ; ?></span></li>
                                    <li>Caps/Goals  : <span>-</span></li>
                                    
                                </ul>
                                <ul>
                                    <li>Seasons: <span><?php  echo count($performanceSeasons);?></span></li>
                                    <li>Minutes: <span><?php  echo $minutesPlayed;?></span></li>
                                    <?php $minutesPerGoal = $peromnce->competitionPerformanceSummery[0]->performance->minutesPerGoal; 
                                    $str_arr = explode('.',$minutesPerGoal);
                                    ?>
                                    <li>Minutes per goal:  <span><?php echo  $str_arr[0];?></span></li>
                                    
                                </ul>
                            </div>
                            <div class="Eligibility">Eligibility for Country:  <span><img src="<?php echo $playerProfile->countryImage;?>" ></span></div>
                            <div class="ply_er_stats_btn">

                                <a href="<?php the_permalink();?>" class="theme_btn">View More Stats</a>
                            </div>
                        </div>
                        <?php endwhile; ?>
                        <?php  endif; wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

     <section class="live_scores py_7">
    
        <div class="container">
            <div class="tittle_heading">
                <h2>Live Scores</h2>
            </div>
            <div class="row">
<?php
$curl_matchs = curl_init();
curl_setopt_array($curl_matchs, [
   CURLOPT_URL => "https://livescore-football.p.rapidapi.com/soccer/live-matches?timezone_utc=7%3A00",
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => "",
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 30,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => "GET",
   CURLOPT_HTTPHEADER => [
      "X-RapidAPI-Host: livescore-football.p.rapidapi.com",
      "X-RapidAPI-Key: 0d4fe157b8msh70698d15484952ap1b2a06jsn98060b013472"
   ],
]);

$response_matches = curl_exec($curl_matchs);
$err = curl_error($curl_matchs);
curl_close($curl_matchs);
if ($err_matches) {
   echo "cURL Error #:" . $err_matches;
} else {
    echo $response_matches;

  $matchs_decode = json_decode($response_matches , true);
  $get_league = $matchs_decode['data'];
 foreach ($get_league as $key => $get_leagues) {?>
<div class="leage_data">
   <div class="league_names">
   <?php echo $get_leagues['league_name'];?>
</div>
<div class="countries_names">
  <?php echo $get_leagues['country_name'];?>
</div>
</div>
  <?php
 }
  foreach ($matchs_decode['data'][0] as $key => $Live_match) { 
  foreach ($Live_match as $key => $all_matches) {
   $team_1  = $all_matches['team_1']; 
  $team_2 = $all_matches['team_2']; 
  $score = $all_matches['score'];
  $team_1_score = $score['team_1'];
  $full_time = $score['full_time'];
  $live_score_1 = $full_time ['team_1'];
  $live_score_2 = $full_time ['team_2'];
   ?>

   <div class="col-sm-12 col-md-6-col-lg-4 col-xl-4 mb-4 mb-xl-0">
                <div class="live_scor_card">
        <div class="live_scor_head">
            <div class="club_img_logo">
                <img src="<?php echo $team_1['logo'];?>" alt="">
            </div>
            <div class="club_img_name">
                <h3><?php echo $team_1['name'];?></h3>
            </div>
             <div class="club_listing_score">
                        <p><?php echo $live_score_1;?> </p>
                    </div>
        </div>
        <ul class="club_listing_names">
            <li>
                <div class="club_listing">
                    <div class="club_listing_img">
                        <img src="<?php echo $team_2['logo'];?>"
                            alt="">
                        <p><?php echo $team_2['name'];?></p>
                    </div>
                    <div class="club_listing_score">
                        <p><?php echo $live_score_2;?> </p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
  
   <?php }  ?>
   <?php
  }
} ?>
</div>
</div>
    </section>
    <section class="ads_banner">
        <div class="ads_banner_img">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/ads-1-1.jpg" alt="">
        </div>
        <div class="close_ads_button">
            <button><img src="/wp-content/uploads/2023/03/close_ads.png" alt=""></button>
        </div>
    </section>

    <section class="news_feeds newss_feeds">
        <div class="row g-0">
            <div class="col-md-6">
                <div class="ads_banner">
                    <div class="ads_banner_img">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/ads-2.jpg" alt="">
                       
                    </div>
                    <div class="close_ads_button">
                        <button><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/close_ads.png" alt=""></button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="news_feeds_cntnt_bx">
                    <div class="news_feeds_cntnt">
                        <div class="news_feeds_head">
                            <h2>News Feed</h2>
                        </div>

                        <ul class="news_feeds_list">
                            <?php 
                    if ($err) {
                        echo "cURL Error #:" . $err;
                    } else {

                     $new_decodes = json_decode($response, true ); 
                    $new_decode = $new_decodes['data']; 
                     $temparr = array();
                     $i = 0;
                    for ($i=0; $i < 3 ; $i++) { 
                       // if(isset($new_decode[$i])){
                            $temparr[] = $new_decode[$i];
                    }
                    $new_decode = $temparr;                
                foreach ($new_decode as $key => $newss) { 
                $publisedd = $newss['published'];  
               $datetime1 = new DateTime($publisedd);
                $datetime2 = new DateTime(); // current time
                $interval = $datetime1->diff($datetime2);
                   $title = $newss['title'];
                   $image = $newss['image'];
                   $url = $newss['url'];
                   $thumbnail_2 = $newss['thumbnail_2'];
                   $thumbnail_1 = $newss['thumbnail_1'];
                   $slug = $newss['slug'];  
                     $new_decode = json_decode($response, true ); 

                            ?>
                            <li>
                                <a  href="/all-news/" class="news_feeds_crd">
                                    <div class="news_feeds_img">
                                       <img src="<?php echo $thumbnail_2;?>">
                                    </div>
                                    <div class="news_feeds_txt">
                                        <h6><?php echo $title;?></h6>
                                        <p class="hours_times_news"><?php if ($interval->y >= 1) {
                                        echo $interval->format('%y years ago');
                                    } elseif ($interval->m >= 1) {
                                        echo $interval->format('%m months ago');
                                    } elseif ($interval->d >= 1) {
                                        echo $interval->format('%d days) ago');
                                    } elseif ($interval->h >= 1) {
                                        echo $interval->format('%h hours ago');
                                    } elseif ($interval->i >= 1) {
                                        echo $interval->format('%i minutes ago');
                                    } else {
                                        echo 'just now';
                                    }?></p>
                                </div>
                                </a>
                            </li>
                            <?php } }  ?>
                        </ul>
                        <div class="ply_er_stats_btn">
                                <a href="/all-news/" class="theme_btn">View More</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
setTimeout(function() {
    var hours_txt = jQuery('p.hours_times').text();
console.log(hours_txt);
if(hours_txt == '9 hours'){
    jQuery('p.hours_times').text(' 9 test ago');
}
jQuery(".matches_goals_live").slick({
    dots: false,
    infinite: true,
   slidesToShow: 3,
  slidesToScroll: 3,
    dots: true,
    prevArrow:
      "<img class='slick-prev' src='https://dualnationals.com/wp-content/uploads/2023/05/left-ar.png'>",
    nextArrow:
      "<img class='slick-next' src='https://dualnationals.com/wp-content/uploads/2023/05/right-ar.png'>",
  });

   
}, 1000);
    </script>
<style>
.right_content p {
    margin-bottom: 10px !important;
}

.banner_player_stats {
    margin-left: 34px;
}
</style>
<?php get_footer();?>