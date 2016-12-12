<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\OrdersModel;
use \W\Security\AuthorizationModel;

class OrdersController extends Controller 
{
	public function listOrders()
	{
		$this->show('back/Orders/listOrders');
	}

	public function viewOrders() // Permettra aussi de changer le statut de la commande
	{
		$this->show('back/Orders/updateOrders');
	}
}