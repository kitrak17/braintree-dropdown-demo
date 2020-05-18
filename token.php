<?php
require 'vendor/autoload.php';

$gateway = new Braintree_Gateway([
'environment' => 'sandbox',
    'merchantId' => '6dbmtzfrhrty9sd8',
    'publicKey' => '8qvhrwz6fm24dym2',
    'privateKey' => 'e2339cba40a7ff9f74a5e67c269014c7'
]);

$clientToken = $gateway->clientToken()->generate();
echo $clientToken;
?>
