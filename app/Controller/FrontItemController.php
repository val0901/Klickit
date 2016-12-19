<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\ItemModel;
use \W\Security\AuthorizationModel;
use \W\Security\AuthentificationModel;
use \Respect\Validation\Validator as v;

class FrontItemController extends Controller 
{
	/**
	 * Affiche la page des items "Classiques"
	 */
	public function listItemClassics()
	{
		$this->show('front/Items/classics');
	}

	/**
	 * Affiche la page des items "Customs"
	 */
	public function listItemCustoms($sub_category)
	{
		$affiche = new ItemModel();

		$afficheItems = $affiche->findSubCategory($sub_category);

		$data = [
			'affiche' => $afficheItems,
		];

		$this->show('front/Items/customs', $data);
	}

	/**
	 * Affiche la page des items "Divers"
	 */
	public function listItemDivers()
	{
		$this->show('front/Items/divers');
	}

	/**
	 * Affiche la page des items "Pièces détachées"
	 */
	public function listItemPieces()
	{
		$this->show('front/Items/pieces');
	}

	/**
	 * Option de recherche
	 */
	public function searchItems()
	{
		$this->show('front/Items/search');
	}


}