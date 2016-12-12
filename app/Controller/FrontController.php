<?php

namespace Controller;

use \W\Controller\Controller;


class FrontController extends Controller
{
	
	/**
	 * Page d'accueil par défaut
	 */
	public function index()
	{
		$this->show('front/index');
	}


}