<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\SalesModel;
use \W\Security\AuthorizationModel;

class SalesController extends Controller 
{
	
	/**
	 * chiffre d'affaires
	 */
	public function listSales()
	{
		$this->show('back/Sales/listSales');
		
	}
}