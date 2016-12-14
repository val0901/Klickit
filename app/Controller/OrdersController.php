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
		// On instancie le nombre de nb de lignes ds la table
		$nbpage= new OrdersModel();
			$nb=$nbpage->countResults();

		// on definit les variables, page courante et nb de lignes affichées
		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 5;

		$orders = new OrdersModel();
			$list_orders = $orders->findAllOrders($page, $max);


		$update_status = new OrdersModel(); //servira pour changer le statut 

			//Changement du statut du message
		if(isset($_POST['commandé'])){

			//On change le statut du message
			$status = [
				'statut' => 'commandé'
			];
			$updated = $update_status->update($status,$id);

			$this->redirectToRoute('listOrders'); //et on redirige

		}elseif(isset($_POST['en préparation'])){

			$status = [
				'statut' => 'en préparation'
			];
			$updated = $update_status->update($status,$id);

			$this->redirectToRoute('listOrders');
		}
		elseif(isset($_POST['expédié'])){

			$status = [
				'statut' => 'expédié'
			];
			$updated = $update_status->update($status,$id);

			$this->redirectToRoute('listOrders');
		}


		

				$data = [
					'data'	=> $list_orders,
					'max' => $max,
					'page' => $page,
					'nb' => $nb,
					
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


}