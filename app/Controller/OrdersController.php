<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\OrdersModel;
use \W\Security\AuthorizationModel;

class OrdersController extends Controller 
{

/***************** BACK *****************/	
	/**
	 * Liste des commandes
	 */
	public function listOrders()
	{
		$orders = new OrdersModel();
				$list_orders = $orders->findAllOrders();

				$data = [
					'data'	=> $list_orders,
				];
				
				if(!empty($_SESSION)){

					$this->show('back/Orders/listOrders', $data);

					if($_SESSION['role'] == 'Utilisateur') {
						$this->redirectToRoute('front_index');
					}
				}
				else {
					$this->redirectToRoute('back_login');
				}
	}

	/**
	 * Vu unique d'une commande avec possibilité de changer son statut
	 */
	public function viewOrders() 
	{
		$this->show('back/Orders/updateOrders');
	}

/***************** FRONT *****************/	

	/**
	 * Liste des commandes
	 */
	public function listUserOrders()
	{
		$this->show('front/User/listUserCde');
	}

}