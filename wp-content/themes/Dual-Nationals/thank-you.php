<?php /* Template Name: Thank-you */ 
get_header();
?>
<div class="mepr-signup-form mepr-form">
  <div class="mepr-checkout-container thankyou mp_wrapper alignwide">

  
  <div class="invoice-wrapper thankyou">
    <h2 class="">Thank you for your purchase</h2>


        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>

    <div class="mepr-order-no">
    <p class="">Payment Successful</p>
    <p class="">
    Order:           </p>

    </div>

    <div class="mp-form-row mepr_bold mepr_price">
    <div class="mepr_price_cell invoice-amount">

            Free    </div>
    </div>
<div class="mp_wrapper mp_invoice">
    <table class="mp-table">

    <tbody>
            <tr>
        <td>
          <img src="<?php echo get_site_url(); ?>/wp-content/plugins/memberpress/images/checkout/product.png">
        </td>
        <td>
          <p>&nbsp;–&nbsp;Payment</p>
          <p class="desc">Free</p>
        </td>
                <td class="mp-currency-cell">$0.00</td>
      </tr>
                </tbody>
    <tfoot>
            <tr>
        <th></th>
                <th class="bt">Total</th>
        <th class="mp-currency-cell bt total_cell">$0.00        </th>
        <input type="hidden" name="mepr_stripe_txn_amount" value="0" autocomplete="on">
      </tr>
    </tfoot>
  </table>
</div>
    
    

    <p>
    <a href="<?php echo get_site_url(); ?>">Back to home</a>
    </p>

  </div>

  </div>
</div>
<?php get_footer(); ?>
