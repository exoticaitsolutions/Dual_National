jQuery(document).ready(function () {
  setTimeout(function () {
    jQuery("#loader").hide();
  }, 1500);
  // alert('call  from main.js assets file ');
  // home_slider s
  jQuery(".selected a").click(function () {
    var englishs = jQuery(".selected a").text();
    if (englishs == " English") {
      jQuery(".option a:nth-child(5)").css("display", "none", "!important");
    } else {
      jQuery(".option a:nth-child(5)").css("display", "block", "!important");
    }
    var Afrikaans = jQuery(".selected a").text();
    if (Afrikaans == " Afrikaans") {
      jQuery(".option a:nth-child(1)").css("display", "none", "!important");
    } else {
      jQuery(".option a:nth-child(1)").css("display", "block", "!important");
    }

    var zn_ch = jQuery(".selected a").text();
    if (zn_ch == " 简体中文") {
      console.log("dsd");
      jQuery(".option a:nth-child(3)").css("display", "none", "!important");
    } else {
      jQuery(".option a:nth-child(3)").css("display", "block", "!important");
    }

    var arabic = jQuery(".selected a").text();
    if (arabic == " العربية") {
      jQuery(".option a:nth-child(2)").css("display", "none", "!important");
    } else {
      jQuery(".option a:nth-child(2)").css("display", "block", "!important");
    }

    var zh_tw = jQuery(".selected a").text();
    if (zh_tw == " 简体中文") {
      jQuery(".option a:nth-child(4)").css("display", "none", "!important");
    } else {
      jQuery(".option a:nth-child(4)").css("display", "block", "!important");
    }

    var franc = jQuery(".selected a").text();
    if (franc == " Français") {
      jQuery(".option a:nth-child(6)").css("display", "none", "!important");
    } else {
      jQuery(".option a:nth-child(6)").css("display", "block", "!important");
    }

    var dest = jQuery(".selected a").text();
    if (dest == " Deutsch") {
      jQuery(".option a:nth-child(7)").css("display", "none", "!important");
    } else {
      jQuery(".option a:nth-child(7)").css("display", "block", "!important");
    }

    var en_jss = jQuery(".selected a").text();
    if (en_jss == " 日本語") {
      jQuery(".option a:nth-child(8)").css("display", "none", "!important");
    } else {
      jQuery(".option a:nth-child(8)").css("display", "block", "!important");
    }

    var ports = jQuery(".selected a").text();
    if (ports == " Português") {
      jQuery(".option a:nth-child(9)").css("display", "none", "!important");
    } else {
      jQuery(".option a:nth-child(9)").css("display", "block", "!important");
    }

    var es_pppsss = jQuery(".selected a").text();
    if (es_pppsss == " Español") {
      jQuery(".option a:nth-child(10)").css("display", "none", "!important");
    } else {
      jQuery(".option a:nth-child(10)").css("display", "block", "!important");
    }
  });
  jQuery("#mobiles").intlTelInput({
    initialCountry: jQuery("#country_code_name").val(),
    separateDialCode: true,
  });
  var text = document.querySelector("body");
  text.classList.add("dark-mode");

  jQuery(".home_slider").slick({
    dots: false,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 7000,
    dots: true,
    prevArrow:
      "<img class='slick-prev' src='https://dualnationals.com/wp-content/uploads/2023/05/left-ar.png'>",
    nextArrow:
      "<img class='slick-next' src='https://dualnationals.com/wp-content/uploads/2023/05/right-ar.png'>",
  });

  // testi_monial_slider_slider Sidebar
  jQuery(".testi_monial_slider_slider").slick({
    dots: false,
    arrows: true,
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    speed: 300,
    prevArrow: jQuery(".slide_controls .slide-prev"),
    nextArrow: jQuery(".slide_controls .slide-next"),
  });

  // jQuery('#watch_list_data').DataTable({
  //   "bPaginate": jQuery('#watch_list_data  tbody tr').length > 10,
  //   rowReorder: true,
  //   lengthMenu: [10, 20],
  //   "language": {
  //     "paginate": {
  //       "previous": '<img id="left_img" src="https://dualnationalsstagiing.exoticaitsolutions.com/wp-content/uploads/2023/03/left_arrow.png" />',
  //       "next": '<img id="right_img" src="https://dualnationalsstagiing.exoticaitsolutions.com/wp-content/uploads/2023/03/right_arrow.png" />',
  //     }
  //   },
  //   columnDefs: [
  //     { orderable: true, className: 'reorder', targets: 0 },
  //     { orderable: true, className: 'reorder', targets: 2 },
  //     { orderable: true, className: 'reorder', targets: 4 },
  //     { orderable: false, targets: '_all' }
  //   ]
  // });

  jQuery(".package_lists ul ").addClass("package_list");

  jQuery("input").attr("autocomplete", "on");

  //Wishlist  Add  and Remove Functionlty FDunctionaly
  jQuery(document).on("click", "#save_favrt", function () {
    jQuery.ajax({
      type: "POST",
      dataType: "json",
      timeout: 16000,
      url: jQuery("#admin_url").val(),
      data: {
        action: "Save_wish_list_data",
        player_id: jQuery("#player_id").val(),
        current_user_id: jQuery("#current_user_id").val(),
        wishlist_exit: jQuery(this).attr("wishlist_exit"),
        wishlist_id: jQuery(this).attr("wishlist_id"),
      },
      beforeSend: function () {
        jQuery("#cover-spin").css("display", "block");
      },
      success: function (response) {
        jQuery("#cover-spin").css("display", "none");
        if (
          response.status == "401" ||
          response.status == 401 ||
          response.status == "403" ||
          response.status == 403
        ) {
          // Login Functionlaty
          new swal({
            className: "theme_btn",
            title: "",
            text: response.message,
            icon: "warning",
          }).then(function () {
            location.reload();
          });
        } else if (
          response.status == "201" ||
          response.status == 201 ||
          response.status == "204" ||
          response.status == 204
        ) {
          new swal({
            className: "theme_btn",
            title: "",
            text: response.message,
            // icon: "success",
          }).then(function () {
            location.reload();
          });
        } else {
          // swal("", response.message, "warning","theme_btn");
          swal({
            className: "theme_btn",
            title: "",
            text: response.message,
            icon: "warning",
          });
        }
      },
      error: function (error) {},
    });
  });

  // var imge =   jQuery('#country_code').val(`+jQuery{jQuery(this).attr('data-dial-code')}`);

  jQuery("#mobile").intlTelInput({
    initialCountry: jQuery("#country_code_name").val(),
    separateDialCode: true,
  });

  //  Selected_option_jsuqery _cdn

  jQuery(".iti__country-list li").on("click change", function () {
    jQuery("#country_code").val(`+${jQuery(this).attr("data-dial-code")}`);

    jQuery("#country_code_name").val(jQuery(this).attr("data-country-code"));
  });
  jQuery(".iti__country-list li").on("click change", function () {
    jQuery("#country_codes").val(`+${jQuery(this).attr("data-dial-code")}`);

    jQuery("#country_code_names").val(jQuery(this).attr("data-country-code"));
  });
  //
  //   // jQuery('#country_code').val('+' + number);
  //
  // });
  // On the edit page, there are multiple functionalities.

  // if (window.location.pathname.indexOf("/edit-profile/") > -1) {
  jQuery("#country_code").val(jQuery(".iti__selected-dial-code").text());
  jQuery("#iti-0__country-listbox li").each(function (i) {
    if (jQuery(this).attr("aria-selected") == "true") {
      jQuery("#country_code_name").val(jQuery(this).attr("data-country-code"));
      return false;
    }
  });

  populate_state_contries_on_edit_page({
    action: "country_state_fucntionlty_on_edit_page",
    country_name: jQuery(this).val(),
    selected_state: jQuery("#state_name_list").val(),
    country_id: jQuery("option:selected", this).attr("id"),
    iso: jQuery("option:selected", this).attr("iso2"),
  });
  jQuery(document).on("change", "#country", function () {
    console.log("sakdjksadjksjkajkasdjk");
    populate_state_contries_on_edit_page({
      action: "country_state_fucntionlty_on_edit_page",
      country_name: jQuery(this).val(),
      selected_state: "",
      country_id: jQuery("option:selected", this).attr("id"),
      iso: jQuery("option:selected", this).attr("iso2"),
    });
  });

  // }
  // Form Submit

  jQuery("#contactForm1s").validate({
    rules: {
      first_name: {
        required: true,
        minlength: 1,
        maxlength: 50,
      },
      mepr_phone_number: {
        required: true,
        number: true,
        minlength: 10,
        maxlength: 11,
      },
      mepr_address_one: {
        required: true,
        minlength: 2,
        maxlength: 250,
      },
      mepr_address_city: {
        required: true,
        minlength: 2,
        maxlength: 30,
      },
      mepr_address_zip: {
        required: true,
        minlength: 2,
        maxlength: 7,
      },
      mepr_address_state: {
        required: true,
      },
    },
    // in 'messages' user have to specify message as per rules
    messages: {},
    //     submitHandler: function(form) {
    //       swal({
    //         title: "Do you want to save changes?",
    //         buttons: true,
    //         dangerMode: true,
    //     }).then((willDelete) => {
    //         if (willDelete) {
    //           var formdata = new FormData( jQuery("#contactForm1s")[0] );
    //                formdata.append('action', 'dcsAjaxCallFormSubmit');
    //                            jQuery.ajax({
    //               url: jQuery('#admin_url').val(),
    //               type: 'POST',
    //               processData: false,
    //               contentType: false,
    //               timeout: 16000,
    //               data: formdata,
    //               beforeSend: function () { jQuery("#cover-spin").css("display", "block") },
    //               success: function(response) {
    //                 jQuery("#cover-spin").css("display", "none");
    //                 if(response.status =='201' || response.status ==201){
    //                   console.log(response);
    //                   window.location.href = response.redirct_url;
    //                 }

    //               }
    //                   });
    //         }
    //     });

    //     }
  });

  // jQuery(document).on("keypress", "#search", function(event) {
  jQuery(document).on("keypress", "#search, #players", function (event) {
    var regex = new RegExp("^[a-zA-Z ]+jQuery");
    var key = String.fromCharCode(
      !event.charCode ? event.which : event.charCode
    );
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
    }
  });

  // User Login
  if (window.location.pathname.indexOf("/user-login/") > -1) {
    jQuery("#mepr_loginform").validate({
      rules: {
        log: {
          required: true,
          email: true,
        },
        pwd: {
          required: true,
        },
      },
      // in 'messages' user have to specify message as per rules
      messages: {
        log: {
          required: "Please enter your email",
          email: "Please enter a valid email address",
        },
        pwd: {
          required: "Please enter your Passwords",
        },
      },
      submitHandler: function (form) {
        var loginformdata = new FormData(jQuery("#mepr_loginform")[0]);
        loginformdata.append("action", "Login_fucntionalty");
        jQuery.ajax({
          url: jQuery("#admin_url_edit_page").val(),
          type: "POST",
          processData: false,
          contentType: false,
          timeout: 16000,
          data: loginformdata,
          // beforeSend: function () { jQuery("#cover-spin").css("display", "block") },
          success: function (response) {
            console.log("asdsadsa");
            if (response.status == 403 || response.status == "403") {
              setTimeout(function () {
                jQuery("#email-error").html(response.message);
              }, 1000);
              jQuery("#password-error").html();
            } else if (response.status == 401 || response.status == "401") {
              jQuery("#email-error").html("");
              // jQuery('#password-error').html(response.message);
              setTimeout(function () {
                jQuery("#password-error").html(response.message);
              }, 1000);
            } else {
              //alert('asa');
              window.location.replace("https://dualnationals.com/");
            }
          },
        });
      },
    });

    //  Remember Me
    jQuery("#rememberme").click(function () {
      if (jQuery("#rememberme").is(":checked")) {
        localStorage.usrname = jQuery("#user_login").val();
        localStorage.pass = jQuery("#user_pass").val();
        localStorage.chkbx = jQuery("#rememberme").val();
      } else {
        localStorage.chkbx = "";
      }
    });
    if (localStorage.chkbx && localStorage.chkbx != "") {
      jQuery("#rememberme").attr("checked", "checked");
      jQuery("#user_login").val(localStorage.usrname);
      jQuery("#user_pass").val(localStorage.pass);
    }
    jQuery(".mepr-login-actions a").attr(
      "href",
      "https://dualnationals.com/user-login/?action=forgot_password"
    );

    //  Forget Passowrd Vaidations
    jQuery("#mepr_forgot_password_form").validate({
      rules: {
        mepr_user_or_email: {
          required: true,
          email: true,
        },
      },
      // in 'messages' user have to specify message as per rules
      messages: {
        mepr_user_or_email: {
          required: "Please enter your email",
          email: "Please enter a valid email address",
        },
      },
    });
    jQuery("#mepr_user_or_email").on("keyup", function () {
      jQuery("#mepr_user_or_email111-error").html("");
    });

    // Reset Password Vaidations
    jQuery("#mepr_reset_password_form").validate({
      rules: {
        mepr_user_password: {
          required: true,
        },
        mepr_user_password_confirm: {
          required: true,
          equalTo: "#mepr_user_password",
        },
      },
      // in 'messages' user have to specify message as per rules
      messages: {
        mepr_user_password: {
          required: "Please enter your Password",
        },
        mepr_user_password_confirm: {
          required: "Please enter your Confirm password",
          equalTo: "Password and Confirm password doesn't matched",
        },
      },
    });
  }

  jQuery(".show_pwds").click(function () {
    if ("password" == jQuery("#mepr_user_password1").attr("type")) {
      jQuery("#mepr_user_password1").prop("type", "text");
    } else {
      jQuery("#mepr_user_password1").prop("type", "password");
    }
  });
  jQuery(".confirm_pass").click(function () {
    console.log("asdsadaaaaaaaaaa");
    if (jQuery(".mepr-password-confirm").attr("type") == "text") {
      jQuery(".mepr-password-confirm").attr("type", "password");
    } else {
      jQuery(".mepr-password-confirm").attr("type", "text");
    }
  });

  // Logout Functionalty

  jQuery(".copy_txt_main").click(function () {
    jQuery(this).addClass("is-active");
  });
});
// jQuery(window).load(function () {
//   // console.log(alert);
//   // alert("ajdkfhds");
//   jQuery("#loader").fadeOut(1000);
// });
