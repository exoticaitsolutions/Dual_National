<?php /* Template Name: TEst home page */
require_once __DIR__ . '/vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51Mj4tXDk7jBZtOXLrFOw37wL30SHUmTpERQU51FFQz6vpVFrUtAP37BBXgdeMCmqmxUYLrGOlPvMok64gGai83AI001ao9l3BO');
$current_user_id = get_current_user_id();
$customer_id = get_user_meta($current_user_id, '_mepr_stripe_customer_id_rsdmbz-6ln_test_USD', true);
$payment_sources = \Stripe\PaymentMethod::all([
  'customer' => $customer_id,
  'type' => 'card',
]);

echo $payment_sources->data[0]->card->last4;


 

