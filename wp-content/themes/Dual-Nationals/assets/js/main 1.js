jQuery(document).ready(function () {

  // home_slider s
  $('.selected a').click(function () {
    var englishs = jQuery('.selected a').text();
    if (englishs == ' English') {
      jQuery('.option a:nth-child(4)').css('display', 'none', '!important');
    }
    else {
      jQuery('.option a:nth-child(4)').css('display', 'block', '!important');
    }
  });
  var text = document.querySelector("body");
  text.classList.add("dark-mode");


  jQuery('.home_slider').slick({
    dots: false,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    prevArrow: "<img class='slick-prev' src='https://exoticaitsolutions.com/dual-national/wp-content/uploads/2023/02/banner_arrow_l.png'>",
    nextArrow: "<img class='slick-next' src='https://exoticaitsolutions.com/dual-national/wp-content/uploads/2023/02/banner_arrow_r.png'>"
  });

  // testi_monial_slider_slider Sidebar 
  jQuery('.testi_monial_slider_slider').slick({
    dots: false,
    arrows: true,
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    speed: 300,
    prevArrow: jQuery(".slide_controls .slide-prev"),
    nextArrow: jQuery(".slide_controls .slide-next")
  });

  // populateCountries("country", "state");

  var countries = jQuery('#countries');
  jQuery('#watch_list_data').DataTable({

    rowReorder: true,
    lengthMenu: [10, 20],
    "language": {
      "paginate": {
        "previous": '<img id="left_img" src="/wp-content/uploads/2023/03/left_arrow.png" />',
        "next": '<img id="right_img" src="/wp-content/uploads/2023/03/right_arrow.png" />',
      }
    },
    columnDefs: [
      { orderable: true, className: 'reorder', targets: 0 },
      { orderable: true, className: 'reorder', targets: 2 },
      { orderable: true, className: 'reorder', targets: 4 },
      { orderable: false, targets: '_all' }
    ]
  });



  jQuery('.package_lists ul ').addClass('package_list');

  jQuery('input').attr('autocomplete', 'on');


  var countries = ["Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Anguilla", "Antigua & Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia & Herzegovina", "Botswana", "Brazil", "British Virgin Islands", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central Arfrican Republic", "Chad", "Chile", "China", "Colombia", "Congo", "Cook Islands", "Costa Rica", "Cote D Ivoire", "Croatia", "Cuba", "Curacao", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands", "Faroe Islands", "Fiji", "Finland", "France", "French Polynesia", "French West Indies", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kosovo", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauro", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "Norway", "Oman", "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russia", "Rwanda", "Saint Pierre & Miquelon", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Korea", "South Sudan", "Spain", "Sri Lanka", "St Kitts & Nevis", "St Lucia", "St Vincent", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor L'Este", "Togo", "Tonga", "Trinidad & Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks & Caicos", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States of America", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Virgin Islands (US)", "Yemen", "Zambia", "Zimbabwe"];
  autocomplete(document.getElementById("search"), countries);



  //Wishlist  Add  and Remove Functionlty FDunctionaly
  jQuery(document).on("click", "#save_favrt", function () {
    jQuery.ajax({
      type: "POST",
      dataType: "json",
      timeout: 16000,
      url: jQuery('#admin_url').val(),
      data: { action: "Save_wish_list_data", player_id: jQuery('#player_id').val(), current_user_id: jQuery('#current_user_id').val(), wishlist_exit: $(this).attr("wishlist_exit"), wishlist_id: $(this).attr("wishlist_id") },
      beforeSend: function () { $("#cover-spin").css("display", "block") },
      success: function (response) {
        $("#cover-spin").css("display", "none")
        if (response.status == '401' || response.status == 401 || response.status == '403' || response.status == 403) { // Login Functionlaty 
          swal({
            className: "theme_btn",
            title: "",
            text: response.message,
            icon: "warning",

          }).then(function () { location.reload(); });
        } else if (response.status == '201' || response.status == 201 || response.status == '204' || response.status == 204) {
          swal({
            className: "theme_btn",
            title: "",
            text: response.message,
            icon: "success",
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
      }, error: function (error) {
      }
    });
  });

  // var imge =   $('#country_code').val(`+${jQuery(this).attr('data-dial-code')}`);




  jQuery("#mobile").intlTelInput({
    initialCountry: $('#country_code_name').val(),
    separateDialCode: true,
  });




  //  Selected_option_jsuqery _cdn
  jQuery('.iti__country-list li').on('click', function () {
    $('#country_code').val(`+${jQuery(this).attr('data-dial-code')}`);
    $('#country_code_name').val(jQuery(this).attr('data-country-code'));
  });
  $("#mepr_user_password1").keyup(function () {

    $('#form_data_id').addClass('form_submit_data');
    $('#password_strength').html('<span class="indicator invalid" id="length">At least 8 characters</span><span class="indicator invalid" id="capital">At least one capital letter</span> <span class="indicator invalid" id="special">At least one special character (!@#$%^&*)</span> <span class="indicator invalid" id="number">At least one number</span>');
    var password = $(this).val();

    // Validate length
    if (password.length < 8) {


      $("#length").removeClass("valid").addClass("invalid");



    } else {
      $("#length").removeClass("invalid").addClass("valid");
      //setTimeout(function () {
      //$(".valid").append('<i class="fa fa-check" aria-hidden="true"></i>');
      //}, 1000);
    }

    // Validate capital letter
    if (password.match(/[A-Z]/)) {
      $("#capital").removeClass("invalid").addClass("valid");
      // $(".valid").append('<i class="fa fa-check" aria-hidden="true"></i>');

    } else {
      $("#capital").removeClass("valid").addClass("invalid");
    }

    // Validate special character
    if (password.match(/[!@#$%^&*]/)) {
      $("#special").removeClass("invalid").addClass("valid");

      //          $(".invalid").append('<i class="fa fa-times" aria-hidden="true"></i>');


    } else {
      $("#special").removeClass("valid").addClass("invalid");
      $(".valid").append('<i class="fa fa-check" aria-hidden="true"></i>');

    }

    // Validate number
    if (password.match(/[0-9]/)) {
      $("#number").removeClass("invalid").addClass("valid");
      $(".valid").append('<i class="fa fa-check" aria-hidden="true"></i>');

    } else {
      $("#number").removeClass("valid").addClass("invalid");
    }
  });



  // On the edit page, there are multiple functionalities.
  if(window.location.pathname.indexOf("/edit-profile/") > -1){
    populate_state_contries_on_edit_page({ action: "country_state_fucntionlty_on_edit_page", country_name:$(this).val(), selected_state:$('#state_name_list').val(),country_id:$('option:selected', this).attr('id'),iso:$('option:selected', this).attr('iso2')})
    
    jQuery(document).on("change", "#country", function () {
      populate_state_contries_on_edit_page({ action: "country_state_fucntionlty_on_edit_page", country_name:$(this).val(), selected_state:'',country_id:$('option:selected', this).attr('id'),iso:$('option:selected', this).attr('iso2')})
  });

 }  
  // Form Submit 

  $("#contactForm1s").validate({
    // in 'rules' user have to specify all the constraints for respective fields
    rules: {
      first_name: {
        required: true,
        minlength: 5,
        lettersonly: true ,
        maxlength: 20,
      },mepr_phone_number: {
        required: true,
        number:true,
        minlength: 10,
        maxlength: 11,

      },mepr_address_one: {
        required: true,
        minlength: 2,
        lettersonly: true ,
        maxlength: 250,
      },mepr_address_city: {
        required: true,
        minlength: 2,
        lettersonly: true ,
        maxlength: 30,
      },mepr_address_zip: {
        required: true,
        number:true,
        // lettersonly: true ,  
        minlength: 2,
        maxlength: 7,
      },
      mepr_address_state: {
        required: true,
      }
      
    },
    // in 'messages' user have to specify message as per rules
    messages: {

    }
    
  });

  $("#mepr_loginform").validate({
    rules: {
      log: {
        required: true,
        email:true,
      } , pwd: {
        required: true,
        minlength:2,
      } 
    },
    messages: {
    } ,submitHandler: function(form,e) {
      e.preventDefault();
      var form = $('form').serialize();
      var remember = $('#rememberme:checked').val();
      var user_login = $('#user_logins').val();
      var user_pass = $('#user_pass').val();
   

      // var $form = $(form);
      $.ajax({
        url: jQuery('#admin_url_edit_page').val(),
       type: "POST",
      timeout: 16000,
      data: { action: "login_form_submisssion",remember :$('#rememberme:checked').val(),user_login:$('#user_login').val(),user_pass :$('#user_pass').val()},
      beforeSend: function () { $("#cover-spin").css("display", "block") },
        success: function (responsedata) {
          $("#cover-spin").css("display", "none")
          console.log(responsedata);

        }
      });
      // console.log(form);


    }

  });
});