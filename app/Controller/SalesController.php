<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\SalesrevenueModel;
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
		$nbpage= new SalesrevenueModel();
			$nb=$nbpage->countResults();

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 15;

		$sales = new SalesrevenueModel();
		$list_sales = $sales->findAllSales($page, $max);
		
		$orders = new OrdersModel();
		$find_sales = $orders->findSalesRevenue();

		$price = 0;
		foreach($find_sales as $value){
		 $price = $value['total'] + $price;
		 // $month = date('m', strtotime($value['date_creation']));
		 // $year = date('Y', strtotime($value['date_creation']));
		}

		$insert = $sales->insert([
			// 'month'	=> $month,
			// 'year'	=> $year,
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