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
use PayPal\Api\ExecutePayment; 
use PayPal\Api\Payment; 
use PayPal\Api\PaymentExecution; 


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

		$finalFDP = 0;

		//Gestion des sous-catégories
		$subCat = '';
		foreach ($sub as $category) {
				$subCat.= $category['sub_category'].', ';
		}

		$arraySub_category = explode(', ', substr($subCat, 0, -2));

		if($selectForCountry['0']['country'] == 'FR'){
			//S'il y a un Custom, on rajoute 6.90
			if(in_array('CustomsPeints', $arraySub_category) || in_array('PiecesEnResine', $arraySub_category)){
				$customFDP = 6.90;
			}else{
				$customFDP = 0;
			}

			if($customFDP === 0){
				if($fdp['somme'] >= 1 && $fdp['somme'] <= 3 ){
					$finalFDP = 2.50;

				}elseif($fdp['somme'] >= 4 && $fdp['somme'] <= 8){
					$finalFDP = 3.90;

				}elseif($fdp['somme'] > 8){
					$finalFDP = 6.90;
				}
			}
			elseif($customFDP === 6.90){
				$finalFDP = 6.90;
			}
		} // Mettre autant de condition que de pays pour gérer des frais de port propre à chaque pays 

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

		if(!empty($this->getUser())){
			$this->showStuff('front/User/pdfOrder', $data);
		}
		else {
			$this->redirectToRoute('login');
		}
	}

	//Page de réussite après paiement
	public function pay()
	{		
		$getOrder = new UserModel;
		$getIdOrder = new OrdersModel;
		$deleteBasket = new BasketModel;
		$user = $this->getUser();
		$get = new ItemModel;

		$data = [
			'user' => $user,
			'get'  => $get,
		];

		if($_GET['success'] == 'true'){
			if($getIdOrder->updatePaymentOrder($user['id'], 'paypal')){
				$deleteBasket->deleteAllBasket($user['id']);
				//On récupère la commande terminée de l'utilisateur
				$getOrderByID = $getOrder->getCurrentOrderById($user['id']);
				$current_order = end($getOrderByID);
				$data['order'] = $current_order;

				$idOrders = $getIdOrder->getOrderByIdMember($user['id']);
				$current_orderID = end($idOrders);
				$data['idOrder'] = $current_orderID;

				//var_dump($current_orderID);
			}
		}

		$paypal = new APIContext(
			new TokenCredential(
				'AQntTHlOr7-Wnh6oA0oW2153NxSDBAgB7gwHmh--TlHZuYaBkMfIJSHyF_fCy6wNY4LW_VX64t-AiSz9','EJt5WsZg-jQRQ2pQdZVauU-IvhxWcK6UvdD6MkkeLm8TN729XTXevzJ6kyK4DP2Roe8GLz4si9EXsSHm')
			);

		if(isset($_GET['paymentId'], $_GET['PayerID'], $_GET['success'])){
			
			if($_GET['success'] == 'true'){

				//On prépare l'exécution du paiement
				$paymentId = $_GET['paymentId'];
				$payment = Payment::get($paymentId, $paypal);

				$PayerID = $_GET['PayerID'];
				$execution = new PaymentExecution;
				$execution->setPayerId($PayerID);

				try {

					$result = $payment->execute($execution, $paypal); //execution du paiement


				} catch (PayPal\Exception\PayPalConnectionException $e) {

					$this->redirectToRoute('front_affcptuser', ['id' => $user['id']]);
					die($e);

				} catch (Exception $e) {

					$this->redirectToRoute('front_affcptuser', ['id' => $user['id']]);
					die($e);
				}

			}
		}

		if(!empty($this->getUser())){
			$this->showStuff('front/Order/pay', $data);
		}
		else {
			$this->redirectToRoute('login');
		}
	}

	//Page de réussite après paiment par chèque ou virement
	public function payNoPayPal()
	{
		$getOrder = new UserModel;
		$getIdOrder = new OrdersModel;
		$user = $this->getUser();
		$data = [];
		$get = new ItemModel;

		$getOrderByID = $getOrder->getCurrentOrderById($user['id']);
		$current_order = end($getOrderByID);

		$idOrders = $getIdOrder->getOrderByIdMember($user['id']);
		$current_orderID = end($idOrders);

		$data = [
				'user'		=> $user,
				'get'		=> $get,
				'order' 	=> $current_order,
				'idOrder'	=> $current_orderID,
			];

		if(!empty($this->getUser())){
			$this->showStuff('front/Order/payNoPayPal', $data);
		}
		else {
			$this->redirectToRoute('login');
		}
	}

}