
<style>
    
     .profile-left{
          /* width: 50%; */
          float: left;
              display: flex;
    justify-content: left;
    align-items: center;
    gap: 15px;
     }
     .profile-right{
          width: 48%;
          float: left;
     }
     .profile-wrap{
          display: flex;
    align-items: center;
    background: #2d2e31;
    color: #fff;
     }
     .profile-left .profile-img img{
          width: 100%;
    max-width: 75px;
     }
     .profile-content h2{
          margin: 0;
    font-weight: 800;
    font-size: 22px;
     }
     .profile-content p{
          margin: 0;
          margin-top: 6px;
     }
     .profile-right p{
          margin: 0px;
          margin-top: 7px;
     }
     .clear:after, .clear:before{
          content: "";
display: block;
clear: both;
     }
     .profile-row{
          background: #2d2e31;
          padding: 30px 20px;
     }
     .view-stats-btn{
          text-align: center;
     }
     .view-stats-btn a{
          text-decoration: none;
    text-align: center;
    display: inline-block;
    background: red;
    padding: 15px 35px;
    margin: 25px 0px;
    color: #fff;
    font-weight: 500;
    font-size: 18px;
    margin-bottom: 0;
     }
    </style>

     <div class="container">
        <div class="row gx-5">
     <?php 
     $countries_name = $_GET['inputcountry'];
    $args = array(
        'post_type' => 'player',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'player_country',
                'value' => $countries_name,
                'compare' => 'LIKE'
            )
        )
    );
    
    $results_coun = get_posts( $args );
  
foreach($results_coun as $key => $value){ 
    
    $country_Data = get_field('player_country',$value->ID);
   
    ?>
          <div class="profile-row col-lg-5 col-md-5 col-sm-12 m-2">
               <div class="profile-wrap clear">
                    <div class="profile-left">
                         <div class="profile-img">
                              <img src="matt.png" alt="">
                         </div>
                         <div class="profile-content">
                              <h2><?php echo $value->post_title; ?></h2>
                              <p>Age:26</p>
                              <p>Country: <?php  if(is_array($country_Data)){
        echo implode(",",  $country_Data);
    }else {
        echo $country_Data;
    } ?></p>
                         </div>
                    </div>
                    
               </div>
               <div class="view-stats-btn">
                    <a href="<?php echo get_permalink($value->ID); ?>">View More stats</a>
               </div>
          </div>
          <?php  } ?>
          </div>
    </div>



