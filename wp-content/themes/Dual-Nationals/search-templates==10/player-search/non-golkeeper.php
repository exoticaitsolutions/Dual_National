<?php // Custom search.php file
// Add your custom code for search functionality here

// Example: Display search results

$targetName = $_GET['players'];
// $premium_result = $wpdb->get_results( "SELECT * FROM `wp_player_details` WHERE name = '$targetName'" );



$targetName = $_GET['players'];
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
// fputcsv($file, array('id', 'Name', 'Age', 'club_name'));
foreach ($rowsArr as $pre_results) {
  // echo "<pre>";
  // print_r($pre_results);
  // echo "</pre>";
  $status = $pre_results->status;
  $player_id = $pre_results->id;
  if (isset($_POST['download_csv'])) {
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





  // echo '<pre>';
  // print_r($pre_results);
  //$player_id = $pre_results->id;
  //   $get_positions = $pre_results->main_position;
  //   $player_img        =      $pre_results->headshot;
  //   $player_name       =      $pre_results->name;
  //   $club_name         =      $pre_results->club;
  //   $league_name       =      $pre_results->league_name;
  //   $league_logo       =      $pre_results->league_logo;
  //   $caps              =      $pre_results->caps;
  //   $league_level      =      $pre_results->league_level;
  //   $market_value      =      $pre_results->market_value;
  //   $contract_expires  =      $pre_results->contract_expires;
  //   $date_of_birth     =      $pre_results->date_of_birth;
  //   $age               =      $pre_results->age;
  //   $height            =      $pre_results->height;
  //   $place_of_birth    =      $pre_results->place_of_birth;
  //   $place_of_birth_flag  =      $pre_results->place_of_birth_flag;
  //   $other_postions    =      $pre_results->other_postions;
  //   $other_postions_decode = json_decode($other_postions , true);
  //   $temp_other_postions = [];
  //   foreach($other_postions_decode as $val){
  //     if(!in_array($val, ['',' ']) && $val != NULL){
  //       $temp_other_postions[] = $val;
  //     }
  //   }
  //   $other_postions_decode = $temp_other_postions;
  //   $player_first_position = $other_postions_decode[0];
  //   $player_scnd_position = $other_postions_decode[1];
  //   $citizenship_flag  =      $pre_results->citizenship_flag;
  //   $citizenship_decode = json_decode($citizenship_flag, true);
  //   $first_flag =$citizenship_decode[0];
  //   $second_flag =$citizenship_decode[1];
  //   $international_goals  =      $pre_results->international_goals;
  //   $national_team_stats_debut  =      $pre_results->national_team_stats_debut;
  //   $national_team_stats = json_decode($national_team_stats_debut);
  //  $national_team_flag = $pre_results->national_team_flag;
  //   $citizenship  =      $pre_results->citizenship;

  //   $array = json_decode($citizenship, true);
  //   $second_antion=$array[1];
  //   $first_antion=$array[0];
  //   $club_stats_appearances  =      $pre_results->club_stats_appearances;
  //   $current_seasons_stats_competions  =      $pre_results->current_seasons_stats_competions;
  //   $session_states_decode = json_decode($current_seasons_stats_competions);
  //   $club_stats_appearances_decodes = json_decode($club_stats_appearances);
  //   $club_stats_clubs  =      $pre_results->club_stats_clubs;
  //   $club_stats_clubs_decodes = json_decode($club_stats_clubs);
  //   $joined_date  =      $pre_results->joined_date;
  //   $national_team  =      $pre_results->national_team;
  //   $current_stats_cleansheets = $pre_results->current_seasons_stats_cleansheets;
  //   $cleansheets_dcode = json_decode($current_stats_cleansheets);
  //   $current_goals_conceded = $pre_results->club_statsgoals;
  //   $current_goals_conceded_decode = json_decode($current_goals_conceded);
  //   $club_stats_assists = $pre_results->club_stats_assists;
  //   $club_stats_assists_decode = json_decode($club_stats_assists);
  //   $club_stats_mins = $pre_results->club_stats_mins;
  //   $club_stats_mins_decode = json_decode($club_stats_mins);
  //   $current_seasons_stats_yellow_cards =  $pre_results->current_seasons_stats_yellow_cards;
  //   $current_seasons_stats_yellow_decode = json_decode($current_seasons_stats_yellow_cards);
  //   $current_seasons_stats_red_cards =  $pre_results->current_seasons_stats_red_cards;
  //   $current_seasons_stats_red_decode= json_decode($current_seasons_stats_red_cards);
  //   $national_team_stats_national_team = $pre_results->national_team_stats_national_team;
  //   $current_seasons_stats_appearances = $pre_results->current_seasons_stats_appearances;
  //   $current_seasons_stats_appea_data = json_decode($current_seasons_stats_appearances);
  //   $current_seasons_stats_goals = $pre_results->current_seasons_stats_goals;
  //   $current_seasons_stats_goal_decode  = json_decode($current_seasons_stats_goals);
  //   $current_seasons_stats_assists = $pre_results->current_seasons_stats_assists;
  //   $current_seasons_stats_decode = json_decode($current_seasons_stats_assists);
  //   $club_stats_appearancesss = $pre_results->club_stats_appearances;
  //   $club_stats_appeara_decoded = json_decode($club_stats_appearancesss);
  //   $national_team_stats_appearances = $pre_results->national_team_stats_appearances;
  //   $national_team_stats_appearan_data = json_decode($national_team_stats_appearances);
  //   $national_team_stats_goals = json_decode( $pre_results->national_team_stats_goals);
  $current_user = wp_get_current_user();
  $mepr_agency_name = get_user_meta($current_user->ID, 'mepr_agency_name', true);
  $mepr_agent_name = get_user_meta($current_user->ID, 'mepr_agent_name', true);
  $mepr_agent_phone = get_user_meta($current_user->ID, 'mepr_agent_phone', true);
  $mepr_agent_email = get_user_meta($current_user->ID, 'mepr_agent_email', true);

?>
  <input type="hidden" id="anPageName" name="page" value="goalkeeper" />
  <div class="container-center-horizontal">
    <div class="goalkeeper screen">
      <div class="player-container">
        <div class="flex-col">
          <div class="header-1">
            <?php if ($player_img) { ?>\
            <div class="player-photo"><img class="image-290" src="<?php echo $player_img; ?>" alt="image 290" /></div>
          <?php } ?>
          <div class="frame-34728">
            <div class="name name-4">
              <?php if ($player_name) { ?>
                <div class="name-1 name-4">
                  <h1 class="name-2 name-4 mb-0">
                    <?php echo $player_name; ?>
                  </h1>
                  <div class="tooltips">
                    <img class="material-symbolsverified-rounded" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/material-symbols-verified-rounded.svg" alt="material-symbols:verified-rounded">
                    <span class="tooltiptext">This account has been claimed by the profile owner using a goverment isssued ID.</span>
                  </div>
                </div>
              <?php } ?>
              <img class="line-103" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line-103-4.svg" alt="Line 103" />
              <div class="jersey">
                <div class="jersey-1"></div>
                <?php if ($caps) { ?>
                  <div class="number valign-text-middle number-32 poppins-medium-white-16px"><?php echo $caps; ?>
                  </div>
                <?php } ?>
              </div>
            </div>
            <div class="frame-34731">
              <div class="frame-34731-item">
                <div class="club-logo">
                  <div class="group-41"></div>
                </div>
                <div class="frame-34481">
                  <?php if ($club_name) { ?>
                    <div class="frame-34">
                      <div class="arsenal valign-text-middle arsenal-2 poppins-semi-bold-white-16px"><?php echo $club_name; ?>
                      </div>
                    </div>
                  <?php } ?>
                  <?php if ($get_positions) { ?>
                    <div class="frame-34727">
                      <div class="goalkeeper-1 poppins-normal-white-12px"><?php echo $get_positions; ?></div>
                    </div>
                  <?php } ?>
                </div>
              </div>
              <div class="frame-34731-item">
                <?php if ($league_logo) { ?>
                  <div class="competition-logo-1">
                    <img class="image-98" src="<?php echo $league_logo; ?>" alt="image 98" />
                  </div>
                <?php } ?>
                <div class="frame-34481-4">
                  <?php if ($league_name) { ?>
                    <div class="frame-34">
                      <div class="premier-league valign-text-middle poppins-semi-bold-white-16px"><?php echo $league_name; ?>
                      </div>
                    </div>
                  <?php } ?>
                  <div class="frame-34727">
                    <div class="first-tier poppins-normal-white-12px">First Tier</div>
                  </div>
                </div>
              </div>
              <img class="line-103-1" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line-103-5.svg" alt="Line 103" />
              <div class="frame-34731-item">
                <div class="frame-34481-4">
                  <?php if ($market_value) { ?>
                    <div class="frame-34">
                      <div class="x5m valign-text-middle poppins-semi-bold-white-16px">€<?php echo $market_value; ?></div>
                    </div>
                  <?php } ?>
                  <div class="frame-34727">
                    <div class="market-value poppins-normal-white-12px">Market Value</div>
                  </div>
                </div>
              </div>
              <div class="frame-34731-item">
                <div class="frame-34481-4">
                  <?php if ($contract_expires) { ?>
                    <div class="frame-34">
                      <div class="date valign-text-middle date-9 poppins-semi-bold-white-16px"><?php echo $contract_expires; ?>

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
              $table = $wpdb->prefix . 'Wishlist_data_list';
              $fech_players_data = $wpdb->get_row("SELECT *  FROM $table where Player_id=" . $player_id . " AND User_id=" . get_current_user_id() . "");
              if ($fech_players_data) { ?>
                <div class="save_favrt" id="save_favrt" wishlist_exit="true" wishlist_id="<?php echo $fech_players_data->id; ?>">
                  <input type="hidden" name="admin_url" id="admin_url" value="<?php echo admin_url('admin-ajax.php'); ?>">
                  <input type="hidden" name="image_url" id="image_url" value="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/fi-heart-2.svg">
                  <input type="hidden" name="player_id" id="player_id" value="<?php echo $player_id; ?>">
                  <input type="hidden" name="current_user_id" id="current_user_id" value="<?php echo get_current_user_id(); ?>">
                  <img id="my_image" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/heart-01.svg" alt="">
                </div>
              <?php
              } else { ?>
                <div class="save_favrt" id="save_favrt" wishlist_exit="false" wishlist_id="">
                  <input type="hidden" name="admin_url" id="admin_url" value="<?php echo admin_url('admin-ajax.php'); ?>">
                  <input type="hidden" name="player_id" id="player_id" value="<?php echo $player_id; ?>">
                  <input type="hidden" name="current_user_id" id="current_user_id" value="<?php echo get_current_user_id(); ?>">
                  <input type="hidden" name="image_url" id="image_url" value="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/heart-01.svg">
                  <img id="my_image" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/fi-heart-2.svg" alt="">
                </div>
              <?php } ?>
              <div class="tooltip tooltip_dots">
                <img class="more" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/more.svg" alt="More" />
                <span class="tooltiplink">
                  <form method="post">
                    <a download_csv download_csv href="<?php echo $filename; ?>">Download CSV
                    </a>
                  </form>
                </span>
              </div>
            </div>
            <div class="claim">
              <div class="claim-this-profile valign-text-middle">Claim this profile
              </div>
              <img class="arrow-right" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow-right.svg" alt="arrow-right" />
            </div>
          </div>
          </div>
          <div class="player-info">
            <div class="x-info">
              <div class="player-info-1 poppins-medium-white-22px">Player Info</div>
              <img class="edit-2 player_info" data-bs-toggle="modal" data-bs-target="#exampleModal" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/edit-2.svg" alt="edit-2" />
            </div>
            <div class="data-2">
              <div class="flex-row">
                <div class="birth birth-2">
                  <div class="birth-1 birth-2 poppins-normal-white-12px">Birth</div><?php if ($date_of_birth) { ?>
                    <div class="frame-344">
                      <div class="date-1 valign-text-middle date-9 poppins-medium-white-16px"><?php echo $date_of_birth; ?>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <div class="age age-2">
                  <div class="age-1 age-2 poppins-normal-white-12px">Age</div>
                  <?php if ($age) { ?>
                    <div class="frame-344">
                      <div class="number-1 valign-text-middle number-32 poppins-medium-white-16px"><?php echo $age; ?>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <div class="flex-row-item">
                  <div class="height poppins-normal-white-12px">Height</div>
                  <?php if ($height) { ?>
                    <div class="frame-344">
                      <div class="frame-34">
                        <div class="x186-m valign-text-middle poppins-medium-white-16px"><?php echo $height; ?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <div class="flex-row-item">
                  <div class="place-of-birth poppins-normal-white-12px">Place of Birth
                  </div>
                  <div class="frame-344">
                    <div class="frame-34">
                      <?php if ($place_of_birth_flag) { ?>
                        <img class="flag-square" src="<?php echo $place_of_birth_flag; ?>" alt="Flag Square" />
                      <?php } ?>
                      <?php if ($place_of_birth) { ?>
                        <div class="surname valign-text-middle surname-2 poppins-medium-white-16px">
                          <?php echo $place_of_birth; ?>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="position position-2 position_position">
                  <div class="position-1 position-2 poppins-normal-white-12px">Position(s)
                  </div>
                  <div class="frame-34733 poppins-normal-white-16px coma_gap">
                    <div class="right-winger">
                      <?php
                      echo $get_positions;
                      ?>
                    </div>
                    <?php if ($other_postions_seprate) {  ?>
                      <div class="right-winger apped_txt"><span class="commas_">,</span><?php echo $other_postions_seprate; ?> </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="line-10"></div>
          <div class="flex-col-item flex-col-2">
            <div class="x-info">
              <div class="nationality nationality-2 poppins-medium-white-22px">Nationality
              </div>
            </div>
            <div class="data">
              <?php if (!$first_antion) { ?>
                <div class="nationality-1 nationality-2">
                  <div class="nationality-national-team poppins-normal-white-12px">Nationality (National Team)</div>
                  <div class="frame-344">
                    <div class="frame-34">
                      <img class="flag-square-1" src="<?php echo  $first_flag; ?>" alt="Flag Square" />
                      <div class="place valign-text-middle place-2 poppins-medium-white-16px"><?php echo $first_antion; ?></div>
                    </div>
                  </div>
                </div>
              <?php } else { ?>
                <div class="nationality-1 nationality-2">
                  <div class="nationality-national-team poppins-normal-white-12px">Nationality (National Team)</div>
                  <div class="frame-344">
                    <div class="frame-34">
                      <img class="flag-square-1" src="<?php echo  $national_team_flag; ?>" alt="Flag Square" />
                      <div class="place valign-text-middle place-2 poppins-medium-white-16px"><?php echo $national_team; ?></div>
                    </div>
                  </div>
                </div>
              <?php }               ?>
              <div class="debut">
                <div class="debut-1 poppins-normal-white-12px">Debut</div>
                <div class="frame-344">
                  <?php    //foreach($national_team_stats as $national_team_statss){
                  ?>
                  <div class="frame-34">
                    <div class="date-2 valign-text-middle date-9 poppins-medium-white-16px"><?php echo $latest_debut; ?></div>
                  </div>
                  <?php //} 
                  ?>

                </div>
              </div>
              <div class="caps">
                <div class="caps-1 poppins-normal-white-12px">Caps</div>
                <div class="frame-344">
                  <?php if ($caps) { ?>
                    <div class="frame-34">
                      <div class="address-2 valign-text-middle poppins-medium-white-16px"><?php echo $caps ?> Appearances</div>
                    </div>
                  <?php } ?>
                </div>
              </div>
              <div class="intl-goalss hiddens">
                <div class="international-goals poppins-normal-white-12px">International Goals</div>
                <div class="frame-344">
                  <?php if ($international_goals) { ?>
                    <div class="frame-34">
                      <div class="address-2 valign-text-middle poppins-medium-white-16px"><?php echo $international_goals; ?> Goals</div>
                    </div>
                  <?php } else { ?>
                    <div class="frame-34">
                      <div class="address-2 valign-text-middle poppins-medium-white-16px">Null</div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="line-67"> </div>
            <div class="data">
              <?php if (!$second_antion) { ?>
                <div class="x2nd-nationality">
                  <div class="x2nd-nationality-1 poppins-normal-white-12px">2nd Nationality</div>
                  <div class="frame-344">
                    <div class="frame-34">
                      <img class="lithuania-lt" src="<?php echo $second_flag; ?>" alt="Lithuania (LT)" />
                      <div class="lithuania valign-text-middle poppins-medium-white-16px"><?php echo $second_antion; ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } else { ?>
                <div class="x4th-nationality">
                  <div class="x4th-nationality-3 poppins-normal-white-12px">2th Nationality
                  </div>
                  <div class="frame-34" data-bs-toggle="modal" data-bs-target="#exampleModal_second">
                    <img class="plus-circle-3" src="https://dualnationals.com/wp-content/themes/Dual-Nationals/assets/img/plus-circle.svg" alt="plus-circle">
                    <div class="add-3 valign-text-middle poppins-medium-white-16px">Add
                    </div>
                  </div>
                </div>
              <?php } ?>
              <div class="x3rd-nationality">
                <div class="x3rd-nationality-1 poppins-normal-white-12px">3rd Nationality
                </div>
                <div class="frame-34">
                  <img class="plus-circle" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/plus-circle.svg" alt="plus-circle" />
                  <div class="add-3 valign-text-middle poppins-medium-white-16px">Add
                  </div>
                </div>
              </div>
              <div class="x4th-nationality">
                <div class="x4th-nationality-3 poppins-normal-white-12px">4th Nationality
                </div>
                <div class="frame-34">
                  <img class="plus-circle-3" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/plus-circle.svg" alt="plus-circle" />
                  <div class="add-3 valign-text-middle poppins-medium-white-16px">Add</div>
                </div>
              </div>
              <div class="frame-34453 hidden">
                <div class="x4th-nationality-3 poppins-normal-white-12px">4th Nationality</div>
                <div class="frame-34">
                  <img class="plus-circle-2 plus-circle-3" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/plus-circle-4@2x.png" alt="plus-circle" />
                  <div class="add-3 valign-text-middle poppins-medium-white-16px">Add</div>
                </div>
              </div>
              <img class="edit-2-1" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/edit-2-1.svg" alt="edit-2" />
            </div>
          </div>
          <div class="line-10"> </div>
   
          <div class="flex-col-item flex-col-2">
            <div class="x-info">
              <div class="agent-info agent poppins-medium-white-22px">Agent Info
              </div>
              <img class="edit-2-2 56t" id="edit_cls" data-bs-toggle="modal" data-bs-target="#edit_info_agent" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/edit-2-2.svg" alt="edit-2" />
            </div>
            <div class="data">
              <div class="agent-name agent">
                <div class="agent-name-1 poppins-normal-white-12px">Agency Name
                </div>
                <?php if ($agency_name) { ?>
                  <div class="add-3 valign-text-middle poppins-medium-white-16px"><?php echo $agency_name; ?>
                  </div>
                <?php } else { ?>
                  <div class="frame-344">
                    <div class="frame-34" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                      <img class="plus-circle-3" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/plus-circle.svg" alt="plus-circle">
                      <div class="add-3 valign-text-middle poppins-medium-white-16px">Add
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
              <div class="agency">
                <div class="place-1 place-2 poppins-normal-white-12px">Agent Name
                </div>
                <?php if ($agency_agency) { ?>
                  <div class="add-3 valign-text-middle poppins-medium-white-16px"><?php echo $agency_agency; ?></div>
                <?php } else { ?>
                  <div class="frame-34" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <img class="plus-circle-3" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/plus-circle.svg" alt="plus-circle">
                    <div class="add-3 valign-text-middle poppins-medium-white-16px">Add
                    </div>
                  </div>
                <?php } ?>
              </div>
              <div class="agent-phone agent">
                <div class="agent-phone-1 poppins-normal-white-12px">Agent Phone
                </div>
                <?php if ($agency_agent_phone) { ?>
                  <div class="add-3 valign-text-middle poppins-medium-white-16px"><?php echo $agency_agent_phone; ?></div>
                <?php } else { ?>
                  <div class="frame-34" data-bs-toggle="modal" data-bs-target="#exampleModals">
                    <img class="plus-circle-3" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/plus-circle.svg" alt="plus-circle">
                    <div class="add-3 valign-text-middle poppins-medium-white-16px">Add
                    </div>
                  </div>
                <?php } ?>
              </div>
              <div class="agent-email agent">
                <div class="agent-email-1 poppins-normal-white-12px">Agent Email
                </div>
                <?php if ($agent_email) { ?>
                  <div class="add-3 valign-text-middle poppins-medium-white-16px"><?php echo $agent_email; ?></div>
                <?php } else { ?>
                  <div class="frame-34" data-bs-toggle="modal" data-bs-target="#exampleModals6">
                    <img class="plus-circle-3" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/plus-circle.svg" alt="plus-circle">
                    <div class="add-3 valign-text-middle poppins-medium-white-16px">Add
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
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

                <h4>NAN<?php //echo $club_stats_mins_decodes; 
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
      <!-------------Club History Start----------------------------->
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
          <ul class="current_season_list li_counts" id="li_countss_debut">

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
?>
<!-- Agent Name-->
<div class="modal fade player_member_popup" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agent Name</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="contactForm1ss" method="post" enctype="multipart/form-data" novalidate="novalidate">
          <div class="my_account_bgs">
            <div class="container">
              <div class="row">
                <div class="col-md-12 mb-3">
                  <div class="profiel_details_crds">
                    <?php global $wpdb;
                    $agent_data = $wpdb->get_results("SELECT * FROM `wp_agent_info` WHERE player_id = '$player_id'");
                    foreach ($agent_data as $agent_datas) {
                      $agent_name = $agent_datas->agent_name;
                      $agent_email = $agent_datas->agent_email;
                      $agent_phone = $agent_datas->agent_phone;
                      $country_codes = $dtass->country_code;
                      $country_code_names = $dtass->country_code_name;
                    }
                    if (isset($_POST['add_agent'])) {
                      print_r($_POST);
                      $agent_name = $_POST['agent_name'];
                      $agent_phone = $_POST['agent_phone'];
                      $agent_email = $_POST['agent_email'];
                      $player_details_table = $wpdb->prefix . 'agent_info';
                      $data = array(
                        'player_id' => $player_id,
                        'agent_name' => $agent_name,
                        'agent_email' => $agent_email,
                        'agent_phone' => $agent_phone,
                        'country_code' => $country_codes,
                        'country_code_name' => $country_code_names
                      );
                      $wpdb->insert($player_details_table, $data);
                    } ?>
                    <h6>Agent Name</h6>
                    <div class="edit_profiles">
                      <img src="https://dualnationals.com/wp-content/themes/Dual-Nationals/assets/img/edit.png" alt="">
                      <input type="text" class="agent_name" name="agent_name" value="<?php echo $agent_name; ?>">
                      <input type="hidden" class="agent_email" name="agent_email" value="<?php echo $agent_email; ?>">
                      <input type="hidden" class="agent_phone" name="agent_phone" value="<?php echo $agent_phone; ?>">
                      <input type="hidden" id="country_codes" name="country_code" value="<?php echo $country_codes; ?>">
                      <input type="hidden" id="country_code_names" name="country_code_name" value="<?php echo $country_code_names; ?>">
                    </div>
                    <div class="edit_profiel_btn text-center">
                      <div class="modal-footers 1">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="theme_btn" name="add_agent" value="Save Changes" autocomplete="on">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

<!-- Agent Phone-->
<div class="modal fade player_member_popup" id="exampleModals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Phone Number</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="contactForm1ss" method="post" enctype="multipart/form-data" novalidate="novalidate">
          <div class="my_account_bgs">
            <div class="container">
              <div class="row">
                <div class="col-md-12 mb-3">
                  <div class="profiel_details_crds">
                    <?php global $wpdb;
                    $agent_data = $wpdb->get_results("SELECT * FROM `wp_agent_info` WHERE player_id = '$player_id'");
                    foreach ($agent_data as $agent_datas) {
                      echo '<pre>';
                      print_r($agent_datas);
                      $agent_email = $agent_datas->agent_email;
                      $agent_phone = $agent_datas->agent_phone;
                      $agent_name = $agent_datas->agent_name;
                      $country_codes = $dtass->country_code;
                      //echo $country_codes;
                      $country_code_names = $dtass->country_code_name;
                      // echo $country_codes;
                    }
                    if (isset($_POST['add_phone'])) {
                      print_r($_POST);
                      $agent_name = $_POST['agent_name'];
                      $agent_phone = $_POST['agent_phone'];
                      $agent_email = $_POST['agent_email'];
                      $country_code  = $_POST['country_code'];
                      $country_code_name  = $_POST['country_code_name'];
                      $player_details_table = $wpdb->prefix . 'agent_info';
                      $datas_phn = array(
                        'player_id' => $player_id,
                        'agent_name' => $agent_name,
                        'agent_email' => $agent_email,
                        'agent_phone' => $agent_phone,
                        'country_code' => $country_code,
                        'country_code_name' => $country_code_name,
                      );
                      $datassss =   $wpdb->insert($player_details_table, $datas_phn);
                    } ?>
                    <h6>Agent Phone</h6>
                    <div class="edit_profiles">
                      <img src="https://dualnationals.com/wp-content/themes/Dual-Nationals/assets/img/edit.png" alt="">

                      <input type="tel" id="mobiles" maxlength="10" class="agent_phone" value="<?php echo $agent_phone; ?>" name="agent_phone">
                      <input type="hidden" id="country_codes" name="country_code" value="<?php echo $country_code; ?>">
                      <input type="hidden" id="country_code_names" name="country_code_name" value="<?php echo $country_code_names; ?>">
                      <input type="hidden" id="agent_email" class="agent_email" name="agent_email" value="<?php echo $agent_email; ?>">
                      <input type="hidden" id="agent_name" class="agent_name" name="agent_name" value="<?php echo $agent_name; ?>">
                    </div>
                    <div class="edit_profiel_btn text-center">
                      <div class="modal-footers 2">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="theme_btn" name="add_phone" value="Save Changes" autocomplete="on">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<!-------------------------------->

<!-------------Agent Email----------------->

<div class="modal fade player_member_popup" id="exampleModals6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Email</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="contactForm1ss" method="post" enctype="multipart/form-data" novalidate="novalidate">
          <div class="my_account_bgs">
            <div class="container">
              <div class="row">
                <div class="col-md-12 mb-3">
                  <div class="profiel_details_crds">
                    <?php global $wpdb;
                    $agent_data = $wpdb->get_results("SELECT * FROM `wp_agent_info` WHERE player_id = '$player_id'");
                    foreach ($agent_data as $agent_datas) {
                      $agent_email = $agent_datas->agent_email;
                      $agent_name = $agent_datas->agent_name;
                      $agent_phone = $agent_datas->agent_phone;
                      $country_codes = $dtass->country_code;
                      $country_code_names = $dtass->country_code_name;
                    }

                    // echo '<pre>';

                    if (isset($_POST['add_email'])) {


                      $agent_email = $_POST['agent_email'];
                      // echo $agent_email;
                      $player_details_table = $wpdb->prefix . 'agent_info';
                      $data = array(
                        'player_id' => $player_id,
                        'agent_email' => $agent_email,
                        'agent_name' => $agent_name,
                        'agent_phone' => $agent_phone,
                        'country_code' => $country_codes,
                        'country_code_name' => $country_code_names

                      );
                      $wpdb->insert($player_details_table, $data);
                    } ?>
                    <h6>Agent Email</h6>
                    <div class="edit_profiles">
                      <img src="https://dualnationals.com/wp-content/themes/Dual-Nationals/assets/img/edit.png" alt="">
                      <input type="email" class="agent_email" name="agent_email" value="<?php echo $agent_email; ?>">
                      <input type="hidden" class="agent_email hidden" value="<?php echo $agent_name; ?>" name="agent_name">
                      <input type="hidden" class="agent_phone hidden" value="<?php echo $agent_phone; ?>" name="agent_phone">
                      <input type="hidden" id="country_codes" name="country_code" value="<?php echo $country_codes; ?>">
                      <input type="hidden" id="country_code_names" name="country_code_name" value="<?php echo $country_code_names; ?>">
                    </div>
                    <div class="edit_profiel_btn text-center">
                      <div class="modal-footers 3">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="theme_btn" name="add_email" value="Save Changes" autocomplete="on">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<?php //if($agent_datas){
?>
<div class="modal fade player_member_popup" id="edit_info_agent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Agent Info</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="contactForm1ss" method="post" enctype="multipart/form-data" novalidate="novalidate">
          <div class="my_account_bgs">
            <div class="container">
              <div class="row">
                <?php global $wpdb;
                $agenDta = $wpdb->get_results("SELECT * FROM `wp_agent_info` WHERE player_id = '$player_id'");
                foreach ($agenDta as $dtass) {
                  $agent_names = $dtass->agent_name;
                  $agency_names = $dtass->agency_name;
                  //echo $agent_names;
                  $agent_phone = $dtass->agent_phone;
                  $agent_email = $dtass->agent_email;
                  $country_codes = $dtass->country_code_name;
                  $country_code_names = $dtass->country_code_name;
                }
                if (isset($_POST['edit_agent_info'])) {

                  $agent_name = $_POST['agent_name'];
                  $agency_name = $_POST['agency_name'];
                  $agent_phone = $_POST['agent_phone'];
                  $agent_email = $_POST['agent_email'];
                  $country_code  = $_POST['country_code'];
                  $country_code_name  = $_POST['country_code_name'];


                  $player_details_table = $wpdb->prefix . 'agent_info';

                  if ($dtass) {
                    // echo 'dsdsd';
                    $query = "UPDATE wp_agent_info SET agent_name='$agent_name', agency_name='$agency_name',agent_phone = '$agent_phone' ,agent_email='$agent_email' , country_code = '$country_code' , country_code_name = '$country_code_name' WHERE player_id='$player_id'  ";
                    $wpdb->query($query);
                  } else {
                    // echo 'dsdsd3';
                    $datas_phn = array(
                      'player_id' => $player_id,
                      'agent_name' => $agent_name,
                      'agency_name' => $agency_name,
                      'agent_email' => $agent_email,
                      'agent_phone' => $agent_phone,
                      'country_code' => $country_code,
                      'country_code_name' => $country_code_name,
                    );
                    $datassss =   $wpdb->insert($player_details_table, $datas_phn);
                  }
                }
                ?>

                <div class="col-md-12 mb-3">
                  <div class="profiel_details_crds">
                    <h6>Agency Name</h6>
                    <div class="edit_profiles">
                      <img src="https://dualnationals.com/wp-content/themes/Dual-Nationals/assets/img/edit.png" alt="">
                      <input type="text" class="player_age" name="agency_name" value="<?php echo $agency_names; ?>">

                    </div>
                    <h6>Agent Name</h6>
                    <div class="edit_profiles">
                      <img src="https://dualnationals.com/wp-content/themes/Dual-Nationals/assets/img/edit.png" alt="">
                      <input type="text" class="player_age" name="agent_name" value="<?php echo $agent_names; ?>">

                    </div>

                    <h6>Agent Phone</h6>
                    <div class="edit_profiles">
                      <img src="https://dualnationals.com/wp-content/themes/Dual-Nationals/assets/img/edit.png" alt="">
                      <input type="tel" value="<?php echo $agent_phone; ?>" id="mobile" maxlength="10" name="agent_phone" ?>
                      <input type="hidden" id="country_code" name="country_code" value="<?php echo $country_code; ?>">
                      <input type="hidden" id="country_code_name" name="country_code_name" value="<?php echo $country_code_names; ?>">

                    </div>
                    <h6>Agent Email</h6>
                    <div class="edit_profiles">
                      <img src="https://dualnationals.com/wp-content/themes/Dual-Nationals/assets/img/edit.png" alt="">
                      <input type="text" class="agent_email" name="agent_email" value="<?php echo $agent_email; ?>" autocomplete="on">
                    </div>

                    <div class="edit_profiel_btn text-center">
                      <!--  <a href="/account/?action=subscriptions" class="theme_btn cancel_btn">Cancel Subscriptions</a> -->
                      <div class="modal-footers 4">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="theme_btn" name="edit_agent_info" value="Save Changes" autocomplete="on">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>


<!-----------------Player Position Save------------------>
<div class="modal fade player_member_popup" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Position</h5>
      </div>
      <div class="modal-body">
        <form id="contactForm1ss" method="post" enctype="multipart/form-data" novalidate="novalidate">
          <div class="my_account_bgs">
            <div class="container">
              <div class="row">
                <?php if ($second_antion) { ?>
                  <div class="col-md-12 mb-3">
                    <div class="profiel_details_crds">
                      <?php global $wpdb;
                      if (isset($_POST['update_user_profiles'])) {
                        $main_position = $_POST['main_position'];
                        $other_postions = $_POST['other_postions'];
                        $other_postions2 = $_POST['other_postions2'];
                        $otherposition = array();
                        $otherposition[] = $other_postions;
                        $otherposition[] = $other_postions2;
                        $encode_dta = json_encode($otherposition);
                        $querys = "UPDATE wp_player_details SET main_position='$main_position',  other_postions='$encode_dta' WHERE id='$player_id'  ";
                        $wpdb->query($querys);
                      } ?>
                      <p>Position name :</p>
                      <div class="play_positions"><b>Main Position :</b> <?php echo  $get_positions; ?></div>
                      <?php $countss = 0;
                      foreach ($other_postions_decode as  $other_postions_decodess) {
                        $countss++; ?>
                        <div class="play_positions positions_enters<?php echo $countss; ?>"><b>Other Position:</b> <?php echo $other_postions_decodess; ?></div> <?php
                                                                                                                                                                }
                                                                                                                                                                  ?>

                      <script>
                        setTimeout(function() {

                          jQuery('#add_frm_player').hide();
                          jQuery('.add_first_positions').show();
                          jQuery('.add_second_positions').show();
                        }, 2000);
                      </script>

                      <div class="edit_positions">
                        <a href="javascript:void(0)" id="edit_fields">Edit Positions</a>
                      </div>
                      <div class="my_account_bgs" id="edit_positions">
                        <div class="container">
                          <div class="row">
                            <div class="col-md-12 mb-3">
                              <div class="profiel_details_crds">
                                <h6>Main Position </h6>
                                <div class="edit_profiles">
                                  <img src="https://dualnationals.com/wp-content/themes/Dual-Nationals/assets/img/edit.png" alt="">
                                  <?php $list_positions = $wpdb->get_results("SELECT rest_positions FROM wp_all_positions WHERE rest_positions != '$get_positions' AND rest_positions != '$player_first_position'"); ?>
                                  <select name="main_position" id="rest_positions">
                                    <option value="<?php echo $get_positions; ?>" <?php $get_positions == $get_positions ? ' selected="selected"' : ''; ?>><?php echo $get_positions; ?></option>
                                    <?php foreach ($list_positions as $key => $list_positionss) {
                                      $all_pos = $list_positionss->rest_positions; ?>
                                      <option value="<?php echo $all_pos; ?>"><?php echo $all_pos; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>

                                <div class="add_positions">
                                  <div class="add_first_positions">
                                    <h6 class="player_positions_2">Position 2</h6>
                                    <div class="edit_profiles player_positions_2">
                                      <img src="https://dualnationals.com/wp-content/themes/Dual-Nationals/assets/img/edit.png" alt="">
                                      <select name="other_postions" id="rest_positions2">
                                        <?php if ($other_postions_decode[0]) { ?>
                                          <option class="tsttt" value="<?php echo $other_postions_decode[0]; ?>" <?php $other_postions_decode[0] ==  $other_postions_decode[0] ? ' selected="selected"' : ''; ?>><?php echo  $other_postions_decode[0]; ?>
                                          </option>
                                        <?php } else { ?>
                                          <option class="tsttt33" value=" " <?php $other_postions_decode[0] ==  $other_postions_decode[0] ? ' selected="selected"' : ''; ?>><?php echo  $other_postions_decode[0]; ?>
                                          </option>
                                        <?php } ?>

                                        <?php foreach ($list_positions as $key => $list_positionss) {
                                          $all_pos = $list_positionss->rest_positions; ?>
                                          <option value="<?php echo $all_pos; ?>"><?php echo $all_pos; ?>
                                          </option>
                                        <?php } ?>
                                      </select>
                                      <a href="javascript:void(0)" class="remove_players_list" id="remove_players2">Remove</a>
                                    </div>
                                  </div>

                                  <div class="add_second_positions">
                                    <h6 class="player_positions_3">Position 3</h6>
                                    <div class="edit_profiles player_positions_3">
                                      <img src="https://dualnationals.com/wp-content/themes/Dual-Nationals/assets/img/edit.png" alt="">
                                      <select name="other_postions2" id="rest_positions3">
                                        <?php if ($other_postions_decode[1]) { ?>
                                          <option class="tstttdfd" value="<?php echo $other_postions_decode[1]; ?>" <?php $other_postions_decode[1] ==  $other_postions_decode[1] ? ' selected="selected"' : ''; ?>><?php echo  $other_postions_decode[1]; ?>
                                          </option>
                                        <?php } else { ?>
                                          <option class="tsttdddt" value=" " <?php $other_postions_decode[1] ==  $other_postions_decode[1] ? ' selected="selected"' : ''; ?>><?php echo  $other_postions_decode[1]; ?>
                                          <?php } ?>
                                          </option>
                                          <?php foreach ($list_positions as $key => $list_positionss) {
                                            $all_pos = $list_positionss->rest_positions; ?>
                                            <option class="tstddvvtt" value="<?php echo $all_pos; ?>"><?php echo $all_pos; ?></option>
                                          <?php } ?>
                                      </select>
                                      <a href="javascript:void(0)" class="remove_players_list" id="remove_players_second">Remove</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="edit_profiel_btn text-center">
                        <div class="modal-footers 5">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <input type="submit" class="theme_btn" name="update_user_profiles" value="Save Changes" autocomplete="on">
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } else { ?>
                  <div class="col-md-12 mb-3">
                    <div class="profiel_details_crds">
                      <?php global $wpdb;
                      if (isset($_POST['update_user_profiles'])) {
                        $main_position = $_POST['main_position'];
                        $other_postions = $_POST['other_postions'];
                        $other_postions2 = $_POST['other_postions2'];
                        $otherposition = array();
                        $otherposition[] = $other_postions;
                        $otherposition[] = $other_postions2;
                        $encode_dta = json_encode($otherposition);
                        $querys = "UPDATE wp_player_details SET main_position='$main_position',  other_postions='$encode_dta' WHERE id='$player_id'  ";
                        $wpdb->query($querys);
                      } ?>
                      <div class="play_positions"><b>Main Position:</b> <?php echo  $get_positions; ?></div>
                      <?php $countsss = 0;
                      foreach ($other_postions_decode as  $other_postions_decodess) {
                        $countsss++; ?>
                        <div class="play_positions rest_postn<?php echo $countsss; ?>">
                          <b>Other Position:</b>
                          <?php echo $other_postions_decodess; ?>
                        </div>
                      <?php } ?>
                      <div class="edit_positions">
                        <a href="javascript:void(0)" id="edit_fields">Edit Positions</a>
                      </div>
                      <div class="my_account_bgs" id="edit_positions">
                        <div class="container">
                          <div class="row">
                            <div class="col-md-12 mb-3">
                              <div class="profiel_details_crds">
                                <h6>Main Position</h6>
                                <div class="edit_profiles">
                                  <img src="https://dualnationals.com/wp-content/themes/Dual-Nationals/assets/img/edit.png" alt="">
                                  <?php $list_positions = $wpdb->get_results("SELECT rest_positions FROM wp_all_positions WHERE rest_positions != '$get_positions' AND rest_positions != '$player_first_position'"); ?>
                                  <select name="main_position" id="rest_positions1">
                                    <option value="<?php echo $get_positions; ?>" <?php $get_positions == $get_positions ? ' selected="selected"' : ''; ?>><?php echo $get_positions; ?></option>
                                    <?php foreach ($list_positions as $key => $list_positionss) {
                                      $all_pos = $list_positionss->rest_positions; ?>
                                      <option value="<?php echo $all_pos; ?>"><?php echo $all_pos; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>

                                <div class="add_positions">
                                  <div class="add_first_positions">
                                    <h6 class="player_positions_2">Position 2</h6>
                                    <div class="edit_profiles player_positions_2">
                                      <img src="https://dualnationals.com/wp-content/themes/Dual-Nationals/assets/img/edit.png" alt="">
                                      <select name="other_postions" id="rest_positions2">
                                        <?php if ($other_postions_decode[0]) { ?>
                                          <option value="<?php echo $other_postions_decode[0]; ?>" <?php $other_postions_decode[0] ==  $other_postions_decode[0] ? ' selected="selected"' : ''; ?>><?php echo  $other_postions_decode[0]; ?>
                                          </option>
                                        <?php } else { ?>
                                          <option value=" " <?php $other_postions_decode[0] ==  $other_postions_decode[0] ? ' selected="selected"' : ''; ?>><?php echo  $other_postions_decode[0]; ?>
                                          </option>
                                        <?php } ?>

                                        <?php foreach ($list_positions as $key => $list_positionss) {
                                          $all_pos = $list_positionss->rest_positions; ?>
                                          <option value="<?php echo $all_pos; ?>"><?php echo $all_pos; ?>
                                          </option>
                                        <?php } ?>
                                      </select>
                                      <a href="javascript:void(0)" class="remove_players_list" id="remove_players2">Remove</a>
                                    </div>
                                  </div>

                                  <div class="add_second_positions">
                                    <h6 class="player_positions_3">Position 3</h6>
                                    <div class="edit_profiles player_positions_3">
                                      <img src="https://dualnationals.com/wp-content/themes/Dual-Nationals/assets/img/edit.png" alt="">
                                      <select name="other_postions2" id="rest_positions3">
                                        <?php if ($other_postions_decode[1]) { ?>
                                          <option value="<?php echo $other_postions_decode[1]; ?>" <?php $other_postions_decode[1] ==  $other_postions_decode[1] ? ' selected="selected"' : ''; ?>><?php echo  $other_postions_decode[1]; ?>
                                          </option>
                                        <?php } else { ?>
                                          <option value=" " <?php $other_postions_decode[1] ==  $other_postions_decode[1] ? ' selected="selected"' : ''; ?>><?php echo  $other_postions_decode[1]; ?>
                                          <?php } ?>
                                          </option>
                                          <?php foreach ($list_positions as $key => $list_positionss) {
                                            $all_pos = $list_positionss->rest_positions; ?>
                                            <option value="<?php echo $all_pos; ?>"><?php echo $all_pos; ?></option>
                                          <?php } ?>
                                      </select>
                                      <a href="javascript:void(0)" class="remove_players_list" id="remove_players_second">Remove</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="edit_profiel_btn text-center">
                        <div class="modal-footers 6">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <input type="submit" class="theme_btn" name="update_user_profiles" value="Save Changes" autocomplete="on">
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>

</div>
</div>
<? php // } 
?>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<?php
fclose($file);
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');
readfile($filename); ?>
<script>
  jQuery('#edit_positions').hide();
  jQuery(function() {
    setTimeout(function() {
      jQuery('.rest_postn1 b').text('Position 2: ');
      jQuery('.rest_postn2 b').text('Position 3: ');
    }, 1000);
    jQuery(".player_age").keypress(function(e) {
      var keyCode = e.keyCode || e.which;
      var regex = /^[A-Za-z]+$/;
      var isValid = regex.test(String.fromCharCode(keyCode));
      if (!isValid) {

      }
      return isValid;
    });
  });
  jQuery('#mobile').keyup(function(e) {
    if (/\D/g.test(this.value)) {
      this.value = this.value.replace(/\D/g, '');
    }
  });
  jQuery("#edit_cls").on("click", function() {
    setTimeout(function() {
      var input = jQuery('#country_code');
      var value = input.val();
      var newValue = value.replace('+1', '');
      input.val(newValue);
    }, 2000);
  });
  jQuery("#edit_fields").on("click", function() {
    jQuery('#edit_positions').show();
  });
  jQuery('#rest_positions2').on('click', function() {
    var main_positions = jQuery('#rest_positions1').val();
    var selectedOption = jQuery(this).val();
    jQuery(jQuery("#rest_positions2 option[value='" + main_positions + "']")).remove();
  });


  jQuery('#rest_positions3').on('click', function() {
    var main_positions = jQuery('#rest_positions2').val();
    var selectedOption = jQuery(this).val();
    jQuery(jQuery("#rest_positions3 option[value='" + main_positions + "']")).remove();
  });

  jQuery('#remove_players').on('click', function() {
    var main_positions = jQuery('#rest_positions2').val(' ');
    jQuery('#rest_positions2').find('option').remove();

  });
  jQuery('#remove_players_second').on('click', function() {
    var main_positions = jQuery('#rest_positions3').val(' ');
    jQuery('#rest_positions3').find('option').remove();
    jQuery('#rest_positions3').remove();
    jQuery(this).hide();
    jQuery('.player_positions_3').hide();
  });

  jQuery('#remove_players2').on('click', function() {
    var main_positions = jQuery('#rest_positions2').val(' ');
    jQuery('#rest_positions2').find('option').remove();
    jQuery('#rest_positions2').remove();
    jQuery(this).hide();
    jQuery('.player_positions_2').hide();
  });


  //jQuery('.add_first_positions').hide();
  //jQuery('.add_second_positions').hide();
  jQuery('#add_frm_player_second').hide();
  jQuery('#add_frm_player').on('click', function() {
    jQuery(this).hide();
    jQuery('.add_first_positions').show();
    jQuery("#rest_positions2 option:first").remove();
    jQuery('#add_frm_player_second').show();

  });

  jQuery('#add_frm_player_second').on('click', function() {
    jQuery(this).hide();
    jQuery('.add_second_positions').show();
    jQuery("#rest_positions3 option:first").remove();

  });
</script>