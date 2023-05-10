<?php /* Template Name: All News */ 
get_header();
$id = $_GET['id'];

 ?>
 
<div class="news_feeds_cntnt_bx">
    <div class="news_feeds_cntnt all_news_feed">
        <div class="news_feeds_head">
                            <h2 style="text-align: center;">News Feed</h2>
                        </div>
        <ul class="news_feeds_list row">
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
                     // echo '<pre>';
                     // print_r($new_decodes);
                      $new_decode = $new_decodes['data'];
            foreach ($new_decode as $key => $news) { 
            // echo '<pre>';
            // print_r($news);
                $caption = $news['caption'];
                $url = $news['url'];
                $title = $news['title'];
               $publisedd = $news['published'];  
               $datetime1 = new DateTime($publisedd);
               $datetime2 = new DateTime(); // current time
               $interval = $datetime1->diff($datetime2);
                $thumbnail_2 = $news['thumbnail_2']; ?>
                <li class="col-md-6">
                    <a target="_blank" href="<?php echo $url;?>" class="news_feeds_crd">
                <div class="news_feeds_img">
                    <img src="<?php echo $thumbnail_2;?>">
                </div>
                <div class="news_feeds_txt">
                    <!-- <p><?php //echo $published; ?></p> -->
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
                    }
                    ?></p>
                </div>
            </a>
                </li>
                <?php } } ?>
            </ul>
        </div>
    </div>



 <?php get_footer();?>