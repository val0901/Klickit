<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\OrdersModel;
use \Model\ItemModel;
use \Model\BasketModel;
use \Model\UserModel;
use \W\Security\AuthorizationModel;
use \PayPal\Rest\ApiContext as APIContext;
use \PayPal\Auth\OAuthTokenCredential as TokenCredential;
use PayPal\Api\Amount; 
use PayPal\Api\Details; 
use PayPal\Api\ExecutePayment; 
use PayPal\Api\Payment; 
use PayPal\Api\PaymentExecution; 
use PayPal\Api\Transaction;
use PayPal\Api\Address; 
use PayPal\Api\BillingInfo; 
use PayPal\Api\Cost; 
use PayPal\Api\Currency; 
use PayPal\Api\Invoice; 
use PayPal\Api\InvoiceAddress; 
use PayPal\Api\InvoiceItem; 
use PayPal\Api\MerchantInfo; 
use PayPal\Api\PaymentTerm; 
use PayPal\Api\Phone; 
use PayPal\Api\ShippingInfo;

class FrontOrdersController extends MasterController 
{

	/**
	 * Liste des commandes de l'utilisateur
	 */
	public function frontListOrders()
	{
		
		$show = new OrdersModel;
		$user = $this->getUser();

		$orders = $show->showOrders($user['id']);

		$data = [
			'orders' => $orders,
		];

		if(!empty($this->getUser())){
			$this->showStuff('front/User/listOrders', $data);
		}
		else {
			$this->redirectToRoute('login');
		}
	}

	/**
	 * Vue unique d'une commande
	 */
	public function frontViewOrders($id) 
	{	
		$data = [];
		$show = new OrdersModel();
		$find = new UserModel;
		$user = $this->getUser();

		if(!is_numeric($id) || empty($id)){
			$this->showNotFound();

		}elseif(empty($show->findOrderByID($user['id'], $id))){
			$this->showNotFound();
		}else{
			$order = $show->findOrderByID($user['id'], $id);

			$get = new ItemModel;
			$user_data = $find->findUser($user['id']);			
							
			$data = [
				'user'	=> $user_data,
				'get'	=> $get,
				'order' => $order
			];
		}	

		if(!empty($this->getUser())){
			$this->showStuff('front/User/viewUserOrder', $data);
		}
		else {
			$this->redirectToRoute('login');
		}
	}

	/**
	 * Page choix du mode de paiement
	 */
	public function frontOrderPaie() 
	{
		$process = new OrdersModel;
		$user = $this->getUser();

		$order_process = $process->processOrder($user['id']);

		$data = [
			'order' => $order_process,
		];

		if(!empty($this->getUser())){
			if($process->processOrder($user['id'])){
				$this->showStuff('front/Order/orderPayment', $data);
			}
			else{
				// $this->redirectToRoute('front_index');
				$this->showStuff('front/Order/orderPayment', $data);
			}
		}
		else {
			$this->redirectToRoute('login');
		}
	}
	/**
	 * Page choix de l'adresse de livraison
	 */
	public function frontOrderAddress() 
	{
		$process = new OrdersModel;
		$user = $this->getUser();

		$order_process = $process->processOrder($user['id']);

		$data = [
			'order' => $order_process,
		];

		if(!empty($this->getUser())){
			if($process->processOrder($user['id'])){
				$this->showStuff('front/Order/orderAddress', $data);
			}
			else{
				$this->redirectToRoute('front_index');
			}
		}
		else {
			$this->redirectToRoute('login');
		}
	}

	/**
	 * Vu du panier de commande
	 */
	public function frontPanier() 
	{	
		$getInfos = new BasketModel;
		$user = $this->getUser();

		$process = new OrdersModel;
		$order_process = $process->processOrder($user['id']);

		$country = new BasketModel;
		$selectForCountry = $country->selectCountry($user['id']);

		$quantity = new BasketModel;
		$selectAllQuantity = $quantity->selectQuantity($user['id']);

		$total = $getInfos->getTotal($user['id']);
		$fdp = $getInfos->countFDP($user['id']);
		$sub = $getInfos->sub_categoryFDP($user['id']);

		$getBasket = new BasketModel;

		$finalFDP = '';

		//Gestion des sous-catégories
		$subCat = '';
		foreach ($sub as $category) {
				$subCat.= $category['sub_category'].', ';
		}

		$arraySub_category = explode(', ', substr($subCat, 0, -2));

		//S'il y a un Custom, on rajoute 6.90
		if(in_array('CustomsPeints', $arraySub_category) || in_array('PiecesEnResine', $arraySub_category)){
			$customFDP = 6.90;
		}else{
			$customFDP = 0;
		}

		if($fdp['somme'] >= 1 && $fdp['somme'] <= 3 ){
			$finalFDP = $customFDP + 2.50;

		}elseif($fdp['somme'] >= 4 && $fdp['somme'] <= 8){
			$finalFDP = $customFDP + 3.90;

		}elseif($fdp['somme'] > 8){
			$finalFDP = $customFDP + 6.90;
		}

		$data = [
			'total'	   => $total,
			'fdp'	   => $finalFDP,
			'order'    => $order_process,
			'country'  => $selectForCountry,
			'quantity' => $selectAllQuantity,
		];
		if(!empty($this->getUser())){
			if(!empty($getBasket->getShoppingCartItem($user['id']))){
				$this->showStuff('front/Order/orderList', $data);	
			}
			else{
				$this->redirectToRoute('front_affcptuser', ['id' => $user['id']]);
			}
		}
		else {
			$this->redirectToRoute('login');
		}
	}

	/**
	 * Vue pdf d'une commande
	 */
	public function frontpdfOrders($id) 
	{	
		$data = [];
		$show = new OrdersModel();
		$find = new UserModel;
		$user = $this->getUser();

		if(!is_numeric($id) || empty($id)){
			$this->showNotFound();

		}elseif(empty($show->findOrderByID($user['id'], $id))){
			$this->showNotFound();
		}else{
			$order = $show->findOrderByID($user['id'], $id);

			$get = new ItemModel;
			$user_data = $find->findUser($user['id']);			
							
			$data = [
				'user'	=> $user_data,
				'get'	=> $get,
				'order' => $order
			];
		}	

		$this->showStuff('front/User/pdfOrder', $data);
	}

	//Page de réussite après paiement
	public function pay()
	{		

		$getOrder = new UserModel;
		$getIdOrder = new OrdersModel;
		$user = $this->getUser();
		$data = [];
		$get = new ItemModel;

		//On récupère la commande terminée de l'utilisateur
		$getOrderByID = $getOrder->getCurrentOrderById($user['id']);
		$current_order = end($getOrderByID);

		$idOrders = $getIdOrder->getOrderByIdMember($user['id']);
		$current_orderID = end($idOrders);

		//var_dump($current_orderID);

		$paypal = new APIContext(
			new TokenCredential(
				'Ac7zciJxbLPkLZS_B42CXjunY2-l7-HwXQ4bOYMrLdVEGsaLezI7x6X3hfLjLXhjbGjDxPOUhrhH2C0p',
				'EFSWbLVH2RRDm-EwAAgKe7Ondurs3_bh3FmYbWLhCyYoJQAsPTP4R6B0uNgRb5kTmW2CbDcRsIhtkt2h')
			);

		if(isset($_GET['paymentId'], $_GET['PayerID'], $_GET['success'])){
			
			if($_GET['success'] == 'true'){

				//On prépare l'exécution du paiement
				$paymentId = $_GET['paymentId'];
				$payment = Payment::get($paymentId, $paypal);

				$PayerID = $_GET['PayerID'];
				$execution = new PaymentExecution;
				$execution->setPayerId($PayerID);

				//On prépare la facture paypal
				// $invoice = new Invoice;
				// $invoice->setMerchantInfo(new MerchantInfo)->setBillingInfo([new BillingInfo])->setNote('Votre facture')->setPaymentTerm(new PaymentTerm)->setShippingInfo(new ShippingInfo);

				// $invoice->getMerchantInfo()->setEmail('sav@klickit.fr')->setFirstName('Laurent')->setLastName('Lafont')->setBusinessName('Klickit')->setPhone(new Phone)->setAddress(new Address);

				// $invoice->getMerchantInfo()->getPhone()->setCountryCode('033')->setNationalNumber('611821771');

				// $invoice->getMerchantInfo()->getAddress()->setLine1('1, résidence beau pré')->setCity('Saucats')->setPostalCode('33650')->setCountryCode('FR');

				// $billing = $invoice->getBillingInfo();
				// $billing[0]->setEmail($current_order['email']);

				// $billing[0]->setBusinessName($current_order['firstname'].' '.$current_order['lastname'])->setAdditionalInfo('Votre facture détaillée')->setAddress(new InvoiceAddress);

				// $billing[0]->getAddress()->setLine1($user['adress'])->setCity($user['city'])->setPostalCode($user['zipcode'])->setCountryCode($current_order['country']);

				// $items = [];
				// $content = explode(', ', $current_order['contenu']);
				// $quantity = explode(', ', $current_order['quantity']);
				// $i = 0;

				// foreach($content as $key => $value){
				// 	$qte = $quantity[$key];

				// 	$item_property = $get->findItemsForAPI($value);

				// 	$items[$i] = new InvoiceItem;

				// 	$items[$i]->setName($item_property['name'])->setQuantity($qte)->setUnitPrice(new Currency);

				// 	if($item_property['newPrice'] == 0){
				// 		$items[$i]->getUnitPrice()->setCurrency('EU')->setValue($item_property['price']);
				// 	}elseif($item_property['newPrice'] > 0){
				// 		$items[$i]->getUnitPrice()->setCurrency('EU')->setValue($item_property['newPrice']);
				// 	}
					
				// 	$i++;	
					
				// }
				
				// $invoice->setItems($items);

				// $invoice->getPaymentTerm()->setTermType('NET_45');

				// $invoice->getShippingInfo()->setFirstName($current_order['firstname'])->setLastName($current_order['lastname'])->setBusinessName('Not applicable')->setAddress(new InvoiceAddress);

				// $invoice->getShippingInfo()->getAddress()->setLine1($current_order['address'])->setCity($current_order['city'])->setPostalCode($current_order['zipcode'])->setCountryCode($current_order['country']);

				// $invoice->setLogoUrl('https://www.paypalobjects.com/webstatic/i/logo/rebrand/ppcom.svg');

				// var_dump($invoice);


				try {

					$result = $payment->execute($execution, $paypal); //execution du paiement
					
					//$invoice->create($paypal);
					// $number = Invoice::generateNumber($paypal);
					// $sendStatus = $invoice->send($paypal);
					// $invoice = Invoice::get($number, $paypal);


				} catch (PayPal\Exception\PayPalConnectionException $e) {

					//var_dump($e->getCode());
					//var_dump($e->getData());
					die($e);

				} catch (Exception $e) {

					die($e);
				}

			}

			$data = [
				'user'		=> $user,
				'get'		=> $get,
				'order' 	=> $current_order,
				'idOrder'	=> $current_orderID,
			];

			$this->showStuff('front/Order/pay', $data);
			//var_dump($payment);
		}	
		

	}

}