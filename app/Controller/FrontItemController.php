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

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('PlaymobilCustom', 'nouveaute');

		$data = [
			'affiche' 		 => $afficheItems,
			'afficheNewItem' => $afficheNewItems,
		];

		$this->show('front/Items/customs', $data);
	}

	public function listCustomItemsFull()
	{
		$getCustomItems = new ItemModel();
		$items = $getCustomItems->findByCategory('PlaymobilCustom');

		$data = [
			'items'	=> $items
		];

		$this->show('front/Items/customsFull', $data);
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

	/**
	 * Affiche la page d'un article
	 */
	public function viewItem()
	{
		$this->show('front/Items/viewArt');
	}
	/**
	 * Affiche la page des favoris
	 */
	public function viewFavorites()
	{
		$this->show('front/Items/favorite');
	}

}