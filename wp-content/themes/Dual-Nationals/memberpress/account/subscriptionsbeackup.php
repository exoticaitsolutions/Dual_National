<?php
if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');}
// echo "<pre>";print_r($subscriptions);die;
MeprHooks::do_action('mepr_before_account_subscriptions', $mepr_current_user);

// echo "Adsasdas";die;
global $wpdb;    
$user_ID = get_current_user_id(); // get the user ID

$table = 'wp_mepr_subscriptions';

$subscriptions = $wpdb->get_results ( "SELECT * FROM $table WHERE `user_id` = $user_ID  ");

 
if(!empty($subscriptions)) {
  $alt = false;
  ?>
<div class="mp_wrapper">
    <?php MeprHooks::do_action('mepr-account-subscriptions-th', $mepr_current_user, $subscriptions); ?>
    <?php
        foreach($subscriptions as $s):
          if(trim($s->sub_type) == 'transaction') {
            $is_sub   = false;
            $txn      = $sub = new MeprTransaction($s->id);
            $pm       = $txn->payment_method();
            $prd      = $txn->product();
            $group    = $prd->group();
            $default  = _x('Never', 'ui', 'memberpress');
            if($txn->txn_type == MeprTransaction::$fallback_str && $mepr_current_user->subscription_in_group($group)) {
              //Skip fallback transactions when user has an active sub in the fallback group
              continue;
            }
          }
          else {
            $is_sub   = true;
            $sub      = new MeprSubscription($s->id);
            $txn      = $sub->latest_txn();
            $pm       = $sub->payment_method();
            $prd      = $sub->product();
            $group    = $prd->group();

            if($txn == false || !($txn instanceof MeprTransaction) || $txn->id <= 0) {
              $default = _x('Unknown', 'ui', 'memberpress');
            }
            else if(trim($txn->expires_at) == MeprUtils::db_lifetime() or empty($txn->expires_at)) {
              $default = _x('Never', 'ui', 'memberpress');
            }
            else {
              $default = _x('Unknown', 'ui', 'memberpress');
            }
          }

          $mepr_options = MeprOptions::fetch();
          $alt          = !$alt; // Facilitiates the alternating lines
        ?>
    <!-- MEMBERSHIP ACCESS URL -->
    <div class="payment-section-box member_ship_form">
        <div class="payment-row">
            <ul>
                <li>
                    <div class="member_ship_div">
                        <div class="payment-heading"> Your Membership:</div>
                        <?php //echo "<pre>";print_r($prd);?>
                        <div class="payment-content"><?php if(isset($prd->access_url) && !empty($prd->access_url)): ?>
                            <span class="mepr-account-product"><a
                                    href="<?php echo stripslashes($prd->access_url); ?>"><?php echo MeprHooks::apply_filters('mepr-account-subscr-product-name', $prd->post_title, $txn); ?></a></span>
                            <?php else: ?>
                            <span
                                class="mepr-account-product"><?php echo MeprHooks::apply_filters('mepr-account-subscr-product-name', $prd->post_title, $txn); ?></span>
                            <?php endif; ?> <b><?php
                                  if($txn != false && $txn instanceof MeprTransaction && $txn->is_sub_account()) {
                                    ?>
                                <div class="mepr-account-sub-account-auto-rebill">
                                    <?php _ex('Sub Account', 'ui', 'memberpress'); ?>
                                    <?php MeprHooks::do_action('mepr_account_subscriptions_sub_account_auto_rebill', $txn); ?>
                                </div>
                                <?php
                                  }
                                  else {
                                    if($is_sub):
                                      echo ($s->status == MeprSubscription::$active_str)?_x('Enabled', 'ui', 'memberpress'):MeprAppHelper::human_readable_status($s->status, 'subscription');
                                    elseif(is_null($s->expires_at) or $s->expires_at == MeprUtils::db_lifetime()):
                                      _ex('Lifetime', 'ui', 'memberpress');
                                    else:
                                      _ex('None', 'ui', 'memberpress');
                                    endif;
                                  }
                                ?>
                            </b>
                        </div>
                    </div>

                    <div class="payment-row-links">
                        <?php if($s->status == 'suspended'){?>
                        <a href="<?php echo "/account/?action=resume&sub=$s->id"; ?>"
                            class="mepr-account-row-action mepr-account-resume"
                            onclick="return confirm('<?php _e('Are you sure you want to resume this subscription?', 'memberpress'); ?>');"><?php _e('Resume your membership', 'memberpress'); ?></a>
                        <?php } else {?>
                        <a href="<?php echo "/account/?action=suspend&sub=$s->id"; ?>"
                            class="mepr-account-row-action mepr-account-suspend"
                            onclick="return confirm('<?php _e('Are you sure you want to pause this subscription?', 'memberpress'); ?>');"><?php _e('Pause', 'memberpress'); ?></a>
                        <?php }?>
                        <div id="mepr-cancel-sub-<?php echo $s->id;?>" class="mepr-white-popup mfp-hide">
                            <div class="mepr-cancel-sub-text">
                                Are you sure you want to cancel this subscription?</div>
                            <div class="mepr-cancel-sub-buttons">
                                <button class="mepr-btn mepr-left-margin mepr-confirm-yes"
                                    data-url="/account/?action=cancel&sub=<?php echo $s->id;?>">Yes</button>
                                <button class="mepr-btn mepr-confirm-no">No</button>
                            </div>
                        </div>
                        <a href="#mepr-cancel-sub-<?php echo $s->id;?>"
                            class="mepr-open-cancel-confirm mepr-account-row-action mepr-account-cancel">Cancel</a>
                        <!--  <a href="<?php //echo "/account/?action=cancel&sub=$s->id"; ?>" class="mepr-open-cancel-confirm mepr-account-row-action mepr-account-cancel" onclick="return confirm('<?php //_e('Are you sure you want to cancel this subscription?', 'memberpress'); ?>');"><?php //_e('Cancel your membership', 'memberpress'); ?></a> -->
                        <?php //echo MeprHooks::apply_filters('mepr_custom_cancel_link', ob_get_clean(), $subscription); ?>
                        <!-- <a href="#">Pause your membership</a> -->
                        <!-- <a href="#mepr-cancel-sub-<?php echo $s->id;?>">Cancel your membership</a> -->
                    </div>
                </li>
                <li>
                    <div class="payment-heading">Payment Method / Credit Card Details</div>

                    <div class="payment-content card_pay"><a
                            href="/account/?action=update&sub=<?php echo $s->id; ?>"><img
                                src="https://www.thefold.online/wp-content/themes/salient/assets/img/card-default-outline.png">Update
                            CC</a> </div>
                </li>
                <li>
                    <div class="payment-heading">Next billing date</div>
                    <div class="payment-content"><?php if($prd->register_price_action != 'hidden'): ?>
                        <span class="mepr-account-terms">
                            <?php
                                if($txn != false && $txn instanceof MeprTransaction && $txn->is_sub_account()) {
                                  MeprHooks::do_action('mepr_account_subscriptions_sub_account_terms', $txn);
                                }
                                else {
                                  if($prd->register_price_action == 'custom' && !empty($prd->register_price)) {
                                    //Add coupon in if one was used eh
                                    $coupon_str = '';
                                    if($is_sub) {
                                      $subscr = new MeprSubscription($s->id);

                                      if($subscr->coupon_id && ($coupon = new MeprCoupon($subscr->coupon_id)) && isset($coupon->ID) && $coupon->ID) {
                                        $coupon_str = ' ' . _x('with coupon', 'ui', 'memberpress') . ' ' . $coupon->post_title;
                                      }
                                    }

                                    echo stripslashes($prd->register_price) . $coupon_str;
                                  }
                                  else if($txn != false && $txn instanceof MeprTransaction) {
                                    //echo $prd->price;
                                    echo MeprTransactionsHelper::format_currency($txn);
                                  }
                                }
                              ?>
                        </span>
                        <?php endif; ?>,
                        <?php if($txn != false && $txn instanceof MeprTransaction && !$txn->is_sub_account && $is_sub && ($nba = $sub->next_billing_at)): ?>
                        <span
                            class="mepr-account-rebill"><?php printf(_x('Next Billing: %s', 'ui', 'memberpress'), MeprAppHelper::format_date($nba)); ?></span>
                        <?php elseif (!$sub->next_billing_at && ($nba = $sub->expires_at) && stripos($sub->expires_at, '0000-00') === false) : ?>

                        <span
                            class="mepr-account-rebill"><?php printf(_x('Expires: %s', 'ui', 'memberpress'), MeprAppHelper::format_date($nba)); ?></span>
                        <?php endif; ?>
                    </div>
                </li>

                <!--<li>-->
                <!--<div class="payment-heading">Payment history</div> -->
                <!--<div class="payment-content"><a href="/new-account/?action=payments">Click here</a> to view or print your payment histroy</div>-->
                <!--</li>-->
            </ul>
        </div>

    </div>
    <?php MeprHooks::do_action('mepr-account-subscriptions-td', $mepr_current_user, $s, $txn, $is_sub); ?>
    <?php endforeach; ?>
    <?php MeprHooks::do_action('mepr-account-subscriptions-table', $mepr_current_user, $subscriptions); ?>

    <div id="mepr-subscriptions-paging">
        <?php if($prev_page): ?>
        <a href="<?php echo "{$account_url}{$delim}currpage={$prev_page}"; ?>">&lt;&lt;
            <?php _ex('Previous Page', 'ui', 'memberpress'); ?></a>
        <?php endif; ?>
        <?php if($next_page): ?>
        <a href="<?php echo "{$account_url}{$delim}currpage={$next_page}"; ?>"
            style="float:right;"><?php _ex('Next Page', 'ui', 'memberpress'); ?> &gt;&gt;</a>
        <?php endif; ?>
    </div>
    <div style="clear:both"></div>
</div>

<?php
}
MeprHooks::do_action('mepr_account_subscriptions', $mepr_current_user);
if (count($subscriptions) ==  0) {?>
<h1>Sorry You dont have any subscription </h1>
<?php
  # code...
}
?>
<!--  -->