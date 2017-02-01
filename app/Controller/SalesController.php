<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\SalesModel;
use \Model\OrdersModel;
use \W\Security\AuthorizationModel;

class SalesController extends Controller 
{
	
	/**
	 * chiffre d'affaires
	 */
	public function listSales()
	{
		/*PAGINATION*/
		$nbpage= new SalesModel();
			$nb=$nbpage->countResults();

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 15;

		$sales = new SalesModel();
		$list_sales = $sales->findAllSales($page, $max);
		
		$orders = new OrdersModel();

		$price = 0;
		foreach($find_sales as $value){
		 $price = $value['total'] + $price;
		}

		$insert = $sales->insert([
			'revenue' => $price,
			]);

		$data = [
			'price'		=> $price,
			'max'		=> $max,
			'page'		=> $page,
			'nb'		=> $nb,
		];

		//Sécurisation de la page		
		if(!empty($this->getUser())){

			$verification = new AuthorizationModel();

			if ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
			else {
				$this->show('back/Sales/listSales', $data);
			}
		}
		else {
			$this->redirectToRoute('login');
		}
		
		
	}
}