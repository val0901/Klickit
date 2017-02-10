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
		$user = $this->getUser();
		$data = [];
		$get = new ItemModel;

		$getOrderByID = $getOrder->getCurrentOrderById($user['id']);
		$current_order = end($getOrderByID);


		$paypal = new APIContext(
			new TokenCredential(
				'Ac7zciJxbLPkLZS_B42CXjunY2-l7-HwXQ4bOYMrLdVEGsaLezI7x6X3hfLjLXhjbGjDxPOUhrhH2C0p',
				'EFSWbLVH2RRDm-EwAAgKe7Ondurs3_bh3FmYbWLhCyYoJQAsPTP4R6B0uNgRb5kTmW2CbDcRsIhtkt2h')
			);

		if(isset($_GET['paymentId'], $_GET['PayerID'], $_GET['success'])){
			
			if($_GET['success'] == 'true'){

				$paymentId = $_GET['paymentId'];
				$payment = Payment::get($paymentId, $paypal);

				$PayerID = $_GET['PayerID'];
				$execution = new PaymentExecution;
				$execution->setPayerId($PayerID);		

				try {

					$result = $payment->execute($execution, $paypal);
					var_dump($result);

				} catch (PayPal\Exception\PayPalConnectionException $e) {

					//var_dump($e->getCode());
					var_dump($e->getData());
					die($e);

				} catch (Exception $e) {
					die($e);
				}

			}

			$data = [
				'user'	=> $user,
				'get'	=> $get,
				'order' => $current_order,
			];

			$this->showStuff('front/Order/pay', $data);
			//var_dump($payment);
		}	
		

	}

}