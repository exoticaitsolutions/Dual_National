<?php if ( ! defined( 'ABSPATH' ) ) {
  die( 'You are not allowed to call this page directly.' );
}
// $api = new MeprApi();

global $wpdb;
$transaction_id = $_REQUEST['transaction_id'];
$subscription_id = $_REQUEST['subscription_id'];
if(isset($transaction_id ) && isset($subscription_id)){
  $table = $wpdb->prefix.'mepr_transactions';
  $table_name = $wpdb->prefix.'mepr_subscriptions';
  $trnasection_data = $wpdb->get_row("SELECT * FROM  $table WHERE `ID` = '".$transaction_id."'");
  $subscription_id_data = $wpdb->get_row("SELECT * FROM  $table_name WHERE `ID` = '".$subscription_id."'");
  if($trnasection_data ||$subscription_id_data){
    //echo '<pre>'; print_r($trnasection_data);die;
    $wpdb->query($wpdb->prepare("UPDATE $table SET status='complete' WHERE id=$transaction_id"));
    $wpdb->query($wpdb->prepare("UPDATE $table_name SET status='active' WHERE id=$subscription_id"));
  }
  $transaction_id_oid =  $txn->id;
}else{
  // echo "Asdsadsad";die;
  $user_ID = get_current_user_id(); 
  $membership_id = $_REQUEST['membership_id'];

  if(isset($membership_id)){
    $table_name = $wpdb->prefix.'mepr_transactions';
    $subscription_id_data = $wpdb->get_row("SELECT * FROM  $table_name WHERE `user_id` = '".$user_ID."' AND `product_id` = '".$membership_id."' OR `status` = 'confirmed'");
    $transaction_id_oid =  $subscription_id_data->id;
    // 

  }

}


?>


<section class="thank_you py_8">
        <div class="container">
          <div class="thank_you_bx">
            <div class="thank_you_cntnt">
				<div class="confirm_imag">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/check-.png">
				</div>
              <div class="thank_you_cntnt_txt">
                <h1>Thank You For Your Purchase</h1>
<!--                 <p>Payment Successful Order</p> -->
				  <!-- <p class="oredr_id">
					   <?php// _ex( 'Order: ', 'ui', 'memberpress' ); echo $txn->trans_num;
    ?>
				  </p> -->
				
				  <div class="mepr-order-no">
    <p class=""><?php _ex( 'Payment Successful', 'ui', 'memberpress' ); ?></p>
              </div>
            </div>
 </div>
    <?php if($hide_invoice) : ?>

      <?php echo $invoice_message ?>

    <?php else : ?>
   
  
    <?php
    $txn = new MeprTransaction( $transaction_id_oid);

    echo MeprTransactionsHelper::get_invoice( $txn );
    ?>

    <?php

    if ( class_exists( 'MePdfInvoicesCtrl' ) ) {
      ?>
    <a class="mepr-invoice-print mepr-button" href="
      <?php
        echo MeprUtils::admin_url(
          'admin-ajax.php',
          array( 'download_invoice', 'mepr_invoices_nonce' ),
          array(
            'action' => 'mepr_download_invoice',
            'txn'    => $txn->id,
          )
        );
      ?>
        " target="_blank">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
      class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round"
      d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
    </svg>

      <?php echo esc_html_x( 'Print', 'ui', 'memberpress-pdf-invoice', 'memberpress' ); ?>
    </a>
      <?php
    }

    ?>


    <?php endif ?>


    <div class="back_to_home text-center">
            <a href="<?php echo site_url();?>"
              >Back To Home <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow_back.png" alt=""
            /></a>
          </div>

 

	</div>
<?php
if(isset($_REQUEST['membership'])){
  ?>
<!-- <P> Subscription Type <?php //echo $_REQUEST['membership'];?></P>
<P>Price <?php //echo $subscription_id_data->price;?></P>
<P> Total <?php //echo $subscription_id_data->total;?></P> -->
<?php
}

?>
	
</section>