<?php /* Template Name: Homepage */ 

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
                    <?php $curl = curl_init();
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
                                                            <h1><?php echo  $title;?></h1>
                                                        </a>
                                                        <p> <?php if ($interval->y >= 1) {
                                                                echo $interval->format('%y years ago');
                                                            } elseif ($interval->m >= 1) {
                                                                echo $interval->format('%m months ago');
                                                            } elseif ($interval->d >= 1) {
                                                                echo $interval->format('%d days ago');
                                                            } elseif ($interval->h >= 1) {
                                                                if ($interval->h == 1) {
                                                                    echo '1 hour ago';
                                                                } else {
                                                                    echo $interval->format('%h hours ago');
                                                                }
                                                            } elseif ($interval->i >= 1) {
                                                                echo $interval->format('%i minutes ago');
                                                            } else {
                                                                echo 'just now';
                                                            } ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                  <?php
                                   $non_golkiper  = $wpdb->get_row( "SELECT * FROM wp_player_details WHERE main_position != 'Goalkeeper' ORDER BY id ASC LIMIT 1" ); 
                                     $current_seasons_stats_matches =   $non_golkiper->current_seasons_stats_appearances;
                                     $current_seasons_stats_goals   =   $non_golkiper->current_seasons_stats_goals;
                                     $current_seasons_stats_assists =   $non_golkiper->current_seasons_stats_assists;
                                     //print_r($current_seasons_stats_assists);
                                     $caps                          =   $non_golkiper->caps;
                                     $national_team_stats_goals     =   $non_golkiper->national_team_stats_goals;
                                   ?>
                           <div class="ply_er_stats mb-4 non_golkiper_section" player_id="<?php echo  (!empty($non_golkiper->id)) ? $non_golkiper->id : '' ; ?>">
                             <div class="ply_er_stats_cntnt">
                                <div class="ply_er_stats_img">
                                    <img src="<?php echo  (!empty($non_golkiper->headshot)) ? $non_golkiper->headshot : '' ; ?>"
                                        alt="">
                                 </div>
                                 <div class="ply_er_stats_txt">
                                    <h6><?php echo  (!empty($non_golkiper->name)) ? $non_golkiper->name : '' ; ?></h6>
                                    <ul>
                                        <li>Age: <?php echo  (!empty($non_golkiper->age)) ? $non_golkiper->age : '' ; ?> </li>
                                        <li>Height: <?php echo  (!empty($non_golkiper->height)) ? $non_golkiper->height .'' : '' ; ?></li>
                                        <li>Postion: <?php echo  (!empty($non_golkiper->main_position)) ?$non_golkiper->main_position  : '' ; ?></li>
                                        <li> Market Value: €<?php echo  (!empty($non_golkiper->market_value)) ? $non_golkiper->market_value  : '' ; ?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="plyers_statsbox">
                            <div class="ply_er_stats_data">
                                <h3>Current Season</h3>
                                    <ul>
                                        <?php 
                                        $current_seasons_stats_matches = json_decode($current_seasons_stats_matches);
                                        ?>
                                        <li><span class="memu_mtch">Matches:</span>
                                            <span><?php echo $current_seasons_stats_matches[0]+ $current_seasons_stats_matches[1]; ?></span>
                                        </li>
                                        <?php $current_seasons_gols_decode = json_decode($current_seasons_stats_goals);?>
                                        <li><span class="memu_mtch">Goals:</span>
                
                                            <span><?php  echo $current_seasons_gols_decode[0];?></span>
                                        
                                        </li>
                                        <?php $current_seasons_stats_assists =  $non_golkiper->current_seasons_stats_assists ;
                                        $current_seasons_decode = json_decode($current_seasons_stats_assists); ?>
                                        <li><span class="memu_mtch">Assists:</span>
                                            <?php $current_seasons_stats_assistss = json_decode($current_seasons_stats_assists);?>
                                            <span><?php  echo$current_seasons_stats_assistss[0];?></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="player_statts_rrt">
                                    <div class="ply_er_stats_data">
                                        <h3>International</h3>
                                        <ul>
                                                <?php $national_team_stats_goalss = json_decode($national_team_stats_goals);?>
                                                <li><span class="memu_mtch">Caps/Goals  :</span> 
                                                    <div class="menu_mtch_dv">
                                                    <span><?php echo $caps;?></span>
                                                    <span>/</span>
                                                    <span><?php echo $national_team_stats_goalss[0];?></span>
                                                    </div>
                                                    
                                                </li>
                                        </ul>
                                    </div>
                                    <div class="Eligibility">
                                        <span class="memu_mtch">Eligibility for Country:</span>  
                                        <span>
                                            <?php $citizenship_flag = $non_golkiper->citizenship_flag ;
                                            $citizenship_flag_decode = json_decode($citizenship_flag);
                                        // print_r($citizenship_flag);
                                            foreach($citizenship_flag_decode as $citizenship_flags){?>
                                            
                                            <img src="<?php echo $citizenship_flags;?>" >
                                            <?php } ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                                
                                
                            <div class="ply_er_stats_btn">

                               <a href="/?s=&players=<?php echo $non_golkiper->name;?>&x=2&y=17" class="theme_btn">View More Stats</a>
                            </div>
                        </div>
                     <?php $non_golkiper1  = $wpdb->get_row( "SELECT * FROM wp_player_details WHERE main_position = 'Goalkeeper' ORDER BY id DESC LIMIT 1" );
                     // echo '<pre>' ;
                     // print_r($non_golkiper1);
                     $current_seasons_stats_matches_gol =$non_golkiper1->current_seasons_stats_appearances;
                     $current_seasons_stats_cleansheets_gol =$non_golkiper1->current_seasons_stats_cleansheets;
                     $current_seasons_stats_goals_conceded_gol =$non_golkiper1->current_seasons_stats_goals_conceded;
                     $national_team_stats_goals_gol =$non_golkiper1->national_team_stats_goals;

             ?>
                        <div class="ply_er_stats mb-4"
                            player_id="<?php echo  (!empty($non_golkiper1->id)) ? $non_golkiper1->id : '' ; ?>">
                            <div class="ply_er_stats_cntnt">
                                <div class="ply_er_stats_img">
                                    <img src="<?php echo  (!empty($non_golkiper1->headshot)) ? $non_golkiper1->headshot : '' ; ?>"
                                        alt="">
                                </div>
                                <div class="ply_er_stats_txt">
                                    <h6><?php echo  (!empty($non_golkiper1->name)) ? $non_golkiper1->name : '' ; ?>
                                    </h6>
                                    <ul>
                                        <li>Age: <?php echo  (!empty($non_golkiper1->age)) ? $non_golkiper1->age : '' ; ?> </li>
                                        <li>Height: <?php echo  (!empty($non_golkiper1->height)) ? $non_golkiper1->height .'' : '' ; ?></li>
                                        <li>Postion: <?php echo  (!empty($non_golkiper1->main_position)) ?$non_golkiper1->main_position  : '' ; ?></li>
                                        <li> Market Value: €<?php echo  (!empty($non_golkiper1->market_value)) ? $non_golkiper1->market_value  : '' ; ?></li>
                                    </ul> 
                                  
                                </div>
                            </div>
                            <div class="plyers_statsbox">
                                <div class="ply_er_stats_data">
                                <h3>Current Season</h3>
                                    <ul>
                                        <?php $national_team_stats_goals1 = $non_golkiper1->national_team_stats_goals;
                                        $national_team_stats_goalss1 = json_decode($national_team_stats_goals1);

                                        ?>
                                        <li><span class="memu_mtch">Matches:</span>
                                            <?php
                                        $current_seasons_stats_matches_gols = json_decode($current_seasons_stats_matches_gol); ?>
                                        <span><?php echo $current_seasons_stats_matches_gols[0] + $current_seasons_stats_matches_gols[1];?></span>
                                        </li>
                                        <li><span class="memu_mtch">Cleansheets:</span>
                                            <?php $current_seasons_stats_cleansheets_gols = json_decode($current_seasons_stats_cleansheets_gol);?>
                                            <span><?php echo $current_seasons_stats_cleansheets_gols[0] + $current_seasons_stats_cleansheets_gols[1] ;?></span>
                                    
                                        </li>
                                        <?php $current_seasons_stats_assists1 =  $non_golkiper1->current_seasons_stats_assists ;
                                        $current_seasons_decode1 = json_decode($current_seasons_stats_assists1);
                                    
                                        ?>
                                        <li><span class="memu_mtch">Conceded: </span>
                                            <?php $current_seasons_stats_goals_conceded_gols = json_decode($current_seasons_stats_goals_conceded_gol); ?>
                                            <span><?php echo $current_seasons_stats_goals_conceded_gols[0] + $current_seasons_stats_goals_conceded_gols[1];?></span>
                                        
                                        </li>
                                        
                                        
                                    </ul>
                                    <ul>
                                        <?php $current_seasons_stats_goals_conceded1 = $non_golkiper1->current_seasons_stats_goals_conceded;
                                        $current_seasons_stats_goals_decodes12 = json_decode($current_seasons_stats_goals_conceded1);

                                        ?>
                                    
                                        
                                    </ul>
                                </div>
                                <div class="player_statts_rrt">
                                    <div class="ply_er_stats_data">
                                        <h3>International</h3>
                                        <ul>
                                            <li><span class="memu_mtch">Caps/Goals  : </span>
                                            <div class="menu_mtch_dv">
                                                <span><?php echo $non_golkiper1->caps;?></span>
                                                <span>/</span>
                                                    <?php 
                                                    $national_team_stats_goals_golS = json_decode($national_team_stats_goals_gol);
                                                    $gols_counts = count($national_team_stats_goals_golS);
                                                    $counts_gols = 1;
                                                    foreach ($national_team_stats_goals_golS as $key => $national_team_stats_goals_golSS) { ?>
                                                        <span>
                                                            <?php 
                                                        echo "<span>" . $national_team_stats_goals_golSS . ($counts_gols == $gols_counts ? "" : " ") . "</span>";
                                                            $counts_gols++;
                                                        ?>
                                                        </span>
                                                    
                                                    <?php
                                                    // code...
                                                }?>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="Eligibility">
                                    <span class="memu_mtch">Eligibility for Country: </span>
                                    <span><img src="<?php echo $non_golkiper1->national_team_flag;?>" ></span>
                                </div>
                                </div>
                               
                            </div>
                            <div class="ply_er_stats_btn">

                               <a href="/?s=&players=<?php echo $non_golkiper->name;?>&x=2&y=17" class="theme_btn">View More Stats</a>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="most_viewed py_7">
        <div class="container">
            <div class="tittle_heading">
                <h2><?php echo  the_field('view_played_text',);?></h2>
            </div>
            <div class="row">
                <?php
                 $most_viewds = $wpdb->get_results("SELECT player_name, COUNT(*) AS search_count FROM wp_search_mostview WHERE player_name != 'Tim Ream' AND player_name != 'Matt Turner' AND player_name != ' ' GROUP BY player_name ORDER BY search_count DESC LIMIT 3");
                 foreach ($most_viewds as $view_most) {
                    $namesss = $view_most->player_name;
                    $query_most = $wpdb->get_results("SELECT * FROM `wp_player_details` WHERE name = '$namesss'");
                    foreach ($query_most as $query_most1) {
                     $players_nmes1 = $query_most1->name;
                     $headshot1 = $query_most1->headshot;
                     $market_value = $query_most1->market_value;
                     $league_logo = $query_most1->league_logo;?>
                     <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4 mb-xl-0">
                        <div class="most_viewed_card">
                            <div class="plyr_card_img">
                                <a href="/?s=&players=<?php echo $query_most1->name;?>&x=2&y=17" >
                                    <img class="plyr_img" src="<?php echo $headshot1;?>" alt="">
                                    <div class="player_logo">
                                        <img src="<?php echo $league_logo;?>" alt="">
                                    </div>
                                </div>
                            </a>
                            <div class="most_viewed_card_txt">
                                <h3>
                                    <?php echo $players_nmes1;?>
                                </h3>
                                <p>Market value: <span>€<?php echo $market_value;?> </span></p>
                            </div>
                        </div>
                        </div>
                    <?php  }
                     } ?>
                 </div>
             </div>
         </section>
          <section class="live_scores py_7">
            <div class="container">
                <div class="tittle_heading">
                    <h2 class="live_scores">Live Scores</h2>
                </div>
                <div class="row add_sliders_matches">
                    <?php
                    sleep(3);
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
                        $matchs_decode = json_decode($response_matches , true);
                        // echo '<pre>';
                        // print_r($matchs_decode);
                       if(empty($matchs_decode['data'])) { ?>

                            <div id="no-games-message__no-live" class="Ce" data-testid="no-results-message_root">
                                <svg viewBox="0 0 32 32" class="t">
                                    <path d="M16.03 29.2c-7.37 0-13.36-6-13.36-13.36s6-13.36 13.36-13.36c7.37 0 13.36 6 13.36 13.36s-6 13.36-13.36 13.36zm0-25.38c-6.63 0-12.02 5.4-12.02 12.02s5.4 12.02 12.02 12.02a12.03 12.03 0 000-24.04zm-2 9.35h4V25.2h-4V13.17zm0-6.68h4v4h-4v-4z">
                                    </path>
                                </svg>There are no games currently in progress
                                </div>
                            <?php }
                            foreach ($matchs_decode['data'] as $key => $Live_match) {
                                $status_live = $Live_match['status'];
                                $all_Mtchss= $Live_match['matches'];
                                foreach( $all_Mtchss as  $all_Mtchs){

                                $team_1 = $all_Mtchs['team_1'];
                                $team_2 = $all_Mtchs['team_2'];
                                // echo '<pre>';
                                //  print_r($team_2['name']);
                                $score = $all_Mtchs['score'];
                                $all_scores= $score['full_time'];
                                $team_1_scores= $all_scores['team_1'];
                                $team_2_scores= $all_scores['team_2'];?>
                                <div class="col-sm-12 col-md-6-col-lg-4 col-xl-4 mb-4 mb-xl-0">
                                    <div class="leage_data">
                                        <div class="league_names">
                                            <?php echo $Live_match['league_name'];?>
                                        </div>
                                        <div class="countries_names">
                                            <?php echo $Live_match['country_name'];?>
                                       </div>
                                   </div>
                                   <div class="live_scor_card">
                                    <div class="main_score_sec">
                                        <div class="live_scor_head">
                                            <div class="club_img_logo">
                                                <img src="<?php echo $team_1['logo'];?>" alt="">
                                           </div>
                                           <div class="club_img_name">
                                             <h3><?php echo $team_1['name'];?></h3>
                                          </div>
                                          <div class="club_listing_score">
                                            <p><?php echo $team_1_scores;?> </p>
                                          </div>
                                       </div>
                                       <ul class="club_listing_names">
                                        <li>
                                            <div class="club_listing">
                                                <div class="club_listing_img">
                                                    <img src="<?php echo $team_2['logo'];?>" alt="">
                                                    <p><?php echo $team_2['name'];?></p>                                
                                                </div>
                                                <div class="club_listing_score">
                                                    <p><?php echo $team_2_scores;?> </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                    <div class="staus_div">
                                        <p style="color:#fff"><span>Live</span><?php echo $all_Mtchs['status'];?></p>
                                   </div>
                             </div>
                           </div>
                           <?php   }} }?>
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
                            <?php if ($err) {
                                echo "cURL Error #:" . $err;
                            } else {
                                $new_decodes = json_decode($response, true );
                                $new_decode = $new_decodes['data'];
                                $temparr = array();
                                $i = 0;
                                for ($i=0; $i < 3 ; $i++) { 
                            $temparr[] = $new_decode[$i];
                        }
                        $new_decode = $temparr;
                        foreach ($new_decode as $key => $newss) {
                            $publisedd = $newss['published'];
                            $datetime1 = new DateTime($publisedd);
                            $datetime2 = new DateTime();
                            $interval = $datetime1->diff($datetime2);
                            $title = $newss['title'];
                            $image = $newss['image'];
                            $url = $newss['url'];
                            $thumbnail_2 = $newss['thumbnail_2'];
                            $thumbnail_1 = $newss['thumbnail_1'];
                            $slug = $newss['slug'];  
                            $new_decode = json_decode($response, true );?>
                            <li>
                                <a  href="/all-news/" class="news_feeds_crd">
                                    <div class="news_feeds_img">
                                        <img src="<?php echo $thumbnail_2;?>">
                                    </div>
                                    <div class="news_feeds_txt">
                                        <h6><?php echo $title;?></h6>
                                        <p> <?php if ($interval->y >= 1) {
                                             echo $interval->format('%y years ago');
                                                } elseif ($interval->m >= 1) {
                                                    echo $interval->format('%m months ago');
                                                } elseif ($interval->d >= 1) {
                                                    echo $interval->format('%d days ago');
                                                } elseif ($interval->h >= 1) {
                                                  if ($interval->h == 1) {
                                                        echo '1 hour ago';
                                                    } else {
                                                        echo $interval->format('%h hours ago');
                                                    }
                                                } elseif ($interval->i >= 1) {
                                                    echo $interval->format('%i minutes ago');
                                                } else {
                                                    echo 'just now';
                                                } ?>
                                        </p>
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
    var mtch_length = jQuery('.add_sliders_matches .col-sm-12.col-md-6-col-lg-4.col-xl-4.mb-4.mb-xl-0').length;
console.log(mtch_length);
if(mtch_length > '3'){
    jQuery(".add_sliders_matches").slick({
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

}
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