<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\OrdersModel;
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
		$this->showStuff('front/Order/orderList');
	}

}