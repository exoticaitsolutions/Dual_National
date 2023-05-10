<?php
/* Template Name: Contact   Us*/

if ( is_user_logged_in() ) {
   get_header('new');
} else {
   get_header();
} 


?>
<div class="wraper">
    <section class="contact_sec py_8">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="contact_form">
                        <div class="contact_form_head">
                            <h1><?php echo get_field('contact_us_section_title');?></h1>
                            <p><?php echo get_field('contact_us_section_subtitle');?></p>
                        </div>
                        <?php echo do_shortcode('[contact-form-7 id="322" title="Contact Us Form"]');?>
  
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact_ads_list">
                        <ul>
                            <?php
$kkjkkj = get_field('contact_us_section_ads_section');
foreach (get_field('contact_us_section_ads_section') as $key => $contact_us_section_ads_section) {?>

                            <li>
                                <div class="contact_ads_img">
                                    <img src="<?php echo $contact_us_section_ads_section['url'];?>"
                                        alt="<?php echo $contact_us_section_ads_section['title'];?>">
                                </div>
                            </li>
                            <?php  } ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    jQuery("select.wpcf7-form-control.wpcf7-select").change(function() {
            var valsss= jQuery('select.wpcf7-form-control.wpcf7-select option:first-child').val();
    console.log(valsss);
    if(valsss=='Language preference'){
        jQuery('select.wpcf7-form-control.wpcf7-select option:first-child').css('display' , 'none')
    }
});
    </script>
<?php get_footer();?>