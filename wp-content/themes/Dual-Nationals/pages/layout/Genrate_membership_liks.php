<div class="col-md-4 mb-3">
    <div class="profiel_details_crd">
        <h6>Membership</h6>
        <?php if(!empty($subscriptions)) {
  $alt = false;
  foreach($subscriptions as $s){
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
        <span
            class="data_access"><?php echo MeprHooks::apply_filters('mepr-account-subscr-product-name', $prd->post_title, $txn); ?></span>
            

        <?php } }else{?>
        <p>You dont have any membership</p>
        <?php
     }
    ?>

    </div>
</div>