<?php get_header(); 
$playerProfile = json_decode(get_post_meta(get_the_ID(), 'playerProfile' ,true)) ;
// echo '<pre>'; print_r($playerProfile);die;   
$performanceSeasons = json_decode(get_post_meta(get_the_ID(), 'performanceSeasons' ,true)) ; 
$player_id =$playerProfile->playerID;
$transfermarket_api = get_field('transfermarket_api', 'option');  
 		//	print_r($player_id);die();
                $curl = curl_init();
                curl_setopt_array($curl, [
                CURLOPT_URL => "https://transfermarket.p.rapidapi.com/players/get-header-info?id=$player_id&domain=com",
                CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: transfermarket.p.rapidapi.com",
		"X-RapidAPI-Key: $transfermarket_api"
	],
]);

$response = curl_exec($curl);
$response=json_decode($response);
$n = $response->data->player->nationalities;

//print_r( $n);
// 			echo "here";

$err = curl_error($curl);

curl_close($curl);
?>
<section class="player_stats_sec py_8">
    <div class="container">
        <div class="player_stats_info">
            <div class="my_profiel_edit">
                <div class="edit_profiel">
                    <img src="<?= (!empty($playerProfile->playerImage)) ? $playerProfile->playerImage :''; ?>" alt="">
                </div>
            </div>
            <ul class="player_stats_cntnt">
                <li class="player_stats_bx">
                    <div class="player_stats_head">
                        <h4>Player Info</h4>
                        <?php
                          global $wpdb;
                          $table = $wpdb->prefix.'Wishlist_data_list';
                          $fech_players_data = $wpdb->get_row("SELECT *  FROM $table where Player_id=".$playerProfile->playerID." AND User_id=".get_current_user_id(  ) ."");

                        if($fech_players_data){?>
                        <div class="save_favrt" id="save_favrt" wishlist_exit="true" wishlist_id = "<?php echo $fech_players_data->id;?>">
                            <input type="hidden" name="admin_url" id="admin_url"
                                value="<?php echo admin_url( 'admin-ajax.php' );?>">
                                <input type="hidden" name="image_url" id="image_url"
                                value="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/white-star.png">
                            <input type="hidden" name="player_id" id="player_id"
                                value="<?php echo $playerProfile->playerID;?>">
                            <input type="hidden" name="current_user_id" id="current_user_id"
                                value="<?php echo get_current_user_id(  );?>">
                            <img id="my_image" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/fvrt.png"
                                alt="">
                        </div>
                        <?php
                        }else{
                            ?>
                        <div class="save_favrt" id="save_favrt" wishlist_exit="false" wishlist_id = "">
                            <input type="hidden" name="admin_url" id="admin_url"
                                value="<?php echo admin_url( 'admin-ajax.php' );?>">
                            <input type="hidden" name="player_id" id="player_id"
                                value="<?php echo $playerProfile->playerID;?>">
                            <input type="hidden" name="current_user_id" id="current_user_id"
                                value="<?php echo get_current_user_id(  );?>">
                                <input type="hidden" name="image_url" id="image_url"
                                value="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/fvrt.png">
                            <img id="my_image"
                                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/white-star.png" alt="">
                        </div>
                        <?php
                        }
                           ?>

                    </div>
                    <div class="player_stats_cntnt_list">
                        <ul>
                            <li class="player_stats_cntnt_listing">
                                <div class="player_stats_cntnt_txt">
                                    <h6>First Name</h6>
                                    <p><?php echo explode(" ",$playerProfile->playerName)[0];?> </p>
                                </div>
                            </li>
                            <li class="player_stats_cntnt_listing">
                                <div class="player_stats_cntnt_txt">
                                    <h6>Last Name</h6>
                                    <p><?php echo explode(" ",$playerProfile->playerName)[1];?> </p>
                                </div>
                            </li>
                            <li class="player_stats_cntnt_listing">
                                <div class="player_stats_cntnt_txt">
                                    <h6>Place of Birth</h6>
                                    <p> <span><img src="<?php echo $playerProfile->birthplaceCountryImage;?>"
                                                alt=""></span> <?php echo $playerProfile->birthplace;?> </p>
                                </div>
                            </li>
                            <li class="player_stats_cntnt_listing">
                                <div class="player_stats_cntnt_txt">
                                    <h6>Agent</h6>
                                    <p><?php echo  ($playerProfile->agent =='no agent') ?  '': $playerProfile->agent ; ?>
                                    </p>
                                </div>
                            </li>
                            <li class="player_stats_cntnt_listing">
                                <div class="player_stats_cntnt_txt">
                                    <h6>Positions</h6>
                                    <p><?php echo  (!empty($playerProfile->playerMainPosition)) ? $playerProfile->playerMainPosition : '' ; ?><?php echo  (!empty($playerProfile->playerSecondPosition)) ? ','.$playerProfile->playerSecondPosition : '' ; ?>
                                        <?php echo  (!empty($playerProfile->playerThirdPosition)) ? ','.$playerProfile->playerThirdPosition : '' ; ?>
                                    </p>
                                    <!-- <p><?php echo  (!empty($playerProfile->playerMainPosition)) ? $playerProfile->playerMainPosition : '' ; ?>
                                    </p>                                      -->
                                </div>
                            </li>
                            <li class="player_stats_cntnt_listing">
                                <div class="player_stats_cntnt_txt">
                                    <h6>Eligible to Represent</h6>
                                  <!--  <p> <span><img
                                                src="<?php echo  (!empty($playerProfile->countryImage)) ? $playerProfile->countryImage : '' ; ?>"
                                                alt=""></span>
                                        <?php echo  (!empty($playerProfile->internationalTeamStatus)) ? $playerProfile->internationalTeamStatus : '' ; ?>
                                    </p> -->
									<p>
									   
										<?php
										    
											foreach($n as $itam){
												?>
										<span> <img src="<?php echo  $itam->image  ?>"  / > </span>
										<?php
												$full_name =  $itam->name."<br/>";
												echo $full_name;
											}
										
										?>
									</p>
                                    <!-- <ul class="elig_ible">
                                        <li>
                                           
                                        </li>

                                        <li>
                                            <p> <span><img
                                                        src="<?php //echo  (!empty($playerProfile->clubImage)) ? $playerProfile->clubImage : '' ; ?>"
                                                        alt=""></span> Argentine </p>
                                        </li>
                                        <li>
                                            <p> <span><img
                                                        src="<?php //echo  (!empty($playerProfile->playerMainPosition)) ? $playerProfile->playerMainPosition : '' ; ?>"
                                                        alt=""></span> United States </p>
                                        </li> 
                                    </ul> -->
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="player_stats_bx">
                    <div class="player_stats_head">
                        <h4>Club Info</h4>
                    </div>
                    <div class="player_stats_cntnt_list">
                        <ul>
                            <li class="player_stats_cntnt_listing">
                                <div class="player_stats_cntnt_txt">
                                    <h6>Club Logo</h6>
                                    <p><img src="<?php echo  (!empty($playerProfile->clubImage)) ? $playerProfile->clubImage : '' ; ?>"
                                            alt=""> </p>
                                </div>
                            </li>
                            <li class="player_stats_cntnt_listing">
                                <div class="player_stats_cntnt_txt">
                                    <h6>Club Name</h6>
                                    <p><?php echo  (!empty($playerProfile->club)) ? $playerProfile->club : '' ; ?></p>
                                </div>
                            </li>
                            <li class="player_stats_cntnt_listing">
                                <div class="player_stats_cntnt_txt">
                                    <h6>League Level</h6>
                                    <p> <?php echo  (!empty($playerProfile->league)) ? $playerProfile->league : '' ; ?>
                                </div>
                            </li>
                            <!-- <li class="player_stats_cntnt_listing">
                                        <div class="player_stats_cntnt_txt">
                                            <h6>Date Joined</h6>
                                            <p> Jan 1, 2017 </p>
                                        </div>
                                    </li> -->
                            <li class="player_stats_cntnt_listing">
                                <div class="player_stats_cntnt_txt">
                                    <h6>Contract</h6>
                                    <p><?php echo  (!empty($playerProfile->contractExpiryDate)) ? $playerProfile->contractExpiryDate : '' ; ?>
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>
<section class="premier_league py_8">
    <div class="container">
        <div class="row">
			
            <?php
// 			print_r($player_id);die();
                $curl = curl_init();
                curl_setopt_array($curl, [
                CURLOPT_URL => "https://transfermarket.p.rapidapi.com/players/detail?id=$player_id",
                CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: transfermarket.p.rapidapi.com",
		"X-RapidAPI-Key: $transfermarket_api"
	],
]);

$response = curl_exec($curl);
// 			echo "here";
// print_r($response);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	$all_response =  json_decode($response, true);
    // echo '<pre>'; print_r($all_response);die;
    foreach ($all_response['competitionPerformanceSummery'] as $key => $competition) {
       // echo "<pre>";
               $all_competition = $competition['competition'];
                $performance = $competition['performance'];
              ?>
            <div class="col-md-6">
                <div class="premier_league_card">
                    <div class="premier_card_top">
                        <div class="premier_card_name">
                            <h4><?php echo $all_competition['name'];?></h4>
                            <p>Statistics</p>
                        </div>
                        <div class="premier_club_logo">
                            <ul>
                                <li>
                                    <div class="club_logo_name">
                                        <img src="<?php echo $all_competition['image'];?>" alt="">
                                    </div>
                                </li>
                                <li>
                                    <div class="club_logo_name">
                                        <img src="<?php //echo $clubs['image'];?>" alt="">
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="premier_league_card_list">
                        <ul class="row">
                            <li class="col-md-6">
                                <div class="league_list">
                                    <div class="league_list_img">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/play-ground.png"
                                            alt="">
                                        <p>Minutes Per Goal</p>
                                    </div>
                                    <?php 
                                   $minutesPerGoal = $performance['minutesPerGoal'];
                                    $str_arr = explode('.',$minutesPerGoal);
                                    ?>

                                    <div class="league_list_txt">
                                        <p><?php echo  $str_arr[0];?></p>
                                    </div>
                                </div>
                                <div class="league_list">
                                    <div class="league_list_img">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/goal.png"
                                            alt="">
                                        <p>Goals</p>
                                    </div>
                                    <div class="league_list_txt">
                                        <p><?php echo $performance['goals'];?></p>
                                    </div>
                                </div>
                                <div class="league_list">
                                    <div class="league_list_img">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/assists.png"
                                            alt="">
                                        <p>Assists</p>
                                    </div>
                                    <div class="league_list_txt">
                                        <p><?php echo $performance['assists'];?></p>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-6">
                                <div class="league_list">
                                    <div class="league_list_img">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/yellow-card.png"
                                            alt="">
                                        <p>Yellow Cards</p>
                                    </div>
                                    <div class="league_list_txt">
                                        <p><?php echo $performance['yellowCards'];?></p>
                                    </div>
                                </div>
                                <div class="league_list">
                                    <div class="league_list_img">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Second-Yellows.png"
                                            alt="">
                                        <p>Second Yellows</p>
                                    </div>
                                    <div class="league_list_txt">
                                        <p><?php echo $performance['yellowRedCards'];?></p>
                                    </div>
                                </div>
                                <div class="league_list">
                                    <div class="league_list_img">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/red-card.png"
                                            alt="">
                                        <p>Red Cards</p>
                                    </div>
                                    <div class="league_list_txt">
                                        <p><?php echo $performance['redCards'];?></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="progress_list">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="progress_list_data">
                                    <div class="progress_per">

                                    </div>
                                    <div class="progress_no">
                                        <p>Starting </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="progress_list_data">
                                    <div class="progress_per">

                                    </div>
                                    <div class="progress_no">
                                        <p><?php echo $performance['minutesPlayed'];?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="progress_list_data">
                                    <div class="progress_per">

                                    </div>
                                    <div class="progress_no">
                                        <p><?php echo $performance['penaltyGoals'];?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
    }


}


                    ?>

            <!-- <?php //} } }?> -->
        </div>
    </div>
</section>
<?php get_footer(); ?>