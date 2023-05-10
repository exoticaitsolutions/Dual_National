<?php
/*template name: Card Info page  */
get_header('new');

$current_user = wp_get_current_user();
$user_id = $current_user->ID;
//$mpr = mepr_user_is_logged_in();
// if ( $user_id) {
//     $mepr_user = new MeprUser($user_id);

//     $cc_num = "1234567890123456"; // New credit card number
//     $exp_month = "12"; // Expiration month (2-digit format)
//     $exp_year = "2025"; // Expiration year (4-digit format)
//     $cvv = "123"; // CVV code

//     $payment_method = $mepr_user->payment_method();
//     if ($payment_method) {
//         $payment_method->update_cc($cc_num, $exp_month, $exp_year, $cvv);
//     }
// }


get_footer('new');