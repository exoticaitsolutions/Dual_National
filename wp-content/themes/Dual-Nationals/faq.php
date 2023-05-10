<?php
/* Template Name: FAQ Page */ 
get_header( );
?>

</header>
<div class="wraper">
    <section class="inner_banner inner_banner_drk">
        <div class="container">
            <div class="inner_bnner_txt text-center">
                <h1><?php echo get_field('faq_section_title_');?></h1>
            </div>
        </div>
    </section>
    <section class="faq_sec py_8">
        <div class="container">
            <div class="row">
                
<?php foreach (get_field('faq_queries') as $key => $faq_queries){?>
                <div class="accordion accordion-flush" id="accordionFlushExample<?php echo $key;?>">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading<?php echo $key;?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse<?php echo $key;?>" aria-expanded="false"
                                aria-controls="flush-collapse<?php echo $key;?>">
                                <?php echo $faq_queries['faq_queries_question'];?>
                            </button>
                        </h2>
                        <div id="flush-collapse<?php echo $key;?>" class="accordion-collapse collapse"
                            aria-labelledby="flush-heading<?php echo $key;?>" data-bs-parent="#accordionFlushExample<?php echo $key;?>">
                            <div class="accordion-body">  <?php echo $faq_queries['faq_queries_answer'];?></div>
                        </div>
                    </div>
                </div>
                <?php
}
?>
            </div>
        </div>
</div>
</section>
</div>
<?php get_footer( );?>