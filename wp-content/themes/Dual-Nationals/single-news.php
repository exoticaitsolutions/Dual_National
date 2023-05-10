<?php /* Template Name: Single News */ 
get_header();
$id = $_GET['id'];;

$single_news =  $wpdb->get_row("SELECT * FROM `wp_all_news_posts` Where id= '2023050123072533566'");
//foreach ($single_news as $key => $news) {
	$caption = $single_news->caption;
	$published = $single_news->published;
	$title = $single_news->title;
	$image = $single_news->image;
	
	?>
	<div class="col-md-12">
                <div class="news_feeds_cntnt_bx">
                    <div class="news_feeds_cntnts container">
                        <div class="news_feeds_head">
                            <h2>News Feed</h2>
                        </div>

                        
                                                       
                              
                                    <div class="news_feeds_img">
                                       <img src="<?php  echo $image;?>">
                                    </div>
                                    <div class="news_feeds_txt">
                                        
                                            <p><?php echo $published;?></p>
                                        <h6><?php echo $caption;?></h6>
                                        <p><?php echo $title;?></p>
                                    </div>
                               
                            
                       
                    </div>
                </div>
            </div>
	<?php// } ?>

 <?php get_footer();?>