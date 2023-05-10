<?php
 /* Template Name: All Newsssss */ 
get_header();
?>
 <section class="live_scores py_7">
            <div class="container">
                <div class="tittle_heading">
                    <h2 class="live_scores">Live Scores</h2>
                </div>
                <div class="row add_sliders_matches">
                    <?php
                    sleep(1);
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
             <?php get_footer(); ?>