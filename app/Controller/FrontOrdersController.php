<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\OrdersModel;
use \Model\BasketModel;
use \W\Security\AuthorizationModel;

class FrontOrdersController extends MasterController 
{

	/**
	 * Liste des commandes de l'utilisateur
	 */
	public function frontListOrders()
	{
		
		$this->showStuff('front/User/listOrders');
	}

	/**
	 * Vue unique d'une commande
	 */
	public function frontViewOrders() 
	{
		$this->showStuff('front/User/viewUserOrder');
	}

	/**
	 * Page choix du mode de paiement
	 */
	public function frontOrderPaie() 
	{
		$this->showStuff('front/Order/orderPayment');
	}
	/**
	 * Page choix de l'adresse de livraison
	 */
	public function frontOrderAddress() 
	{
		$this->showStuff('front/Order/orderAddress');
	}
	/**
	 * Vu unique d'une commande avec possibilité de changer son statut
	 */
/*	public function frontOrderRecap() 
	{
		$this->show('front/Order/orderRecap');
	}
*/	/**
	 * Vu unique d'une commande avec possibilité de changer son statut
	 */
/*	public function frontOrderValid() 
	{
		$this->show('front/Order/orderValidPaie');
	}
*/	/**
	 * Vu du panier de commande
	 */
	public function frontPanier() 
	{	
		$getInfos = new BasketModel;
		$user = $this->getUser();

		$total = $getInfos->getTotal($user['id']);
		$fdp = $getInfos->countFDP($user['id']);

		//Gestion de la quantité des objets
		foreach ($fdp as $value){

		}

		//S'il y a un Custom, on rajoute 6.90
		if(in_array('CustomsPeints', $value) || in_array('PiecesEnResine', $value)){
			$customFDP = 6.90;
		}else{
			$customFDP = 0;
		}

		if($value['somme'] >= 1 && $value['somme'] <= 3 ){
			$finalFDP = $customFDP + 2.50;

		}elseif($value['somme'] >= 4 && $value['somme'] <= 8){
			$finalFDP = $customFDP + 3.90;

		}elseif($value['somme'] > 8){
			$finalFDP = $customFDP + 6.90;
		}

		$data = [
			'total'	=>	$total,
			'fdp'	=>	$finalFDP,
		];
		$this->showStuff('front/Order/orderList', $data);
	}

}