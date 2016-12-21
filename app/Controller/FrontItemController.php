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

	/**
	* Affiche la page de tous les customs
	*/
	public function listCustomItemsFull()
	{
		$nbpage= new ItemModel();
		$nb=$nbpage->countResults();

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('PlaymobilCustom', 'nouveaute');

		$getCustomItems = new ItemModel();
		$items = $getCustomItems->findByCategory('PlaymobilCustom', $page, $max);

		$data = [
			'afficheNewItem' => $afficheNewItems,
			'items'	=> $items,
			'max' => $max,
			'page' => $page,
			'nb' => $nb,
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
	public function viewItem($id)
	{
		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('PlaymobilCustom', 'nouveaute');

		$item = new ItemModel();
		$items = $item->findItems($id);

		$data = [
			'afficheNewItem' => $afficheNewItems,
			'items'=> $items,
		];

		$this->show('front/Items/viewArt', $data);
	}
	/**
	 * Affiche la page des favoris
	 */
	public function viewFavorites()
	{
		$this->show('front/Items/favorite');
	}

	/**
	* Affiche la page de tous les classiques
	*/
	public function listClassicsItemsFull()
	{
		$getClassicsItems = new ItemModel();
		$items = $getClassicsItems->findByCategory('PlaymobilClassique');
		

		$data = [
			'items'	=> $items
		];

		$this->show('front/Items/classicsFull', $data);
	}

	/**
	* Affiche la page de tous les divers
	*/
	public function listDiversItemsFull()
	{
		$getDiversItems = new ItemModel();
		$items = $getDiversItems->findByCategory('Divers');

		$data = [
			'items'	=> $items
		];

		$this->show('front/Items/diversFull', $data);
	}

	/**
	* Affiche la page de toutes les pièces détachées
	*/
	public function listPiecesItemsFull()
	{
		$getPiecesItems = new ItemModel();
		$items = $getPiecesItems->findByCategory('PiecesDetachees');

		$data = [
			'items'	=> $items
		];

		$this->show('front/Items/piecesFull', $data);
	}



}