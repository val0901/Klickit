<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\FilterModel;
use \W\Security\AuthorizationModel;
use \Respect\Validation\Validator as v;

class FilterController extends Controller 
{
	/*Liste des filtres*/
	public function listFilter()
	{
		$this->show('back/Filter/listFilter');
	}

	/*Ajout des filtres*/
	public function addFilter()
	{
		$this->show('back/Filter/addFilter');
	}

	/*Mise à jour des filtres*/
	public function updateFilter($id)
	{
		$this->show('back/Filter/updateFilter');

	}


}