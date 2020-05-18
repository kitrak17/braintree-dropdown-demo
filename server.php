<?php
require 'vendor/autoload.php';


$gateway = new Braintree_Gateway([
    'environment' => 'sandbox',
    'merchantId' => '6dbmtzfrhrty9sd8',
    'publicKey' => '8qvhrwz6fm24dym2',
    'privateKey' => 'e2339cba40a7ff9f74a5e67c269014c7'
]);

$request_body = file_get_contents('php://input');
$data = json_decode($request_body,true);


try {
  $result = $gateway->transaction()->sale([
	  'amount' => '201.00',
	  'descriptor' => [
	  'name' => 'company name*myurl.com'
	],
	'customFields' => [
		'donation_name' => $data['donation']
	],
	  'paymentMethodNonce' => $data['nonce'],
	  'options' => [
	    'submitForSettlement' => True
	  ]
	]);
			if ($result->success) {
			  //$json = explode('\u0000', json_encode((array)$result->transaction));
			  $my_array = (array)$result->transaction;
			  $json = reset($my_array);
			  echo json_encode($json);
			} else {
			  print_r("Error Message: " . $result);
			}
} catch (Braintree_Exception_NotFound $e) {
	echo $e->getMessage();
}
?>