<?php require_once('stripe/init.php');

// Test key
/* $stripe = array(
  "secret_key"      => "sk_test_mvZfEyCOMc6S0RwYzd60d9PY",
  "publishable_key" => "pk_test_Gt7pJsS2jkETgWvVW5jZwpE8"
); */

// Live key
$stripe = array(
  "secret_key"      => "sk_live_MDIqVyV92NLtzpkfa3P9RnRb",
  "publishable_key" => "pk_live_Vr1uq68wVPVwxKZwEsuUqkt0"
);
\Stripe\Stripe::setApiKey($stripe['secret_key']);