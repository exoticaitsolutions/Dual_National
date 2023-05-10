<?php if ( ! defined( 'ABSPATH' ) ) {
  die( 'You are not allowed to call this page directly.' );}

  $mepr_coupon_code = $coupon && isset($coupon->ID) ? $coupon->post_title : '';
// echo '<pre>'; print_r($invoice);
  // $coupon_code = '';
  // if($coupon && isset($coupon->ID)) {
  //   $coupon_code = $coupon->post_title;
  // }
?>

<div class="mp_wrapper mp_invoice dd 56">
  <?php 
$get_url = $_GET['membership'];
//echo $get_url;
	if($$get_url == 'free-membership'){ ?>
	<script>jQuery('.names_memberhip').text('Free Membership – Subscription Payment');</script>
	<?php
}
if ( isset( $sub_price_str ) ) : ?>
  <div class="mp_price_str r">
    <strong><?php _ex( 'Terms:', 'ui', 'memberpress' ); ?></strong> $<?php echo $invoice['items']['0']['amount']; ?>/ Month
  </div>
  <div class="mp-spacer"> </div>
  <?php endif; ?>
   <table class="mp-table 45">

    <tbody>
      <?php foreach ( $invoice['items'] as $item ) : ?>
      <tr>
        <td>
          
        </td>
        <td class="name_membership">
          <p class="names_memberhip"><?php echo str_replace(MeprProductsHelper::renewal_str($prd), '', $item['description']); ?></p>
          <!-- <p class="desc 435"><?php// MeprProductsHelper::display_invoice( $prd, $mepr_coupon_code ); ?></p> -->
          <p class="desc 435">$<?php echo $invoice['items']['0']['amount']; ?>/ Month</p>
			
        </td>
        <?php if ( $show_quantity ) : ?>
        <td><?php echo $item['quantity']; ?></td>
        <?php endif; ?>
        <td class="mp-currency-cell 1"><?php echo MeprAppHelper::format_currency( $item['amount'], true, false ); ?></td>
		  
		  
      </tr>
      <?php endforeach; ?>
      <?php if ( isset( $invoice['coupon'] ) && ! empty( $invoice['coupon'] ) && $invoice['coupon']['id'] != 0 ) : ?>
      <tr>
        <td></td>
        <td>
          <?php echo $invoice['coupon']['desc']; ?>
        </td>
        <?php if ( $show_quantity ) : ?>
        <td> </td>
        <?php endif; ?>
        <td class="mp-currency-cell 2">
          -<?php echo MeprAppHelper::format_currency( $invoice['coupon']['amount'], true, false ); ?></td>
      </tr>
      <?php endif; ?>
    </tbody>
    <tfoot>
      <?php if ( $invoice['tax']['amount'] > 0.00 || $invoice['tax']['percent'] > 0 ) : ?>
      <tr>
        <th></th>
        <?php if ( $show_quantity ) : ?>
        <th> </th>
        <?php endif; ?>
        <th class="bb"><?php _ex( 'Sub-Total', 'ui', 'memberpress' ); ?></th>
        <th class="mp-currency-cell bb"><?php echo MeprAppHelper::format_currency( $subtotal, true, false ); ?></th>
      </tr>
      <tr>
        <th></th>
        <?php if ( $show_quantity ) : ?>
        <th> </th>
        <?php endif; ?>
        <th class="mepr-tax-invoice">
          <?php echo MeprUtils::format_tax_percent_for_display( $invoice['tax']['percent'] ) . '% ' . $invoice['tax']['type']; ?>
        </th>
        <th class="mp-currency-cell 3">
          <?php echo MeprAppHelper::format_currency( $invoice['tax']['amount'], true, false ); ?></th>
      </tr>
      <?php endif; ?>
      <tr>
        <th></th>
        <?php if ( $show_quantity ) : ?>
        <th> </th>
        <?php endif; ?>
        <th class="bt"><?php _ex( 'Total', 'ui', 'memberpress' ); ?></th>
        <th class="mp-currency-cell bt total_cell"><?php echo MeprAppHelper::format_currency( $total, true, false ); ?>
        </th>
        <input type="hidden" name="mepr_stripe_txn_amount"
          value="<?php echo MeprUtils::format_stripe_currency( $total ); ?>" />
      </tr>
    </tfoot>
  </table>
</div>