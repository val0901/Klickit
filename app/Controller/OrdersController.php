<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\OrdersModel;
use \Model\ItemModel;
use \W\Security\AuthorizationModel;

class OrdersController extends Controller 
{

/***************** BACK *****************/	
	/**
	 * Liste des commandes
	 */
	public function listOrders()
	{
		
		// On instancie le nombre de nb de lignes ds la table
		$nbpage= new OrdersModel();
			$nb=$nbpage->countResults();

		// on definit les variables, page courante et nb de lignes affichées
		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 15;

		$orders = new OrdersModel();
		$list_orders = $orders->findAllOrders($page, $max);

		$items = new ItemModel();


		/***********ENVOI DES DONNEES POUR AFFICHER LA PAGE***********/
			$data = [
				'orders'	=> $list_orders,
				'items' => $items,
				'max' => $max,
				'page' => $page,
				'nb' => $nb,
			];
				
		//Sécurisation de la page		
		if(!empty($this->getUser())){
			if ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
			else {
				$this->show('back/Orders/listOrders', $data);
			}
		}
		else {
			$this->redirectToRoute('login');
		}
	}

	/**
	 * Vu unique d'une commande avec possibilité de changer son statut
	 */
	public function viewOrders($id) 
	{
		if(!is_numeric($id) || empty($id)){
			$this->showNotFound();
		}else{
			$affiche = new OrdersModel();
			$viewOrders = $affiche->findOrdersAndCustom($id);

			$items = new ItemModel();

			$data= [
			'orders' => $viewOrders,
			'items' => $items,
			];
		}

		if(!empty($this->getUser())){
			if ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
			else {
				$this->show('back/Orders/viewOrders', $data);
			}
		}
		else {
			$this->redirectToRoute('login');
		}
	}
}