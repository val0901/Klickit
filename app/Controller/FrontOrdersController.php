<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\OrdersModel;
use \W\Security\AuthorizationModel;

class FrontOrdersController extends Controller 
{

	/**
	 * Liste des commandes de l'utilisateur
	 */
	public function frontListOrders()
	{
		
		$this->show('front/User/listOrders');
	}

	/**
	 * Vu unique d'une commande avec possibilité de changer son statut
	 */
	public function frontViewOrders() 
	{
		$this->show('front/User/viewUserOrder');
	}

	/**
	 * Vu unique d'une commande avec possibilité de changer son statut
	 */
	public function frontOrderLivr() 
	{
		$this->show('front/Order/orderLivr');
	}
	/**
	 * Vu unique d'une commande avec possibilité de changer son statut
	 */
	public function frontOrderPaie() 
	{
		$this->show('front/Order/orderMoyPaie');
	}
	/**
	 * Vu unique d'une commande avec possibilité de changer son statut
	 */
	public function frontOrderRecap() 
	{
		$this->show('front/Order/orderRecap');
	}
	/**
	 * Vu unique d'une commande avec possibilité de changer son statut
	 */
	public function frontOrderValid() 
	{
		$this->show('front/Order/orderValidPaie');
	}
	/**
	 * Vu unique d'une commande avec possibilité de changer son statut
	 */
	public function frontPanier() 
	{
		$this->show('front/Order/panier');
	}

}