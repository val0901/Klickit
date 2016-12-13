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
	public function FrontListOrders()
	{
		
		$this->show('front/User/listOrders');
	}

	/**
	 * Vu unique d'une commande avec possibilité de changer son statut
	 */
	public function FrontviewOrders() 
	{
		$this->show('front/User/viewUserOrder');
	}

	/**
	 * Vu unique d'une commande avec possibilité de changer son statut
	 */
	public function FrontorderLivr() 
	{
		$this->show('front/Order/orderLivr');
	}
	/**
	 * Vu unique d'une commande avec possibilité de changer son statut
	 */
	public function orderPaie() 
	{
		$this->show('front/Order/orderMoyPaie');
	}
	/**
	 * Vu unique d'une commande avec possibilité de changer son statut
	 */
	public function orderRecap() 
	{
		$this->show('front/Order/orderRecap');
	}
	/**
	 * Vu unique d'une commande avec possibilité de changer son statut
	 */
	public function orderValid() 
	{
		$this->show('front/Order/orderValidPaie');
	}
	/**
	 * Vu unique d'une commande avec possibilité de changer son statut
	 */
	public function panier() 
	{
		$this->show('front/User/viewUserOrder');
	}

}