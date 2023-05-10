<?php if ( ! defined( 'ABSPATH' ) ) {
  die( 'You are not allowed to call this page directly.' );} 
if (have_posts()) : while (have_posts()) : the_post(); 
 $membership_id = get_the_ID();

 $membership = new MeprProduct($membership_id);
$price = $membership->price;
// echo "Membership price: " . $price;
// echo "<pre>";
// print_r($membership);
// echo "</pre>";
$price_titles =  get_the_title($membership_id);
if ( is_user_logged_in() ) 
	{
		// echo "Asdsadsad";die;
    ?>
<input type="hidden" id="country_code1" name="country_code"
    value="<?php echo get_user_meta(get_current_user_id(),'country_code',true);?>">
<input type="hidden" id="country_code_name1" name="country_code_name"
    value="<?php echo get_user_meta(get_current_user_id(),'country_code_name',true);?>">
<?php
	}
?>

<section class="pay_dual py_7">
    <div class="container">
        <div class="tittle_heading">
            <h2><?php the_title();?></h2>
        </div>
        <div class="pay_mnth">
            <div class="pay_mnth_txt">
                <h1>$<?php echo $price;?></h1>
                <?php if($price_titles == 'Free Membership'){ ?>

                <h3><?php echo $membership->expire_after ; echo $membership->expire_unit;?> Trial</h3>
                <?php } else{?>
                <h3>Month</h3>
                <?php } ?>
            </div>
            <div class="pay_mnth_details">
                <ul>
                    <li>
                        <div class="monthly_accsess">
                            <h6><?php the_title();?> – Initial Payment</h6>
                            <p>$<?php echo $price;?> / Month</p>
                        </div>
                    </li>
                    <li>
                        <div class="monthly_accsess">
                            <h6>Total</h6>
                            <p>$<?php echo $price;?> / Month</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mepr-before-signup-form">
            <?php do_action( 'mepr-above-checkout-form', $product->ID ); ?>
        </div>
        <div class="pay_dual_form">
            <form class="mepr-signup-form mepr-form alignwide" method="post"
                action="<?php echo $_SERVER['REQUEST_URI'] . '#mepr_jump'; ?>" enctype="multipart/form-data" novalidate>
                <div class="mepr-checkout-container mp_wrapper">
                    <div class="form-wrapper">
                        <div class="row">
                            <?php
    if ( isset( $errors ) and ! empty( $errors ) ) {
      // MeprView::render( '/shared/errors', get_defined_vars() );
    }  ?>
                            <input type="hidden" name="mepr_process_signup_form"
                                value="<?php echo isset( $_GET['mepr_process_signup_form'] ) ? esc_attr( $_GET['mepr_process_signup_form'] ) : 1; ?>" />
                            <input type="hidden" name="mepr_product_id"
                                value="<?php echo esc_attr( $product->ID ); ?>" />
                            <input type="hidden" name="mepr_transaction_id"
                                value="<?php echo isset( $_GET['mepr_transaction_id'] ) ? esc_attr( $_GET['mepr_transaction_id'] ) : ''; ?>" />

                            <?php if ( MeprUtils::is_user_logged_in() ) : ?>
                            <input type="hidden" name="logged_in_purchase" value="1" />
                            <input type="hidden" name="mepr_checkout_nonce"
                                value="<?php echo esc_attr( wp_create_nonce( 'logged_in_purchase' ) ); ?>">
                            <?php wp_referer_field(); ?>
                            <?php endif; ?>

                            <?php MeprHooks::do_action( 'mepr-checkout-before-name', $product->ID ); ?>

                            <?php
    if ( ( ! MeprUtils::is_user_logged_in() ||
        ( MeprUtils::is_user_logged_in() && $mepr_options->show_fields_logged_in_purchases ) ) &&
       $mepr_options->show_fname_lname ) :
      ?>
                            <div class="col-md-3 mb-4">
                                <label for="user_first_name<?php echo $unique_suffix; ?>">
                                    <?php
                      _ex( 'Name:', 'ui', 'memberpress' );
                      echo ( $mepr_options->require_fname_lname ) ? '*' : '';
      ?>
                                </label>
                                <input type="text" name="user_first_name"
                                    id="user_first_name<?php echo $unique_suffix; ?>" class="mepr-form-input"
                                    value="<?php echo esc_attr( $first_name_value ); ?>" placeholder="<?php
                            _ex( 'First Name', 'ui', 'memberpress' );
                            echo ( $mepr_options->require_fname_lname ) ? '*' : '';
                            ?>
      " <?php echo ( $mepr_options->require_fname_lname ) ? 'required' : ''; ?> />
                                <span class="cc-error first_names"></span>
                            </div>
                            <div class="col-md-3 mb-4">
                                <label for="userlast_name<?php echo $unique_suffix; ?>">
                                    <?php
                      _ex( 'Last Name:', 'ui', 'memberpress' );
                      echo ( $mepr_options->require_fname_lname ) ? '*' : '';
      ?>
                                </label>
                                <input type="text" name="user_last_name"
                                    id="user_last_name<?php echo $unique_suffix; ?>" class="mepr-form-input"
                                    value="<?php echo esc_attr( $last_name_value ); ?>" placeholder="<?php
                            _ex( 'Last Name', 'ui', 'memberpress' );
                            echo ( $mepr_options->require_fname_lname ) ? '*' : '';
                            ?>
      " <?php echo ( $mepr_options->require_fname_lname ) ? 'required' : ''; ?> />
                                <span class="cc-error last_names"></span>

                            </div>

                            <!-- <div class="mp-form-row mepr_first_name<?php // echo ($mepr_options->require_fname_lname) ? ' mepr-field-required' : ''; ?>"> -->
                            <!-- <div class="mp-form-label"> -->
                            <!-- <label for="user_first_name<?php // echo $unique_suffix; ?>">
      <?php
      _ex( 'First Name:', 'ui', 'memberpress' );
      echo ( $mepr_options->require_fname_lname ) ? '*' : '';
      ?>
    </label> -->
                            <span class="cc-error"><?php // _ex( 'First Name Required', 'ui', 'memberpress' ); ?></span>
                            <!-- </div> -->

                            <!-- </div> -->
                            <!-- <div class="mp-form-row mepr_last_name<?php echo ( $mepr_options->require_fname_lname ) ? ' mepr-field-required' : ''; ?>"> -->
                            <!-- <div class="mp-form-label"> -->
                            <!-- <label for="user_last_name<?php echo $unique_suffix; ?>">
                          <?php
                          _ex( 'Last Name:', 'ui', 'memberpress' );
                          echo ( $mepr_options->require_fname_lname ) ? '*' : '';
                          ?>
    </label> -->
                            <span class="cc-error"><?php _ex( 'Last Name Required', 'ui', 'memberpress' ); ?></span>
                            <!-- </div> -->

                            <!-- </div> -->

                            <?php else : /* this is here to avoid validation issues */ ?>
                            <input type="hidden" name="user_first_name"
                                value="<?php echo esc_attr( $first_name_value ); ?>" />
                            <input type="hidden" name="user_last_name"
                                value="<?php echo esc_attr( $last_name_value ); ?>" />
                            <?php endif; ?>

                            <?php MeprHooks::do_action( 'mepr-checkout-before-custom-fields', $product->ID ); ?>

                            <?php
    if ( ! MeprUtils::is_user_logged_in() || ( MeprUtils::is_user_logged_in() && $mepr_options->show_fields_logged_in_purchases ) ) {

      ?>

                            <?php
      if ( $mepr_options->show_address_fields && ! $product->disable_address_fields ) {
        MeprUsersHelper::render_address_fields();
      }
      ?>

                            <?php
      MeprUsersHelper::render_custom_fields( $product, 'signup', $unique_suffix, false );
    }
    ?>

                            <?php MeprHooks::do_action( 'mepr-checkout-after-custom-fields', $product->ID ); ?>

                            <?php if ( MeprUtils::is_user_logged_in() ) : ?>
                            <input type="hidden" name="user_email"
                                value="<?php echo esc_attr( stripslashes( $mepr_current_user->user_email ) ); ?>" />
                            <?php else : ?>
                            <input type="hidden" class="mepr-geo-country" name="mepr-geo-country" value="" />

                            <?php if ( ! $mepr_options->username_is_email ) : ?>
                            <div class="mp-form-row mepr_username mepr-field-required">
                                <div class="mp-form-label">
                                    <label
                                        for="user_login<?php echo $unique_suffix; ?>"><?php _ex( 'Username:*', 'ui', 'memberpress' ); ?></label>
                                    <span
                                        class="cc-error"><?php _ex( 'Invalid Username', 'ui', 'memberpress' ); ?></span>
                                </div>
                                <input type="text" name="user_login" id="user_login<?php echo $unique_suffix; ?>"
                                    class="mepr-form-input"
                                    value="<?php echo ( isset( $user_login ) ) ? esc_attr( stripslashes( $user_login ) ) : ''; ?>"
                                    required />
                            </div>
                            <?php endif; ?>
                            <div class="mp-form-row mepr_email mepr-field-required">
                                <div class="mp-form-label">
                                    <label
                                        for="user_email<?php echo $unique_suffix; ?>"><?php _ex( 'Email:*', 'ui', 'memberpress' ); ?></label>
                                    <span class="cc-error"><?php _ex( 'Invalid Email', 'ui', 'memberpress' ); ?></span>
                                </div>
                                <input type="email" name="user_email" id="user_email<?php echo $unique_suffix; ?>"
                                    class="mepr-form-input"
                                    value="<?php echo ( isset( $user_email ) ) ? esc_attr( stripslashes( $user_email ) ) : ''; ?>"
                                    required />
                            </div>
                            <div class="mp-form-row mepr_email_stripe mepr-field-required mepr-hidden">
                            </div>
                            <?php MeprHooks::do_action( 'mepr-after-email-field' ); // Deprecated ?>
                            <?php MeprHooks::do_action( 'mepr-checkout-after-email-field', $product->ID ); ?>
                            <?php if ( $mepr_options->disable_checkout_password_fields === false ) : ?>
                            <div class="col-md-12">
                                <div class="row">

                                    <div class="mp-form-row mepr_password mepr-field-required">
                                        <div class="mp-form-label">
                                            <label
                                                for="mepr_user_password<?php echo $unique_suffix; ?>"><?php _ex( 'Password:*', 'ui', 'memberpress' ); ?></label>
                                            <span
                                                class="cc-error"><?php _ex( 'Invalid Password', 'ui', 'memberpress' ); ?></span>
                                        </div>
                                        <div class="mp-hide-pw">
                                            <input type="password" name="mepr_user_password"
                                                id="mepr_user_password<?php echo $unique_suffix; ?>"
                                                class="mepr-form-input mepr-password"
                                                value="<?php echo ( isset( $mepr_user_password ) ) ? esc_attr( stripslashes( $mepr_user_password ) ) : ''; ?>"
                                                required />
                                            <button type="button" class="button mp-hide-pw hide-if-no-js"
                                                data-toggle="0"
                                                aria-label="<?php esc_attr_e( 'Show password', 'memberpress' ); ?>">
                                                <span class="dashicons dashicons-visibility" aria-hidden="true"></span>
                                            </button>
                                            <div id="password_strength" style="display:none">

                                            </div>
                                        </div>
                                    </div>


                                    <div class="mp-form-row mepr_password_confirm mepr-field-required">
                                        <div class="mp-form-label">
                                            <label
                                                for="mepr_user_password_confirm<?php echo $unique_suffix; ?>"><?php _ex( 'Password Confirmation:*', 'ui', 'memberpress' ); ?></label>
                                            <span
                                                class="cc-error"><?php _ex( 'Password Confirmation Doesn\'t Match', 'ui', 'memberpress' ); ?></span>
                                        </div>
                                        <div class="mp-hide-pw">
                                            <input type="password" name="mepr_user_password_confirm"
                                                id="mepr_user_password_confirm<?php echo $unique_suffix; ?>"
                                                class="mepr-form-input mepr-password-confirm"
                                                value="<?php echo ( isset( $mepr_user_password_confirm ) ) ? esc_attr( stripslashes( $mepr_user_password_confirm ) ) : ''; ?>"
                                                required />
                                            <span class="cc-error confrim_pass"></span>

                                            <button type="button" class="button mp-hide-pw hide-if-no-js"
                                                data-toggle="0"
                                                aria-label="<?php esc_attr_e( 'Show password', 'memberpress' ); ?>">
                                                <span class="dashicons dashicons-visibility confirm_pass"
                                                    aria-hidden="true"></span>
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <?php MeprHooks::do_action( 'mepr-after-password-fields' ); // Deprecated ?>
                            <?php MeprHooks::do_action( 'mepr-checkout-after-password-fields', $product->ID ); ?>
                            <?php endif; ?>
                            <?php endif; ?>

                            <?php MeprHooks::do_action( 'mepr-before-coupon-field' ); // Deprecated ?>
                            <?php MeprHooks::do_action( 'mepr-checkout-before-coupon-field', $product->ID ); ?>

                            <div class="invoice-wrapper">
                                <!--     <h3 class="invoice-heading"><?php //printf( esc_html_x( 'Pay %s', 'ui', 'memberpress' ), get_bloginfo( 'name' ) ); ?></h3>
 -->
                                <div class="mp-form-row mepr_bold mepr_price">
                                    <div class="mepr_price_cell invoice-amount">
                                        <?php MeprProductsHelper::display_invoice( $product, $mepr_coupon_code ); ?>
                                    </div>
                                </div>

                                <!--jkfhjkdsffdsf -->
                                <div class="mepr-product-rows">
                                    <?php if ( $payment_required || ! empty( $product->plan_code ) ) : ?>
                                    <?php if ( $mepr_options->coupon_field_enabled ) : ?>
                                    <!-- <a class="have-coupon-link coupan_code_cus" data-prdid="<?php echo $product->ID; ?>"
                                        href="">
                                        <?php //echo MeprCouponsHelper::show_coupon_field_link_content( $mepr_coupon_code ); ?>
                                    </a>-->
                                    <div style="display:block;"
                                        class="mp-form-row mepr_coupon mepr_coupon_<?php echo $product->ID; ?> mepr-hidden">
                                        <div class="mp-form-label">
                                            <label
                                                for="mepr_coupon_code<?php  echo $unique_suffix; ?>"><?php  _ex( 'Coupon Code:', 'ui', 'memberpress' ); ?></label>
                                            <span class="mepr-coupon-loader mepr-hidden">
                                                <img src="<?php echo includes_url( 'js/thickbox/loadingAnimation.gif' ); ?>"
                                                    alt="<?php _e( 'Loading...', 'memberpress' ); ?>"
                                                    title="<?php _ex( 'Loading icon', 'ui', 'memberpress' ); ?>"
                                                    width="100" height="10" />
                                            </span>
                                            <span
                                                class="cc-error coupens_error"><?php _ex( 'Invalid Coupon', 'ui', 'memberpress' ); ?></span>
                                        </div>
                                        <input type="text" id="mepr_coupon_code<?php echo $unique_suffix; ?>"
                                            class="mepr-form-input mepr-coupon-code"
                                            placeholder="<?php _ex( 'Coupon Code:', 'ui', 'memberpress' ); ?>"
                                            name="mepr_coupon_code"
                                            value="<?php echo ( isset( $mepr_coupon_code ) ) ? esc_attr( stripslashes( $mepr_coupon_code ) ) : ''; ?>"
                                            data-prdid="<?php echo $product->ID; ?>" />
                                        <a id="apply_coopens" href="">Apply Now</a>
                                        <a id="remove_coupens" href="">Remove</a>
                                    </div>
                                    <?php else : ?>
                                    <input type="hidden" name="mepr_coupon_code"
                                        value="<?php echo ( isset( $mepr_coupon_code ) ) ? esc_attr( stripslashes( $mepr_coupon_code ) ) : ''; ?>" />
                                    <?php endif; ?>
                                    <?php endif ?>





                                </div>

                            </div>
                            <div class="mepr-transaction-invoice-wrapper 4545" style="padding-top:10px">
                                <span class="mepr-invoice-loader mepr-hidden">
                                    <img src="<?php echo includes_url( 'js/thickbox/loadingAnimation.gif' ); ?>"
                                        alt="<?php _e( 'Loading...', 'memberpress' ); ?>"
                                        title="<?php _ex( 'Loading icon', 'ui', 'memberpress' ); ?>" width="100"
                                        height="10" />
                                </span>
                                <div><?php MeprProductsHelper::display_spc_invoice( $product, $mepr_coupon_code ); ?>
                                </div>
                            </div>
                            <?php if ( $payment_required || ! empty( $product->plan_code ) ) : ?>

                            <div class="mepr-payment-methods-wrapper">
                                <?php if ( sizeof( $payment_methods ) > 1 ) : ?>
                                <h3><?php _ex( 'Please choose your payment options', 'ui', 'memberpress' ); ?></h3>
                                <?php endif; ?>
                                <div class="mepr-payment-methods-icons">
                                    <?php echo MeprOptionsHelper::payment_methods_icons( $payment_methods ); ?>
                                </div>
                                <div
                                    class="mepr-payment-methods-radios<?php echo sizeof( $payment_methods ) === 1 ? ' mepr-hidden' : ''; ?>">
                                    <?php echo MeprOptionsHelper::payment_methods_radios( $payment_methods ); ?>
                                </div>
                                <?php if ( sizeof( $payment_methods ) > 1 ) : ?>
                                <hr />
                                <?php endif; ?>
                                <?php echo MeprOptionsHelper::payment_methods_descriptions( $payment_methods ); ?>
                            </div>
                            <?php else : ?>
                            <input type="hidden" id="mepr_coupon_code-<?php echo $product->ID; ?>"
                                name="mepr_coupon_code"
                                value="<?php echo ( isset( $mepr_coupon_code ) ) ? esc_attr( stripslashes( $mepr_coupon_code ) ) : ''; ?>" />
                            <?php endif; ?>

                            <?php if ( $mepr_options->enable_spc_invoice && $product->adjusted_price( $mepr_coupon_code ) <= 0.00 && false == ( isset( $_GET['ca'] ) && class_exists( 'MPCA_Corporate_Account' ) ) ) { ?>
                            <div class="mepr-transaction-invoice-wrapper ju" style="padding-top:10px; display:none;">
                                <span class="mepr-invoice-loader mepr-hidden">
                                    <img src="<?php echo includes_url( 'js/thickbox/loadingAnimation.gif' ); ?>"
                                        alt="<?php _e( 'Loading...', 'memberpress' ); ?>"
                                        title="<?php _ex( 'Loading icon', 'ui', 'memberpress' ); ?>" width="100"
                                        height="10" />
                                </span>
                                <div>
                                    <!-- Transaction Invoice shows up here  -->
                                </div>
                            </div>
                            <?php } ?>


                            <?php if ( $mepr_options->require_tos ) : ?>
                            <div class="mp-form-row mepr_tos">
                                <label for="mepr_agree_to_tos<?php echo $unique_suffix; ?>"
                                    class="mepr-checkbox-field mepr-form-input" required>
                                    <input type="checkbox" name="mepr_agree_to_tos"
                                        id="mepr_agree_to_tos<?php echo $unique_suffix; ?>"
                                        <?php checked( isset( $mepr_agree_to_tos ) ); ?> />
                                    <a href="<?php echo stripslashes( $mepr_options->tos_url ); ?>" target="_blank"
                                        rel="noopener noreferrer"><?php echo stripslashes( $mepr_options->tos_title ); ?></a>*
                                </label>
                            </div>
                            <?php endif; ?>

                            <?php if ( $mepr_options->require_privacy_policy && $privacy_page_link = MeprAppHelper::privacy_policy_page_link() ) : ?>
                            <div class="mp-form-row">
                                <label for="mepr_agree_to_privacy_policy<?php echo $unique_suffix; ?>"
                                    class="mepr-checkbox-field mepr-form-input" required>
                                    <input type="checkbox" name="mepr_agree_to_privacy_policy"
                                        id="mepr_agree_to_privacy_policy<?php echo $unique_suffix; ?>" />
                                    <?php echo preg_replace( '/%(.*)%/', '<a href="' . $privacy_page_link . '" target="_blank">$1</a>', __( $mepr_options->privacy_policy_title, 'memberpress' ) ); ?>
                                </label>
                            </div>
                            <?php endif; ?>

                            <?php MeprHooks::do_action( 'mepr-user-signup-fields' ); // Deprecated ?>
                            <?php MeprHooks::do_action( 'mepr-checkout-before-submit', $product->ID ); ?>

                            <div class="mepr_spacer"> </div>





                            <div class="mp-form-submit">
                                <?php // This mepr_no_val needs to be hidden in order for this to work so we do it explicitly as a style ?>
                                <label for="mepr_no_val"
                                    class="mepr-visuallyhidden"><?php _ex( 'No val', 'ui', 'memberpress' ); ?></label>
                                <input type="text" id="mepr_no_val" name="mepr_no_val"
                                    class="mepr-form-input mepr-visuallyhidden mepr_no_val mepr-hidden"
                                    autocomplete="off" />

                                <input type="submit" class="mepr-submit"  value="<?php echo get_field('button_text');?>" />
                                <img src="<?php echo admin_url( 'images/loading.gif' ); ?>"
                                    alt="<?php _e( 'Loading...', 'memberpress' ); ?>" style="display: none;"
                                    class="mepr-loading-gif"
                                    title="<?php _ex( 'Loading icon', 'ui', 'memberpress' ); ?>" />
                                <?php MeprView::render( '/shared/has_errors', get_defined_vars() ); ?>
                            </div>
                        </div>


                    </div>

                </div>
            </form>
        </div>
    </div>
</section>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/other_js_files/intlTelInput-jquery.min.js">
</script>

<script>
jQuery(document).ready(function() {
    jQuery(".confirm_pass").click(function() {
        if (jQuery("#mepr_user_password_confirm1").attr("type") === "password") {
            jQuery("#mepr_user_password_confirm1").attr("type", "text");
        } else {
            jQuery("#mepr_user_password_confirm1").attr("type", "password");
        }
    });
    jQuery("#mepr-address-zip").attr('maxlength', '7');
    jQuery("#mepr_email1").keyup(function() {
        localStorage.setItem('test',jQuery(this).val());




    });

    jQuery(".mepr-submit").click(function() {
        var user_email1 = jQuery('#user_email1').val();
        if (user_email1 == '') {
            jQuery('.mp-form-row.mepr_email.mepr-field-required .cc-error ').text('Email is Required');

        }

        var user_pass = jQuery('#mepr_user_password1').val();
        if (user_pass == '') {
            jQuery('.mepr_password .cc-error ').text('Password is Required');

        }
        jQuery('.mepr_mepr_phone_number .cc-error').css("display", "block", "!important");
        jQuery(".confirm_pass").click(function() {
            if (jQuery("#mepr_user_password_confirm1").attr("type") === "password") {
                jQuery("#mepr_user_password_confirm1").attr("type", "text");
            } else {
                jQuery("#mepr_user_password_confirm1").attr("type", "password");
            }
        });
        var first_name = jQuery('#user_first_name1').val();
        if (first_name == '') {
            jQuery("span.cc-error.first_names").text("First Name is Required ");

            jQuery("span.cc-error.first_names").css("display", "block", "!important");
        } else {
            jQuery("span.cc-error.first_names").css("display", "none", "!important");
        }
        var user_last_name1 = jQuery('#user_last_name1').val();
        if (user_last_name1 == '') {
            jQuery("span.cc-error.last_names").text("Last Name is Required ");

            jQuery("span.cc-error.last_names").css("display", "block", "!important");
        } else {
            jQuery("span.cc-error.last_names").css("display", "none", "!important");
        }
        var confirm_pass = jQuery('#mepr_user_password_confirm1').val();
        if (confirm_pass == '') {
            jQuery("span.cc-error.confrim_pass").text("confirm Password is Required ");

            jQuery("span.cc-error.confrim_pass").css("display", "block", "!important");
        } else {
            jQuery("span.cc-error.confrim_pass").css("display", "none", "!important");
        }
    });

 
    
    jQuery("#apply_coopens").click(function(Event) {
        Event.preventDefault();
        setTimeout(function() {

            var coupens_error = jQuery('#mepr_coupon_code1').attr('class');
            console.log(coupens_error);
            if (coupens_error == 'mepr-form-input mepr-coupon-code invalid') {
                console.log(coupens_error);
                jQuery('#apply_coopens').css('display', 'block', '!important');


            } else {
                jQuery('#apply_coopens').css('display', 'none', '!important');
                jQuery('a#remove_coupens').css('display', 'block', '!important');


            }
        }, 800);

    });
    jQuery("#apply_coopens").click(function(event) {
        event.preventDefault();
        jQuery("#mepr_coupon_code1").trigger("click");


    });
    jQuery(".payment-option-paypalcommerce").click(function() {
        jQuery(
                '.mepr-payment-method.mepr_payment_method-rrgtc4-2ve.mepr-payment-method-paypalcommerce '
            )
            .css('display', 'block', '!important');
    });
    // jQuery('.mepr-paypal-card-errors').text('This email address has already been used');

    jQuery("#mepr_phone_number1").attr('maxlength', '10');

    jQuery('.payment-option-paypalcommerce').prepend(
        '<img id="theImg" src="http://www.dualnationals.com/wp-content/uploads/2023/03/download.png" />');
    jQuery('.payment-option-stripe').prepend(
        '<img src="https://www.dualnationals.com/wp-content/plugins/memberpress/images/checkout/cards.png">'
    );

    // 		jQuery('.payment-option-stripe').html('<img src="https://www.dualnationals.com/wp-content/plugins/memberpress/images/checkout/cards.png">');


    jQuery("#mepr_user_password1").keyup(function() {
        jQuery('#remove_coupens').hide();
        jQuery("#apply_coopens").click(function(event) {
            event.preventDefault();
            var errors_get = jQuery('.coopen_errors').text();
            if (errors_get !== 'Invalid Coupon') {
                jQuery('#remove_coupens').css('display', 'block', '!important');
                jQuery('#apply_coopens').css('display', 'none', '!important');



            } else {
                jQuery('#remove_coupens').css('display', 'none', '!important');
                jQuery('#apply_coopens').css('display', 'block', '!important');
            }


        });

        jQuery('#form_data_id').addClass('form_submit_data');
        jQuery('#password_strength').html(
            '<span class="indicator invalid" id="length">At least 8 characters</span><span class="indicator invalid" id="capital">At least one capital letter</span> <span class="indicator invalid" id="special">At least one special character (!@#jQuery%^&*)</span> <span class="indicator invalid" id="number">At least one number</span>'
        );
        var password = jQuery(this).val();

        // Validate length
        if (password.length < 8) {


            jQuery("#length").removeClass("valid").addClass("invalid");



        } else {
            jQuery("#length").removeClass("invalid").addClass("valid");
            //setTimeout(function () {
            //jQuery(".valid").append('<i class="fa fa-check" aria-hidden="true"></i>');
            //}, 1000);
        }

        // Validate capital letter
        if (password.match(/[A-Z]/)) {
            jQuery("#capital").removeClass("invalid").addClass("valid");
            // jQuery(".valid").append('<i class="fa fa-check" aria-hidden="true"></i>');

        } else {
            jQuery("#capital").removeClass("valid").addClass("invalid");
        }

        // Validate special character
        if (password.match(/[!@#jQuery%^&*]/)) {
            jQuery("#special").removeClass("invalid").addClass("valid");

            //          jQuery(".invalid").append('<i class="fa fa-times" aria-hidden="true"></i>');


        } else {
            jQuery("#special").removeClass("valid").addClass("invalid");
            jQuery(".valid").append('<i class="fa fa-check" aria-hidden="true"></i>');

        }

        // Validate number
        if (password.match(/[0-9]/)) {
            jQuery("#number").removeClass("invalid").addClass("valid");
            jQuery(".valid").append('<i class="fa fa-check" aria-hidden="true"></i>');

        } else {
            jQuery("#number").removeClass("valid").addClass("invalid");
        }
    });
    jQuery('.mepr_custom_field').addClass('col-md-3 mb-4');

});
console.log('asdsadsa');

jQuery(document).on("click", ".mepr-form-radio", function() {
    // jQuery(".component-frame visible").find("buttons-container").attr("display","none")
    jQuery('.paypal-powered-by').css('display', 'none');
    jQuery('.paypal-button-row').css('display', 'none');
    // console.log('asdsadsa');
    // 
});
jQuery('#mepr_phone_number1').keyup(function(e) {
    console.log('asdsad');
    if (/\D/g.test(this.value)) {
        // Filter non-digits from input value.
        this.value = this.value.replace(/\D/g, '');
    }
});



</script>
<?php endwhile; ?>
<?php endif;