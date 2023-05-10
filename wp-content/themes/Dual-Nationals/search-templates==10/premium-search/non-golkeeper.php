<?php // Custom search.php file
// Add your custom code for search functionality here

// Example: Display search results

// $targetName = $_GET['players'];
// $premium_result = $wpdb->get_results( "SELECT * FROM `wp_player_details` WHERE name = '$targetName'" );

$targetName = $_GET['inputcountry'];

$premium_result = $wpdb->get_results("SELECT * FROM `wp_player_details` WHERE name = '$targetName'");
$data =  $wpdb->get_results("SELECT * FROM `wp_posts` WHERE post_title = '$targetName'");
$post_id = $data[0]->ID;
$mng = new MongoDB\Driver\Manager("mongodb+srv://mandelabyron:Mpendakuma001@mongo-intro.ywzthil.mongodb.net/?retryWrites=true&w=majority");
$players_id = get_field('player_id', $post_id);
$filter = ['id' => intval($players_id)];
$options = [];
$qry = new MongoDB\Driver\Query($filter, $options);
$cursor = $mng->executeQuery("players_db.players_data_1", $qry);
$rowsArr = $cursor->toArray();






$filename = "player_details34.csv";
$file = fopen($filename, 'w');

foreach($rowsArr as $pre_results){
  
  $status = $pre_results->status;
  if(isset($_POST['download_csv'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="filename.csv"');
    $file = fopen('php://output', 'w');
    fputcsv($file, array('ids', 'Name', 'Age', 'club Name'));
    fputcsv($file, array($pre_results->id, $pre_results->name, $pre_results->age, $pre_results->club));
    fclose($file);
    exit;
  }


  $player_id =              $pre_results->id;
  $get_positions =          $pre_results->main_position;
  $player_img        =      $pre_results->headshot;
  $player_name       =      $pre_results->name;
  $club_name         =      $pre_results->club;
  $league_name       =      $pre_results->league_name;
  $league_logo       =      $pre_results->league_logo;
  $caps              =      $pre_results->jersey_number;
  $league_level      =      $pre_results->league_level;
  $market_value      =      $pre_results->market_value;
  $contract_expires  =      $pre_results->contract_expires;
  $date_of_birth     =      $pre_results->date_of_birth;
  $age               =      $pre_results->age;
  $height            =      $pre_results->height;
  $place_of_birth    =      $pre_results->place_of_birth;
  $place_of_birth_flag  =   $pre_results->place_of_birth_flag;
  $other_postions    =      $pre_results->other_postions;
  $other_postions_seprate = implode(",",   $other_postions );

  $international_goals  =      $pre_results->international_goals;

  // Nationale stats
  $national_team_stats = $pre_results->national_team_stats; // National Object
  $latest_debut = $national_team_stats->debut[0];
  $national_team_length = sizeof($national_team_stats->appearances);
  $national_team_flag = $pre_results->national_team_flag;
  $national_team_name = $pre_results->national_team;
  $citizenship  =      $pre_results->citizenship;
  $joined_date  =      $pre_results->joined_date;
  $national_team  =      $pre_results->national_team;

  //citizen Data
  $citizen_data = $pre_results->citizenship;
  $citizen_flag =  $pre_results->citizenship_flag;
  $second_antion = $citizen_data[1];
  $first_antion = $citizen_data[0];

  $first_flag = $citizen_flag[0];
  $second_flag = $citizen_flag[1];


  // Agency Data
  $agency = $pre_results->agency_info; // Agency Object
  $agency_name = $agency->name;
  $agency_agency = $agency->agency;
  $agency_agent_phone = $agency->agent_phone;
  $agent_email = $agency->agent_email;

  // Club History
  $clubs_object =  $pre_results->club_stats; // Clubs Object
  $club_length = sizeof($clubs_object->clubs); //  Competions Array


  // Current Season Stats
  $current_stats = $pre_results->current_seasons_stats;  // Main Current Stats 
  $array_length = sizeof($current_stats->competions); //  Competions Array



  // $player_id = $pre_results->id;
  // $get_positions = $pre_results->main_position;
  // $player_img        =      $pre_results->headshot;
  // $player_name       =      $pre_results->name;
  // $club_name         =      $pre_results->club;
  // $league_name       =      $pre_results->league_name;
  // $league_logo       =      $pre_results->league_logo;
  // $caps              =      $pre_results->caps;
  // $league_level      =      $pre_results->league_level;
  // $market_value      =      $pre_results->market_value;
  // $contract_expires  =      $pre_results->contract_expires;
  // $date_of_birth     =      $pre_results->date_of_birth;
  // $age               =      $pre_results->age;
  // $height            =      $pre_results->height;
  // $place_of_birth    =      $pre_results->place_of_birth;
  // $place_of_birth_flag  =      $pre_results->place_of_birth_flag;
  // $other_postions    =      $pre_results->other_postions;
  // $other_postions_decode = json_decode($other_postions , true);
  // $citizenship_flag  =      $pre_results->citizenship_flag;
  // $citizenship_decode = json_decode($citizenship_flag, true);
  // $first_flag =$citizenship_decode[0];
  // $second_flag =$citizenship_decode[1];
  // $international_goals  =      $pre_results->international_goals;
  // $national_team_stats_debut  =      $pre_results->national_team_stats_debut;
  // $national_team_stats = json_decode($national_team_stats_debut);
  // $national_team_flag = $pre_results->national_team_flag;
  // $citizenship  =      $pre_results->citizenship;
  // $array = json_decode($citizenship, true);
  // $second_antion=$array[1];
  // $first_antion=$array[0];
  // $club_stats_appearances  =      $pre_results->club_stats_appearances;
  // $current_seasons_stats_competions  =      $pre_results->current_seasons_stats_competions;
  // $session_states_decode = json_decode($current_seasons_stats_competions);
  // $club_stats_appearances_decodes = json_decode($club_stats_appearances);
  // $club_stats_clubs  =      $pre_results->club_stats_clubs;
  // $club_stats_clubs_decodes = json_decode($club_stats_clubs);
  // $joined_date  =      $pre_results->joined_date;
  // $national_team  =      $pre_results->national_team;
  // $current_stats_cleansheets = $pre_results->current_seasons_stats_cleansheets;
  // $cleansheets_dcode = json_decode($current_stats_cleansheets);
  // $current_goals_conceded = $pre_results->club_statsgoals;
  // $current_goals_conceded_decode = json_decode($current_goals_conceded);
  // $club_stats_assists = $pre_results->club_stats_assists;
  // $club_stats_assists_decode = json_decode($club_stats_assists);
  // $club_stats_mins = $pre_results->club_stats_mins;
  // $club_stats_mins_decode = json_decode($club_stats_mins);
  // $current_seasons_stats_yellow_cards =  $pre_results->current_seasons_stats_yellow_cards;
  // $current_seasons_stats_yellow_decode = json_decode($current_seasons_stats_yellow_cards);
  // $current_seasons_stats_red_cards =  $pre_results->current_seasons_stats_red_cards;
  // $current_seasons_stats_red_decode= json_decode($current_seasons_stats_red_cards);
  // $national_team_stats_national_team = $pre_results->national_team_stats_national_team;
  // $current_seasons_stats_appearances = $pre_results->current_seasons_stats_appearances;
  // $current_seasons_stats_appea_data = json_decode($current_seasons_stats_appearances);
  // $current_seasons_stats_goals = $pre_results->current_seasons_stats_goals;
  // $current_seasons_stats_goal_decode  = json_decode($current_seasons_stats_goals);
  // $current_seasons_stats_assists = $pre_results->current_seasons_stats_assists;
  // $current_seasons_stats_decode = json_decode($current_seasons_stats_assists);
  // $club_stats_appearancesss = $pre_results->club_stats_appearances;
  // $club_stats_appeara_decoded = json_decode($club_stats_appearancesss);
  // $national_team_stats_appearances = $pre_results->national_team_stats_appearances;
  // $national_team_stats_appearan_data = json_decode($national_team_stats_appearances);
  // $national_team_stats_goals = json_decode( $pre_results->national_team_stats_goals);
  $current_user = wp_get_current_user();
 ?>
 <input type="hidden" id="anPageName" name="page" value="goalkeeper" />
    <div class="container-center-horizontal">
      <div class="goalkeeper screen">
           <div class="player-container">
          <div class="flex-col">
            <div class="header-1">
              <?php if($player_img){?>
              <div class="player-photo"><img class="image-290" src="<?php echo $player_img;?>" alt="image 290" /></div>
            <?php } ?>
              <div class="frame-34728">
                <div class="name name-4">
                  <?php if($player_name){?>
                  <div class="name-1 name-4">
                    <h1 class="name-2 name-4 mb-0"><?php echo $player_name; ?></h1>
                    <?php // if($status == 'approve'){?>
                    <div class="tooltips">
                      <img class="material-symbolsverified-rounded" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/material-symbols-verified-rounded.svg" alt="material-symbols:verified-rounded">
                    <span class="tooltiptext">This account has been claimed by the profile owner using a goverment isssued ID.</span>
                    </div> 
                  <?php // } ?>
                  </div>
                <?php } ?>
                   <img class="line-103" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line-103-4.svg" alt="Line 103" />
                  <div class="jersey">
                    <div class="jersey-1"></div>
                    <?php if($caps){?>
                    <div class="number valign-text-middle number-32 poppins-medium-white-16px"><?php echo $caps ;?></div>
                  <?php } ?>
                  </div>
                </div>
                <div class="frame-34731">
                  <div class="frame-34731-item">
                    <div class="club-logo">
                      <div class="group-41"></div>
                    </div>
                    <div class="frame-34481">
                      <?php if($club_name){?>
                      <div class="frame-34">
                        <div class="arsenal valign-text-middle arsenal-2 poppins-semi-bold-white-16px"><?php echo $club_name;?>
                        </div>
                      </div>
                    <?php } ?>
                    <?php if($get_positions){?>
                      <div class="frame-34727">
                        <div class="goalkeeper-1 poppins-normal-white-12px"><?php echo $get_positions; ?></div>
                      </div>
                    <?php } ?>
                    </div>
                  </div>
                  <div class="frame-34731-item">
                    <?php if($league_logo){?>
                    <div class="competition-logo-1">
                      <img class="image-98" src="<?php echo $league_logo; ?>" alt="image 98" />
                    </div>
                  <?php } ?>
                    <div class="frame-34481-4">
                      <?php if($league_name){?>
                      <div class="frame-34">
                        <div class="premier-league valign-text-middle poppins-semi-bold-white-16px"><?php echo $league_name;?>
                        </div>
                      </div>
                    <?php } ?>
                      <div class="frame-34727"><div class="first-tier poppins-normal-white-12px">First Tier</div></div>
                    </div>
                  </div>
                  <img class="line-103-1" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line-103-5.svg" alt="Line 103" />
                  <div class="frame-34731-item">
                    <div class="frame-34481-4">
                      <?php if($market_value){?>
                      <div class="frame-34">
                        <div class="x5m valign-text-middle poppins-semi-bold-white-16px">€<?php echo $market_value;?></div>
                      </div>
                    <?php } ?>
                      <div class="frame-34727">
                        <div class="market-value poppins-normal-white-12px">Market Value</div>
                      </div>
                    </div>
                  </div>
                  <div class="frame-34731-item">
                    <div class="frame-34481-4">
                      <?php if($contract_expires){?>
                      <div class="frame-34">
                        <div class="date valign-text-middle date-9 poppins-semi-bold-white-16px"><?php echo $contract_expires;?>
                          
                        </div>
                      </div>
                    <?php } ?>
                      <div class="frame-34727">
                        <div class="contract-expiration poppins-normal-white-12px">Contract Expiration</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex-col-1 flex-col-2 ms-auto">
                <div class="actions">
                    <div class="social_link-icons">
                  <img class="icon-share" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/fi-share-2-2.svg" alt="icon-share" />
                  <span class="tooltiptext">
                    <div class="copy_txt_main">
                    <a href="javascript:void(0)" class="copy-text" onclick="copyToClipboard('#p1')">copy link</a>
                    <button class="clipboard fa fa-clone clipboard"></button> 
                  </div>
                  <?php echo do_shortcode('[addtoany]'); ?>
                  </span>
                </div>
                <?php global $wpdb;
                $table = $wpdb->prefix.'Wishlist_data_list';
                $fech_players_data = $wpdb->get_row("SELECT *  FROM $table where Player_id=".$player_id." AND User_id=".get_current_user_id(  ) ."");
                if($fech_players_data){?>
                  <div class="save_favrt" id="save_favrt" wishlist_exit="true" wishlist_id = "<?php echo $fech_players_data->id;?>">
                    <input type="hidden" name="admin_url" id="admin_url" value="<?php echo admin_url( 'admin-ajax.php' );?>">
                    <input type="hidden" name="image_url" id="image_url"value="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/fi-heart-2.svg">
                    <input type="hidden" name="player_id" id="player_id" value="<?php echo $player_id;?>">
                    <input type="hidden" name="current_user_id" id="current_user_id"
                    value="<?php echo get_current_user_id(  );?>">
                    <img id="my_image" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/heart-01.svg" alt="">
                    </div>
                    <?php }else{?>
                      <div class="save_favrt" id="save_favrt" wishlist_exit="false" wishlist_id = "">
                        <input type="hidden" name="admin_url" id="admin_url"  value="<?php echo admin_url( 'admin-ajax.php' );?>">
                        <input type="hidden" name="player_id" id="player_id" value="<?php echo $player_id;?>">
                        <input type="hidden" name="current_user_id" id="current_user_id" value="<?php echo get_current_user_id(  );?>">
                        <input type="hidden" name="image_url" id="image_url" value="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/heart-01.svg">
                        <img id="my_image" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/fi-heart-2.svg" alt="">
                        </div>
                        <?php } ?>
                        <div class="tooltip tooltip_dots">
                          <img class="more" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/more.svg" alt="More" />
                          <span class="tooltiplink">
                           <form method="post"> <a download_csv download_csv href="<?php echo $filename;?>">Download CSV</a></form>
                          </span>
                        </div>
                      </div>
<!--                 <div class="claim">
                  <div class="claim-this-profile valign-text-middle">Claim this profile</div>
                  <img class="arrow-right" src="<?php //echo get_stylesheet_directory_uri(); ?>/assets/img/arrow-right.svg" alt="arrow-right" />
                </div> -->
              </div>
            </div>
            <div class="player-info">
              <div class="x-info">
                <div class="player-info-1 poppins-medium-white-22px">Player Info</div>
<!--                 <img class="edit-2" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/edit-2.svg" alt="edit-2" /> -->
              </div>
              <div class="data-2">
                <div class="flex-row">
                  <div class="birth birth-2">
                    <div class="birth-1 birth-2 poppins-normal-white-12px">Birth</div>
                    <?php if($date_of_birth){?>
                    <div class="frame-344">
                      <div class="date-1 valign-text-middle date-9 poppins-medium-white-16px"><?php echo $date_of_birth; ?></div>
                    </div>
                  <?php } ?>
                  </div>
                  <div class="age age-2">
                    <div class="age-1 age-2 poppins-normal-white-12px">Age <?php //echo $age;?></div>
                    <?php if($age){?>
                    <div class="frame-344">
                      <div class="number-1 valign-text-middle number-32 poppins-medium-white-16px"><?php echo $age;?></div>
                    </div>
                  <?php } ?>
                  </div>
                  <div class="flex-row-item">
                    <div class="height poppins-normal-white-12px">Height</div>
                    <?php if($height){?>
                    <div class="frame-344">
                      <div class="frame-34">
                        <div class="x186-m valign-text-middle poppins-medium-white-16px"><?php echo $height;?></div>
                      </div>
                    </div>
                  <?php } ?>
                  </div>
                  <div class="flex-row-item">
                    <div class="place-of-birth poppins-normal-white-12px">Place of Birth</div>
                    <div class="frame-344">
                      <div class="frame-34">
                        <?php if($place_of_birth_flag){?>
                        <img class="flag-square" src="<?php echo $place_of_birth_flag;?>" alt="Flag Square" />
                      <?php } ?>
                        <?php if($place_of_birth){?>
                        <div class="surname valign-text-middle surname-2 poppins-medium-white-16px">
                         <?php echo $place_of_birth;?>
                        </div>
                      <?php } ?>
                      </div>
                    </div>
                  </div>
                 <div class="position position-2 position_position ">
                    <div class="position-1 position-2 poppins-normal-white-12px">Position(s)</div>
                    <div class="frame-34733 poppins-normal-white-16px coma_gap">
                      <div class="right-winger"><?php echo $get_positions; ?></div>
                      <?php foreach ($other_postions_decode as  $other_postions_decodess) {
                        if($other_postions_decodess){ ?>
                          <div class="right-winger apped_txt">
                            <span class="commas_">,</span>
                            <?php echo $other_postions_decodess; ?>
                          </div>
                          <?php }else{ ?>
                            <div class="right-winger">Null</div>
                          <?php } ?>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="line-10"></div>
            <div class="flex-col-item flex-col-2">
              <div class="x-info">
                <div class="nationality nationality-2 poppins-medium-white-22px">Nationality</div>
              </div>
              <div class="data">
                <?php if(!$first_antion){?>
                <div class="nationality-1 nationality-2">
                  <div class="nationality-national-team poppins-normal-white-12px">Nationality (National Team)</div>
                  <div class="frame-344">
                    <div class="frame-34">
                      <img class="flag-square-1" src="<?php echo  $first_flag;?>" alt="Flag Square" />
                      <div class="place valign-text-middle place-2 poppins-medium-white-16px"><?php echo $first_antion;?></div>
                    </div>
                  </div>
                </div>
              <?php } else{ ?>
                   <div class="x2nd-nationality">
                  <div class="x2nd-nationality-1 poppins-normal-white-12px">Nationality (National Team)</div>
                  <div class="frame-344">
                    <div class="frame-34">
                      <img class="lithuania-lt" src="<?php echo $national_team_flag;?>" alt="Lithuania (LT)" />
                      <div class="lithuania valign-text-middle poppins-medium-white-16px"><?php echo  $national_team; ?></div>
                    </div>
                  </div>
                </div>
              <?php } ?>
                <div class="debut">
                  <div class="debut-1 poppins-normal-white-12px">Debut</div>
                  <div class="frame-344">
                    <?php    //foreach($national_team_stats as $national_team_statss){?>
                    <div class="frame-34">
                      <div class="date-2 valign-text-middle date-9 poppins-medium-white-16px"><?php echo $latest_debut; ?></div>
                    </div>
                  </div>
                </div>
                <div class="caps">
                  <div class="caps-1 poppins-normal-white-12px">Caps</div>
                  <div class="frame-344">
                    <?php if($caps){?>
                    <div class="frame-34">
                      <div class="address-2 valign-text-middle poppins-medium-white-16px"><?php echo $caps ?> Appearances</div>
                    </div>
                  <?php } ?>
                  </div>
                </div>
                <div class="intl-goalss hiddens">
                  <div class="international-goals poppins-normal-white-12px">International Goals</div>
                  <div class="frame-344">
                    <?php if($international_goals){ ?>
                    <div class="frame-34">
                      <div class="address-2 valign-text-middle poppins-medium-white-16px"><?php echo $international_goals;?> Goals</div>
                    </div>
                  <?php }else{ ?>
                    <div class="frame-34">
                      <div class="address-2 valign-text-middle poppins-medium-white-16px">Null</div>
                    </div>
                  <?php } ?>
                  </div>
                </div>
              </div>
              <div class="line-67"></div>
              <div class="data">
                <?php if(!$second_antion){?>
                <div class="x2nd-nationality">
                  <div class="x2nd-nationality-1 poppins-normal-white-12px">2nd Nationality</div>
                  <div class="frame-344">
                    <div class="frame-34">
                      <img class="lithuania-lt" src="<?php echo $second_flag;?>" alt="Lithuania (LT)" />
                      <div class="lithuania valign-text-middle poppins-medium-white-16px"><?php echo $second_antion;?></div>
                    </div>
                  </div>
                </div>
              <?php }else{ ?>
                   <div class="x4th-nationality">
                  <div class="x4th-nationality-3 poppins-normal-white-12px">2th Nationality</div>
                  <div class="frame-34">
                    <!-- <img class="plus-circle-3" src="https://dualnationals.com/wp-content/themes/Dual-Nationals/assets/img/plus-circle.svg" alt="plus-circle"> -->
                    <div class="add-3 valign-text-middle poppins-medium-white-16px">N/A</div>
                  </div>
                </div>
              <?php } ?>
                <div class="x3rd-nationality">
                  <div class="x3rd-nationality-1 poppins-normal-white-12px">3rd Nationality</div>
                  <div class="frame-34">
                    <!-- <img class="plus-circle" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/plus-circle.svg" alt="plus-circle" /> -->
                    <div class="add-3 valign-text-middle poppins-medium-white-16px">N/A</div>
                  </div>
                </div>
                <div class="x4th-nationality">
                  <div class="x4th-nationality-3 poppins-normal-white-12px">4th Nationality</div>
                  <div class="frame-34">
                    <!-- <img class="plus-circle-3" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/plus-circle.svg" alt="plus-circle" /> -->
                    <div class="add-3 valign-text-middle poppins-medium-white-16px">N/A</div>
                  </div>
                </div>
                <div class="frame-34453 hidden">
                  <div class="x4th-nationality-3 poppins-normal-white-12px">4th Nationality</div>
                  <div class="frame-34">
                    <!-- <img class="plus-circle-2 plus-circle-3" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/plus-circle-4@2x.png" alt="plus-circle" /> -->
                    <div class="add-3 valign-text-middle poppins-medium-white-16px">N/A</div>
                  </div>
                </div>
<!--                 <img class="edit-2-1" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/edit-2-1.svg" alt="edit-2" /> -->
              </div>
            </div>
            <!-- <div class="line-10"></div> -->
          </div>
        </div>
        
        <!----------------------------------------->
        <div class="current_season_flex six_cards">
        <div class="current_season">
          <div class="current_season_head">
            <div class="current_season_img">
              <img src="https://tmssl.akamaized.net/images/wappen/normquad/27.png?lm=1498251238" alt="">
            </div>
            <h3>Current Season Stats</h3>
          </div>
          <ul class="current_season_list li_counts" id="current_session_cpount">

            <?php for( $i=0;$i<$array_length;$i++){  $competion = $current_stats->competions[$i]; ?>
              <li>
                <div class="current_list">
                  <div class="current_list_img">
                    <!-- <img src="<?php echo $league_logo; ?>" alt=""> -->
                    <img src="https://tmssl.akamaized.net/images/wappen/normquad/27.png?lm=1498251238" alt="">
                  </div>
                  <h4><?php echo $competion; ?></h4>
                </div>
              </li>
            <?php } ?>
          </ul>
        </div>
        <div class="current_season">
          <div class="current_season_head">
            <h3>Matches</h3>
          </div>
          <ul class="current_season_list">
            <?php for( $i=0;$i<$array_length;$i++){  $appearances = $current_stats->appearances[$i]; ?>
              <li>
                <div class="current_list">
                  <div class="current_list_img">
                    <img class="qute_green" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/formation-filled.svg" alt="">
                  </div>
                  <h4><?php echo $appearances; ?></h4>
                </div>
              </li>
            <?php } ?>


          </ul>
        </div>
        <div class="current_season">
          <div class="current_season_head">

            <h3>Goals</h3>
          </div>
          <ul class="current_season_list">
            <?php for( $i=0;$i<$array_length;$i++){  $goals = $current_stats->goals[$i]; ?>
              <li>
                <div class="current_list">
                  <div class="current_list_img">
                    <img class="qute_greens" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon---match-14.svg" alt="">
                  </div>
                  <?php if ($goals ) { ?>
                    <h4><?php echo $goals ; ?></h4>
                  <?php } else { ?>
                    <h4>-</h4>
                  <?php } ?>
                </div>
              </li>
            <?php } ?>

          </ul>
        </div>
        <div class="current_season">
          <div class="current_season_head">

            <h3>Assists</h3>
          </div>
          <ul class="current_season_list">
            <?php for( $i=0;$i<$array_length;$i++){  $assists = $current_stats->assists[$i];?>
              <li>
                <div class="current_list">
                  <div class="current_list_img">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon---assist.svg" alt="">
                  </div>
                  <?php if ($assists) { ?>
                    <h4><?php echo  $assists; ?></h4>
                  <?php } else { ?>
                    <h4><?php echo  $assists; ?></h4>
                  <?php } ?>
                </div>
              </li>
            <?php } ?>
          </ul>
        </div>
        <div class="current_season curr_yellow">
          <div class="current_season_head">

            <h3>Min. Played</h3>
          </div>
          <ul class="current_season_list append_li" id="append_lis">


            <?php //foreach ($club_stats_mins_decode as $key => $club_stats_mins_decodes) { 
            ?>
            <li>
              <div class="current_list">
                <div class="current_list_img">
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/material-symbols-timer-outline-rounded-14.svg" alt="">
                </div>

                <h4>-<?php //echo $club_stats_mins_decodes; 
                      ?></h4>



              </div>
            </li>
            <?php //} 
            ?>
          </ul>
        </div>
        <div class="current_season ">
          <div class="current_season_head">

            <h3>Yellow</h3>
          </div>
          <ul class="current_season_list">
            <?php for( $i=0;$i<$array_length;$i++){  $yellow_cards = $current_stats->yellow_cards[$i]; ?>
              <li>
                <div class="current_list">
                  <div class="current_list_img">

                  </div>
                  <?php if ($yellow_cards) { ?>
                    <h4><span></span><?php echo $yellow_cards; ?></h4>
                  <?php } else { ?>
                    <h4><span></span>-</h4>

                  <?php } ?>
                </div>
              </li>
            <?php } ?>
          </ul>
        </div>
        <div class="current_season curr_red">
          <div class="current_season_head">

            <h3>Red</h3>
          </div>
          <ul class="current_season_list">
            <?php for( $i=0;$i<$array_length;$i++){  $red_cards = $current_stats->red_cards[$i];?>
              <li>
                <div class="current_list">
                  <div class="current_list_img">

                  </div>
                  <?php if ($red_cards) { ?>
                    <h4><span></span><?php echo $red_cards; ?></h4>
                  <?php } else { ?>
                    <h4><span></span>-</h4>
                  <?php } ?>

                </div>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>

<!----------------------------------------->
<!-------------Club History Start---------->
<div class="current_season_flex five_cards">
        <div class="current_season">
          <div class="current_season_head">
            <!-- <div class="current_season_img">
                <img src="img/logo1.png" alt="">
            </div> -->
            <h3>Club History</h3>
          </div>
          <ul class="current_season_list li_counts" id="li_counts">
            <?php for ($i=0;$i<$club_length;$i++) { ?>
              <li>
                <div class="current_list">
                  <div class="current_list_img">
                    <!-- <img src="<?php echo $league_logo; ?>" alt=""> -->
                    <img src="https://tmssl.akamaized.net/images/wappen/normquad/27.png?lm=1498251238" alt="">
                  </div>
                  <h4><?php echo $clubs_object->clubs[$i]; ?></h4>
                </div>
              </li>
            <?php } ?>
          </ul>
        </div>
        <div class="current_season">
          <div class="current_season_head">
            <h3>Join Date</h3>
          </div>
          <ul class="current_season_list append_li" id='append_lise'>



            <li>
              <div class="current_list">

                <h4><?php echo $joined_date; ?></h4>
              </div>
            </li>

          </ul>
        </div>
        <div class="current_season">
          <div class="current_season_head">

            <h3>Matches</h3>
          </div>
          <ul class="current_season_list">
            <?php for ($i=0;$i<$club_length;$i++) { ?>
              <li>
                <div class="current_list">
                  <div class="current_list_img">
                    <img class="qute_green" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/formation-filled.svg" alt="">
                  </div>
                  <h4><?php echo $clubs_object->appearances[$i]; ?></h4>
                </div>
              </li>
            <?php } ?>
          </ul>
        </div>
        <div class="current_season">
          <div class="current_season_head">

            <h3>Goals</h3>
          </div>
          <ul class="current_season_list">
            <?php for ($i=0;$i<$club_length;$i++) { ?>
              <li>
                <div class="current_list">
                  <div class="current_list_img">
                    <img class="qute_greens" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon---match-14.svg" alt="">
                  </div>
                  <?php if ($clubs_object->goals[$i]) { ?>
                    <h4><?php echo $clubs_object->goals[$i]; ?></h4>
                  <?php } else { ?>
                    <h4>-</h4>
                  <?php } ?>
                </div>
              </li>
            <?php } ?>
          </ul>
        </div>
        <div class="current_season curr_yellow">
          <div class="current_season_head">

            <h3>Assists</h3>
          </div>
          <ul class="current_season_list">
            <?php for ($i=0;$i<$club_length;$i++) { ?>
              <li>
                <div class="current_list">
                  <div class="current_list_img">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon---assist.svg" alt="">
                  </div>
                  <?php if ($clubs_object->assists[$i]) { ?>
                    <h4><?php echo $clubs_object->assists[$i]; ?></h4>
                  <?php } else { ?>
                    <h4><?php echo $clubs_object->assists[$i]; ?></h4>
                  <?php } ?>
                </div>
              </li>
            <?php } ?>
          </ul>
        </div>
        <div class="current_season curr_red">
          <div class="current_season_head">

            <h3>Min. Played</h3>
          </div>
          <ul class="current_season_list">
            <?php for ($i=0;$i<$club_length;$i++) { ?>
              <li>
                <div class="current_list">
                  <div class="current_list_img">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/material-symbols-timer-outline-rounded-14.svg" alt="">
                  </div>
                  <?php if ($clubs_object->mins[$i]) { ?>
                    <h4><?php echo $clubs_object->mins[$i]; ?></h4>

                  <?php } else { ?>
                    <h4><span></span>-</h4>
                  <?php } ?>
                </div>
              </li>
            <?php } ?>
          </ul>
        </div>
        <div class="current_season alignment_settings">
          <div class="current_season_head">

            <h3>Min. Playedss</h3>
          </div>
          <ul class="current_season_list append_li" id='append_lise'>
            <li class="appends counts_li0"></li>
          </ul>
        </div>

      </div>
        <!-------------Club History End----------------------------->

         <!-----------------National team history---------------------------->
         <div class="current_season_flex four_cards">
        <div class="current_season">
          <div class="current_season_head">
            <!-- <div class="current_season_img">
                <img src="img/logo1.png" alt="">
            </div> -->
            <h3>National Team History</h3>
          </div>
          <ul class="current_season_list">
           <?php    for ($i=0;$i<$national_team_length;$i++){ ?>
            <li>
              <div class="current_list">
                <div class="current_list_img">
                  <img src="<?php echo $national_team_stats->teams_flag[$i]; ?>" alt="">
                </div>
                <h4><?php echo $national_team_stats->national_team[$i]; ?></h4>
              </div>
            </li> 
            <?php } ?>
          </ul>
        </div>
        <div class="current_season">
          <div class="current_season_head">
            <h3>Debut</h3>
          </div>
          <ul class="current_season_list">

            <?php $counts = 0;
          for ($i=0;$i<$national_team_length;$i++){
              $counts++;
            ?>

              <li>
                <div class="current_list">

                  <h4><?php echo $national_team_stats->debut[$i]; ?></h4>
                </div>
              </li>

            <?php } ?>
          </ul>
        </div>
        <div class="current_season">
          <div class="current_season_head">

            <h3>Matches</h3>
          </div>
          <ul class="current_season_list">
            <?php   for ($i=0;$i<$national_team_length;$i++){ ?>
              <li>
                <div class="current_list">
                  <div class="current_list_img">
                    <img class="qute_green" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/formation-filled.svg" alt="">
                  </div>
                  <h4><?php echo $national_team_stats->appearances[$i]; ?></h4>
                </div>
              </li>
            <?php } ?>
        </div>
        <div class="current_season">
          <div class="current_season_head">

            <h3>Goals</h3>
          </div>
          <ul class="current_season_list">

            <?php  for ($i=0;$i<$national_team_length;$i++){ ?>
              <li>
                <div class="current_list">
                  <div class="current_list_img">
                    <img class="qute_greens" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon---match-4.svg" alt="">
                  </div>
                  <?php if ($national_team_stats->goals[$i]) { ?>
                    <h4><?php echo $national_team_stats->goals[$i]; ?></h4>
                  <?php } else { ?>
                    <h4>-</h4>
                  <?php } ?>
                </div>
              </li>
            <?php } ?>
          </ul>
        </div>


        <div class="current_season">
        <div class="current_season_head">
            
            <h3>Age at Debut</h3>
        </div>
        <ul class="current_season_list">
            <?php 
           for ($i=0;$i<$national_team_length;$i++) {  ?>
            <li>
                <div class="current_list">
                    <div class="current_list_img">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/material-symbols-timer-outline-rounded-14.svg" alt="">
                    </div>
                    <?php if($national_team_stats->age_at_debut[$i]){?>
                       <h4><?php echo $national_team_stats->age_at_debut[$i]; ?></h4>
                    <?php }else{?>
                    <h4><span></span>-</h4>
                  <?php } ?>
                </div>
            </li>
          <?php } ?>
        </ul>
    </div>

     
        <!--  <div class="current_season alignment_settings">
      <div class="current_season_head">
            
            <h3>Age at Debuts</h3>
        </div>
      <ul class="current_season_list append_li" id="append_liss">
                              <li class="appends counts_li0"></li></ul>
    </div> -->
      </div>
        <!-----------------National team history end-------------------->
      </div>
    </div>
    <?php }  
  fclose($file);
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');
readfile($filename);

  ?>