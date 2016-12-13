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
		
		$this->show('front/User/listOrders', $data);
	}

	/**
	 * Vu unique d'une commande avec possibilité de changer son statut
	 */
	public function FrontviewOrders() 
	{
		$this->show('front/Orders/updateOrders');
	}

}