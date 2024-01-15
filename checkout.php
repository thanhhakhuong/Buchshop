<?php

    require('stripe-php-master/init.php');

    $nameArr = $_POST["name"];
    $quantityArr = $_POST["quantity"];
    $amountArr = $_POST["amount"];

    $len = count($nameArr);

    $cart = [];

    for ($i = 0; $i < $len; $i++) {
        $prod = [
            'price_data' => [
                'currency' => 'eur',
                'unit_amount' => $amountArr[$i] * 100,
                'product_data' => [
                  'name' => $nameArr[$i],
                ],
            ],
            'quantity' => $quantityArr[$i],
        ];
        array_push($cart, $prod);
    }

    $currency = 'eur';

    $public_key_for_js ="1" ;
    $live = 0 ;

    // Definition der Stripe-Account-Keys
    if( $live == 1  ) {
        // Secret Key des Grosshändlers
        \Stripe\Stripe::setApiKey('sk_test_cFnCai0Ye9NM8Tn9CMo6k0fn00P0R9pt9u');
        $public_key_for_js="pk_test_aLcPqdtG2FDzxPWu5N9OBNOs00Yt0nKnhS"; 
    } else {
        \Stripe\Stripe::setApiKey('sk_test_51MH8UqCWDWwFZNjFQhegSBybJ2sQhiitGYXbgU9i5zRjLwxFA0TVMgyrhGACkOEjUIssgYp9lEktCOJ4RqbYzass00aqJ0WUYF');
        $public_key_for_js="pk_test_51MH8UqCWDWwFZNjFCN8WCEDs7YvRd667PJyFQv9jAtBuSioUJiKWETPidzxUfmMULsMe4SuR0vQNhFpHUA6dsWbn00ZMH91ezx";  // PK  G16 
    } 

    try {
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [$cart],
                'mode' => 'payment',
            'success_url' => 'https://ivm108.informatik.htw-dresden.de/ewa/g16/beleg/' . 'success.php?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => 'https://ivm108.informatik.htw-dresden.de/ewa/g16/beleg/' . 'cancel.php?session_id={CHECKOUT_SESSION_ID}',
        ]);
    } catch (\Stripe\Exception\ApiErrorException $e) {
        echo "Error in Session::create()" . $e;
    }

    header("HTTP/1.1 303 See Other");
    header("Location: " . $session->url);
?>