<?php

use \PayPal\Rest\ApiContext as APIContext;
use \PayPal\Auth\OAuthTokenCredential as TokenCredential;
use \PayPal\Api\Payment;
use \PayPal\Api\PaymentExecution;

$paypal = new APIContext(
			new TokenCredential(
				'AbZj79OCZKQQW7fUqhkL5oEqwQelg8KnLSkgRfceq4s33OAssaIge9dxeS--Cy-pS5uDXHqBthIjugS5',
				'EPF9t-DUzYMQmXG9eXhiDDLTGFNUpAC05WQMYyW-ho-dxC4VLlcpKVCEFXQ72IYbRh9qW3bBC7dWKhd8')
			);

		if(isset($_GET['paymentId'], $_GET['PayerID'], $_GET['success'])){

			if($_GET['success'] == true){

				$paymentId = $_GET['paymentId'];
				$PayerID = $_GET['PayerID'];

				$payment = Payment::get($paymentId, $paypal);

				$execute = new PaymentExecution;
				$execute->setPayerId($PayerID);

				try {
					$result = $payment->execute($execute, $paypal);
				} catch (Exception $e) {
					$data = json_decode($e->getData());
					echo $data->message;
					
				}
			}elseif($_GET['success'] == false){
				
			}	
		}	

?>

<?php $this->layout('layoutfront', ['title' => 'Paiement réussi']) ?>

<?php $this->start('main_content') ?>
Page succès.
<?php $this->stop('main_content') ?>