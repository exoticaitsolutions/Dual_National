<?php if( !is_page( array( 'how-it-works' ) )){ ?>
   
 
<footer class="main_footer">
    <div class="container">
        <div class="footer_flex">
            <div class="footer_logo">
                <a href="<?php echo  get_field('footer_logo_link','option');?>"><img
                        src="<?php echo  get_field('footer_logo','option');?>" alt=""></a>
            </div>
            <div class="footer_nav_lft">
                <?php
        wp_nav_menu(
            array(
                'theme_location'  => 'primary_footer_leftmenu',
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
                'theme_location'  => 'footer_right',
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



<!-- jquery -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.min.js"></script>
<!-- Bootstrap Bundle (includes Popper) -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/bootstrap.bundle.min.js"></script>
<!--slick js -->
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/slick.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/dataTables.bootstrap5.min.js"></script>


<!-- main.js -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/main.js?<?php echo date('Y-m-d H:i:s');?>">"></script>
<!--  Call Function  -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/call_function.js?<?php echo date('Y-m-d H:i:s');?>"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jQuery/jquery.validate.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jQuery/additional-methods.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--fnon.min.js -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/fnon.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/other_js_files/intlTelInput-jquery.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>

<script>
  
jQuery(document).ready(function() {
    jQuery("#Search_playres").attr("autocomplete", "off");

    jQuery('button.swal-button.swal-button--confirm.swal-button--danger').text('Logout');
    jQuery(".have-coupon-link").click(function() {
        setTimeout(function() {

            var coupan = jQuery('.pay_mnth_txt h1').text();
            console.log(coupan);
            jQuery('.coupan_cls').text(coupan);
        }, 3000);

        jQuery('.have-coupon-link').hide();
        jQuery('.mepr_coupon ').show();


    });
   /* $(document).on("input", ".wpcf7-form-control", function() {
        this.value = this.value.replace(/\D/g, '');
    });*/
    jQuery(".srch_input input").keypress(function(e) {
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            e.preventDefault();
        }
    });
    setTimeout(function() {

        jQuery('.mp-form-row .mepr_payment_method').addClass('col-md-6');
        jQuery('.mp-form-row.mepr_payment_method-wrapper').addClass('row');

    }, 300);


    setTimeout(function() {
        jQuery('.mp-form-row .mepr_payment_method').css('display', 'block', '!important');

    }, 600);

    var state_optn = jQuery('#state option').text();
    if (state_optn == 'No states of this Country') {
        jQuery('#state').css("display", "none", "!important");
        jQuery('#append_states').append("<p>No states of this Country</p>");
        jQuery("#mepr-address-state1").prop("readonly", true);

    }
    setTimeout(function() {

        var state_optnsss = jQuery('#state option:nth-child(2)').text();

        if (state_optnsss == 'No State in this country') {
            console.log(state_optn);
            jQuery('#state').css("display", "none", "!important");
            jQuery('#append_states').append("<p>No states of this Country</p>");
            jQuery("#mepr-address-state1").prop("readonly", true);


        }
    }, 100);

    jQuery("#mepr-address-country1").click(function() {
        var option_val = jQuery('select#mepr-address-state1 option:nth-child(2)').val();
        console.log(option_val, 'h');
        if (option_val == 'No states of this Country') {
            setTimeout(function() {
                console.log(option_val);
                jQuery('#mepr-address-state1').css("display", "none", "!important");
                jQuery('#mepr-address-state1').val('No states of this Country');
                jQuery('input#mepr-address-state1').css("display", "block", "!important");
                jQuery('input#mepr-address-state1').val('No states of this Country');
                jQuery("input#mepr-address-state1").attr("placeholder",
                    "No states of this Country");
                jQuery("input#mepr-address-state1").prop("readonly", true);

            }, 500);

        }
    });
    jQuery('#mepr-address-zip1').keyup(function() {
        this.value = this.value.replace(/[^1-9\.]/g, '');
    });
    jQuery('#mepr_user_password1').keyup(function() {
        jQuery('.mp-form-row.mp-password-strength-area').css("display", "none", "!important");
    });

    jQuery("#mepr-address-state1").click(function() {
        var option_val = jQuery('select#mepr-address-state1 option:nth-child(2)').val();
        if (option_val == 'No States in this Country') {
            setTimeout(function() {

                jQuery('#mepr-address-state1').css("display", "none", "!important");
                jQuery('#mepr-address-state1').val();
                jQuery('input#mepr-address-state1').css("display", "block", "!important");
            }, 2500);

        }
    });

    var seclected_id = jQuery('#selected_countries').val();
    console.log(seclected_id);
    jQuery('#country option:nth-child(1)').text(seclected_id);
    setTimeout(function() {

        jQuery('#append_states').append($('#state')); // append -> object
    }, 600);



    jQuery("#mepr_user_password1").keyup(function() {
        jQuery(".invalid").append('<i class="fa fa-times" aria-hidden="true"></i>');
    });
    //setTimeout(function () {
        jQuery('.mepr-states-dropdow').click(function() {

        setTimeout(function() {

            var $select = jQuery(".mepr-states-dropdown");

            $select.append($select.find("option").remove()
                .sort(function(a, b) {
                    var at = $(a).text(),
                        bt = $(b).text();
                    return (at > bt) ? 1 : ((at < bt) ? -1 : 0);
                }));
        }, 2500);
    });
    //       var email_exit = jQuery('.mepr_pro_error ul li').text();
    // console.log(email_exit);
    // if(email_exit == 'This email address has already been used. If you are an existing user, please Login to complete your purchase. You will be redirected back here to complete your sign-up afterwards.'){
    //     swal("This email address has already been used. If you are an existing user, please Login to complete your purchase. You will be redirected back here to complete your sign-up afterwards.", {
    //                                     icon: "warning",

    //                                 });

    // }
    jQuery('#user_first_name1').on('keypress', function(event) {
        var keyCode = event.which || event.keyCode;
        if (keyCode >= 48 && keyCode <= 57) { // 0-9
            event.preventDefault();
        }
    });

    jQuery('#user_last_name1').on('keypress', function(event) {
        var keyCode = event.which || event.keyCode;
        if (keyCode >= 48 && keyCode <= 57) { // 0-9
            event.preventDefault();
        }
    });

    jQuery('.mepr-states-text').on('keypress', function(event) {
        var keyCode = event.which || event.keyCode;
        if (keyCode >= 48 && keyCode <= 57) { // 0-9
            event.preventDefault();
        }
    });
    // $('#mepr-address-two1').on('keypress', function(event) {
    //   var keyCode = event.which || event.keyCode;
    //   if (keyCode >= 48 && keyCode <= 57) { // 0-9
    //     event.preventDefault();
    //   }
    // });
    jQuery('#mepr-address-city1').on('keypress', function(event) {
        var keyCode = event.which || event.keyCode;
        if (keyCode >= 48 && keyCode <= 57) { // 0-9
            event.preventDefault();
        }
    });

    jQuery('.max_state').on('keypress', function(event) {
        var keyCode = event.which || event.keyCode;
        if (keyCode >= 48 && keyCode <= 57) { // 0-9
            event.preventDefault();
        }
    });

    jQuery(".login_show_pwd").click(function(event) {
        if ($('#user_pass').attr('type') == 'text') {
            $('#user_pass').attr('type', 'password');
        } else {
            $('#user_pass').attr('type', 'text');
        }
    });
    jQuery('.iti__country-list li').on('click', function() {
        setTimeout(function() {
            jQuery('#mepr_phone_number1').attr("placeholder", "81234 56783");
        }, 100);
    });

    var tittle_heading = jQuery('.tittle_heading h2').text();
    if (tittle_heading == 'Free Membership') {
        console.log(tittle_heading);

        jQuery('.monthly_accsess p').text('0.00');

        jQuery('.pay_mnth_txt h1').text('0.00');
    }

    $('.login_show_pwd').click(function() {
        if ('password' == $('#user_pass').attr('type')) {
            $('#user_pass').prop('type', 'text');
        } else {
            $('#user_pass').prop('type', 'password');
        }
    });
    $('.show_pwds').click(function() {
        if ('password' == $('#mepr_user_password1').attr('type')) {
            $('#mepr_user_password1').prop('type', 'text');
        } else {
            $('#mepr_user_password1').prop('type', 'password');
        }
    });
    $('.show_confrim_pwd').click(function() {
        if ($('.mepr-password-confirm').attr('type') == 'text') {
            $('.mepr-password-confirm').attr('type', 'password');
        } else {
            $('.mepr-password-confirm').attr('type', 'text');
        }
    });
    jQuery('#watch_list_data_paginate ul li a').click(function() {
        setTimeout(function () {
        jQuery('#watch_list_data_previous a').html(
            '<img id="left_img" src=<?php echo get_stylesheet_directory_uri(); ?>/assets/img/left_arrow.png" />'
            );
        jQuery('li#watch_list_data_next a').html(
            '<img id="left_img" src=<?php echo get_stylesheet_directory_uri(); ?>/assets/img/right_arrow.png" />'
            );
          }, 50);
    });

    

    jQuery('#watch_list_data_previous a').html(
        '<img id="left_img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/left_arrow.png" />'
        )
    jQuery('#watch_list_data_next a').html(
        '<img id="right_img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/right_arrow.png" />'
        );
    $('#mepr_phone_number1').bind('keyup paste', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    document.getElementById('mepr_phone_number1').setAttribute('maxlength', 10);
    document.getElementById('mepr-address-zip1').setAttribute('maxlength', 7);

    document.getElementById('mepr_phone_number1').setAttribute('minlength', 10);

    $("#watch_list_data_length").insertAfter("#watch_list_data_info");

    var numItems = $('#watch_list_data .my_acc_tr').length;
    //alert(numItems);
    if (numItems >= 20) {
        jQuery('#watch_list_data_length').text('<p>watch_list_data_length</p>');
        // swal("You Can Add 20 Players in wishlist", {
        //    icon: "success",
        //    });
    }
    // jQuery('.dataTables_length').text('');

    $("#players_serach").click(function() {
      //  var query = $("input[name='s']").val('');
    });
    $("#players_country").click(function() {
        var query = $("input[name='players']").val('');
    });
});
jQuery('#rememberme').click(function() {
    if (jQuery('#rememberme').is(':checked')) {
        localStorage.usrname = jQuery('#user_login').val();
        localStorage.pass = jQuery('#user_pass').val();
        localStorage.chkbx = jQuery('#rememberme').val();
    } else {
        localStorage.chkbx = '';
    }
});
if (localStorage.chkbx && localStorage.chkbx != '') {
    jQuery('#rememberme').attr('checked', 'checked');
    jQuery('#user_login').val(localStorage.usrname);
    jQuery('#user_pass').val(localStorage.pass);
}
</script>
<script>
jQuery(document).ready(function () {

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


jQuery('.show_pwds').click(function() {
    if ('password' == jQuery('#mepr_user_password1').attr('type')) {
        jQuery('#mepr_user_password1').prop('type', 'text');
    } else {
        jQuery('#mepr_user_password1').prop('type', 'password');
    }
});
jQuery('.show_confrim_pwd').click(function() {
    if (jQuery('.mepr-password-confirm').attr('type') == 'text') {
        jQuery('.mepr-password-confirm').attr('type', 'password');
    } else {
        jQuery('.mepr-password-confirm').attr('type', 'text');
    }
});

});
</script>
<script>
 //           jQuery(document).ready(function() {
 //        //    alert("a");
 //      jQuery("#players_serach").click(function(event) {
 //         event.preventDefault();
 //         //alert("aaaaa");
 //         var search = $("#players_found").val();
 //         if(search !== ''){
 //         jQuery.getJSON("<?php  echo get_stylesheet_directory_uri();?>/player_updates.json", function(data) {
 //            var items = data;
 //            console.log(data);
 //            var results = $.grep(items, function(item) {
 //               return item.name.toLowerCase().indexOf(search.toLowerCase()) >= 0;
 //            });
 //            console.log(data);
 //            displayResults(results);
 //         });
 //     }
 //      });
 //      jQuery('#players_found').keypress(function (e){

 //      // jQuery("#players_serach").click(function(event) {
 //        // event.preventDefault();
 //           if(e.keyCode == 13){
 // event.preventDefault();
 //         //alert("aaaaa");
 //         var search = $("#players_found").val();
 //         if(search !== ''){
 //         jQuery.getJSON("<?php  echo get_stylesheet_directory_uri();?>/player_updates.json", function(data) {
 //            var items = data;
 //            console.log(data);
 //            var results = $.grep(items, function(item) {
 //               return item.name.toLowerCase().indexOf(search.toLowerCase()) >= 0;
 //            });
 //            console.log(data);
 //            displayResults(results);
 //         });
 //     }
 // }
 //      });

 //   });

 //   function displayResults(results) {
 //    console.log(results.length);
 //    if (results.length > 0) {
 //        console.log('add');
 //        jQuery('.players_searchlist').addClass('find_result');
 //        var html = "";
 //      for (var i = 0; i < results.length; i++) {
 //         html += "<div class='player_search_lst'>";
 //         html += "<div class='player_search_img'>";
 //         html += "<img src="+ results[i].headshot +">";
 //         html += "</div>";
 //         html += "<div class='player_search_txt'>";
 //         html += "<h2>Name: " + results[i].name + "</h2>";
 //         html += "<p>Citizenship: " + results[i].citizenship + "</p>";
 //         html += "<p>Place of Birth :" + results[i].place_of_birth + "</p>";
 //          html += "</div>";

 //         html += "</div>";
 //      }
  
 //      $("#results").html(html);
 //    }
 //    else{
 //        jQuery('#results').append('Result Not Found');
 //        //console.log('Not Found');
 //    }
      
 //  }
   

    </script>

<?php wp_footer();?>
</body>

</html>
<script
  type="text/javascript"
  src="https://app.termly.io/embed.min.js"
  data-auto-block="on"
  data-website-uuid="4527c360-c824-4f1c-b6d9-46e097eab909"
></script>
<?php } ?>  