<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\ItemModel;
use \Model\UserModel;
use \W\Security\AuthorizationModel;
use \W\Security\AuthentificationModel;
use \Respect\Validation\Validator as v;

class FrontItemController extends Controller 
{
	/**
	 * Affiche la page des items "Classiques"
	 */
	public function listItemClassics($sub_category)
	{
		// Permet de récupéré la sous-catégorie sélectionner pour afficher uniquement les playmobils de cette sous-catégorie
		$affiche = new ItemModel();
		$afficheItems = $affiche->findSubCategory($sub_category);

		// Permet de récupérer les playmobils qui sont de la catégorie annoncé avec le statut nouveauté pour les affichés dans le slider du bas de page
		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('PlaymobilClassique', 'nouveaute');

		if(!empty($this->getUser())){
			// Récupète la liste des favoris
			$favorite = new UserModel();
			$listFavorite = $favorite->findFavorite($_SESSION['user']['id']);
			$existFavorite = $listFavorite['favorites'];

			// Permet de gérer la liste des favoris des utilisateurs
			$newFavorite = new UserModel();
			if(empty($existFavorite)){
				$favorisNew = implode('', $_POST);
				$newFavoris = $newFavorite->updateFavorites($favorisNew, $_SESSION['user']['id']);
			}
			elseif(!empty($existFavorite) && isset($existFavorite)){
				$favorisNew = implode('', $_POST);
				$fullFavorite = $existFavorite.', '.$favorisNew;
				$newFavoris = $newFavorite->updateFavorites($fullFavorite, $_SESSION['user']['id']);
			}
		}

		$data = [
			'affiche' 		 => $afficheItems,
			'afficheNewItem' => $afficheNewItems,
		];

		$this->show('front/Items/classics', $data);
	}

	/**
	 * Affiche la page de tous les classics
	 */
	public function listClassicsItemsFull()
	{
		$nbpage= new ItemModel();
		$nb=$nbpage->countResults();

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('PlaymobilClassique', 'nouveaute');

		$getClassicItems = new ItemModel();
		$items = $getClassicItems->findByCategory('PlaymobilClassique', $page, $max);

		$data = [
			'afficheNewItem' => $afficheNewItems,
			'items'	=> $items,
			'max' => $max,
			'page' => $page,
			'nb' => $nb,
		];

		$this->show('front/Items/classicsFull', $data);
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

		$getCLassicItems = new ItemModel();
		$items = $getCLassicItems->findByCategory('PlaymobilCustom', $page, $max);

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
	 * Affiche la page des items "Pièces détachées"
	 */
	public function listItemPieces($sub_category)
	{
		$affiche = new ItemModel();
		$afficheItems = $affiche->findSubCategory($sub_category);

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('PiecesDetachees', 'nouveaute');

		$data = [
			'affiche' 		 => $afficheItems,
			'afficheNewItem' => $afficheNewItems,
		];

		$this->show('front/Items/pieces', $data);
	}

	/**
	* Affiche la page de toutes les pièces détachées
	*/
	public function listPiecesItemsFull()
	{
		$nbpage= new ItemModel();
		$nb=$nbpage->countResults();

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('PiecesDetachees', 'nouveaute');

		$getCLassicItems = new ItemModel();
		$items = $getCLassicItems->findByCategory('PiecesDetachees', $page, $max);

		$data = [
			'afficheNewItem' => $afficheNewItems,
			'items'	=> $items,
			'max' => $max,
			'page' => $page,
			'nb' => $nb,
		];

		$this->show('front/Items/piecesFull', $data);
	}

	/**
	 * Affiche la page des items "Divers"
	 */
	public function listItemDivers()
	{
		$this->show('front/Items/divers');
	}

	/**
	* Affiche la page de tous les divers
	*/
	public function listDiversItemsFull()
	{

		$nbpage= new ItemModel();
		$nb=$nbpage->countResults();

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('Divers', 'nouveaute');

		$getDiversItems = new ItemModel();
		$items = $getDiversItems->findByCategory('Divers', $page, $max);

		$data = [
			'afficheNewItem' => $afficheNewItems,
			'items'	=> $items,
			'max' => $max,
			'page' => $page,
			'nb' => $nb,
		];
		
		$this->show('front/Items/diversFull', $data);
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
		$user = new UserModel();
		$findUser = $user->findUser($_SESSION['user']['id']);

		$items = new ItemModel();

		$data = [
				'user'	=> $findUser,
				'items' => $items,
			];

		if(!empty($this->getUser())){
			$this->show('front/Items/favorite', $data);	
		}
		else {
			$this->redirectToRoute('login');
		}
	}

}