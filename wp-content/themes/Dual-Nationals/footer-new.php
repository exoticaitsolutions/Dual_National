<footer class="main_footer">
      <div class="container">
        <div class="footer_flex">
          <div class="footer_logo">
            <a href="<?php echo  get_field('footer_logo_link','option');?>"><img src="<?php echo  get_field('footer_logo','option');?>" alt=""></a>
          </div>
          <div class="footer_nav_lft">
		  <?php
		wp_nav_menu(
			array(
				'theme_location'  => 'seconday_footer_left',
				'menu_class'      => 'menu-wrapper',
				'container_class' => 'primary-menu-container',
				'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
				'fallback_cb'     => false,
			)
		);
		?>
          </div>
          <div class="footer_nav_lft">
		  <?php
		wp_nav_menu(
			array(
				'theme_location'  => 'seconday_footer_right',
				'menu_class'      => 'menu-wrapper',
				'container_class' => 'primary-menu-container',
				'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
				'fallback_cb'     => false,
			)
		);
		?>
          </div>
        </div>
      </div>
      <div class="copy_right">
        <div class="container">
          <div class="copy_right_cntnt">
            <p><?php echo  get_field('copyright','option');?></p>
			<?php
wp_nav_menu(
    array(
        'theme_location'  => 'footer_bootom',
        'menu_class'      => 'le_gal',
        'container_class' => 'primary-menu-container',
        'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
        'fallback_cb'     => false,
    )
);
?>

          </div>
        </div>
      </div>
    </footer>
   
<?php wp_footer();?>
    <!-- jquery -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.min.js"></script>
    <!-- Bootstrap Bundle (includes Popper) -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/bootstrap.bundle.min.js"></script>
    <!--slick js -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/slick.min.js"></script>
    <!-- main.js -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/main.js?<?php echo date('Y-m-d H:i:s');?>">></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/call_function.js?<?php echo date('Y-m-d H:i:s');?>"></script>
    <script src="<?php echo et_stylesheet_directory_uri(); ?>/assets/js/toastr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <!--fnon.min.js -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/fnon.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/3.0.0/jquery.payment.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jQuery/bootstrap-toaster.js"></script>

        <!-- Vaildation -->
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jQuery/jquery.validate.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jQuery/additional-methods.min.js"></script>

    <script>
        /*********************Auto Search Jquery Start************************ */
  jQuery(document).ready(function () {

jQuery('button.swal-button.swal-button--confirm.swal-button--danger').text('Logout');
  // Capture Enter key press event on input element
  jQuery('#search_con').on('keydown', function(event) {
    if (event.which == 13) { // Check for Enter key (key code 13)
      event.preventDefault(); // Prevent form submission
      jQuery('#players_country').click();
    }
  });
});
jQuery(document).on("click",".dupliate_players li",function() {
                            var selectedValue = jQuery(this).text(); // Get the text of clicked li
                            console.log(selectedValue);
                            jQuery('#Search_playres').val(selectedValue); // Set the value of input field
                            //jQuery('div#autoserach').hide();
                        });
                        jQuery(document).on("click",".dupliate_values li",function() {
                            var selectedValue = jQuery(this).text(); // Get the text of clicked li
                            console.log(selectedValue);
                            jQuery('#search_con').val(selectedValue); // Set the value of input field
                           // jQuery('div#autoserach').hide();
                        });
                jQuery('#Search_playres').on('keypress', function(event) {
                  jQuery('div#autoserach').show();
            jQuery('#autoserach_play').addClass('players_search');

            var inputValue = $(this).val();
            jQuery.ajax({
                type: 'GET',
                url    : my_ajax_object.ajax_url,
                processData: true,
                data: {"action": "filter_texonomy",inputValue:inputValue },
                success: function(response) {
                    jQuery("#autoserach_play").html(response);
                 //   return false;
                }
            });
            
        });
        
        jQuery('#search_con').on('keypress', function(event) {
         // jQuery('div#autoserach').show();
            jQuery('#autoserach').addClass('countries_search');
          //  if (event.which === 8 || event.key === "Backspace") {
          
                    var inputcountry = $(this).val();
                    jQuery.ajax({
                        type: 'GET',
                        url    : my_ajax_objects.ajax_urls,
                        //processData: true,
                        data: {"action": "filter_texonomys",inputcountry:inputcountry },
                        success: function(response) {
                            jQuery("#autoserach").html(response);
                           // return false;
                           }
                           });
                        // }
                        
                         });
                         jQuery("#Search_playres").click(function(){
                            jQuery('#search_con').val('');
                        });
                   
                    jQuery(document).ready(function($) {
                        jQuery(document).on("click",".dupliate_values li",function() {
                            var selectedValue = jQuery(this).text(); // Get the text of clicked li
                            console.log(selectedValue);
                            jQuery('#search_con').val(selectedValue); // Set the value of input field
                            jQuery('div#autoserach').hide();
                        });

  $('#remove-coupon').click(function(e) {
    e.preventDefault(); // prevent the default action of the button

    // Send an AJAX request to remove the coupon code
    jQuery(document).ready(function($) {
    $('body').on('click', '.ajaxTrigger', function(){
        $.ajax({
            type: 'POST'
            ,dataType: 'json'
            ,url: ajax_object.ajax_url
            ,data: {
                'action': 'my_action',
                'whatever': ajax_object.we_value
            }
            ,success: function(response) {
                alert(response);
            }
        });
    });
});
  });
});
  /*********************Auto Search Jquery End************************ */
       setTimeout(function () {
        jQuery('button.swal-button.swal-button--confirm.swal-button--danger').text('Logout');     
       
      },
      200);
     jQuery("#logouts").click(function(event) {
  event.preventDefault();
  new swal({
    title: "Are you sure you really want to logout?",
    buttons: true,
    dangerMode: true,
    confirmButtonText: "Logout" // set the confirm button text to "Logout"
  }).then((willDelete) => {
    if (willDelete) {
      window.location.href = '<?php echo wp_logout_url(); ?>';
    }
  });
});

    </script>
   
<script
  type="text/javascript"
  src="https://app.termly.io/embed.min.js"
  data-auto-block="on"
  data-website-uuid="4527c360-c824-4f1c-b6d9-46e097eab909"
></script>
</body>

</html>