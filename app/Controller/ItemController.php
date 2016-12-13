<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\ItemModel;
use \W\Security\AuthorizationModel;
use \W\Security\AuthentificationModel;
use \Respect\Validation\Validator as v;

class ItemController extends Controller 
{
	/**
	 * Liste des articles
	 */
	public function listItem()
	{
		$this->show('back/Item/listItem');
	}

	/**
	 * Ajoût d'article
	 */
	public function addItem()
	{
		$this->show('back/Item/addItem');
	}

	/**
	 * Modification d'article 
	 */
	public function updateItem()
	{
		$this->show('back/Item/updateItem');
	}

	/**
	 * Suppression d'article
	 */
	public function deleteItem()
	{
		$this->show('back/Item/deleteItem');
	}
}