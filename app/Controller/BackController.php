<?php

namespace Controller;

use \W\Controller\Controller;

class BackController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function index()
	{
		$this->show('back/index');
	}

	/**
	 * Page de connexion
	 */
	public function login()
	{
		$this->show('back/login');
	}
}