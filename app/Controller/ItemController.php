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

		$listItemClassic = new ItemModel();
		$itemsClassic = $listItemClassic->listItemClassic();

		$data = [
			'Classic'	=> $itemsClassic,
		];

		if(!empty($_SESSION)){

			$this->show('back/Item/listItem', $data);

			if($_SESSION['role'] == 'Utilisateur') {
				$this->redirectToRoute('front_index');
			}
		}
		else {
			$this->redirectToRoute('back_login');
		}
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