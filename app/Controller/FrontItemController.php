<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\ItemModel;
use \Model\UserModel;
use \Model\FavoriteModel;
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
		/*Pagination*/
		$nbpage= new ItemModel();
		$nb=$nbpage->countResults();

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;



		// Permet de récupéré la sous-catégorie sélectionner pour afficher uniquement les playmobils de cette sous-catégorie
		$affiche = new ItemModel();
		$afficheItems = $affiche->findSubCategory($sub_category, $page, $max);

		// Permet de récupérer les playmobils qui sont de la catégorie annoncé avec le statut nouveauté pour les affichés dans le slider du bas de page
		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('PlaymobilClassique', 'nouveaute');

		$insertFavorite = new FavoriteModel();
		$findFavorite = new FavoriteModel();
		$deleteFavorite = new FavoriteModel();
		$favorite = new FavoriteModel();

		$favoriteList = '';
		if(!empty($this->getUser())){
			$userFavorite = $favorite->findFavorisItem($_SESSION['user']['id']);

			$myFavorite = '';

			foreach ($userFavorite as $favoris) {
				foreach ($favoris as $value) {
					$myFavorite.= $value.', ';
				}
			}

			$favoriteList = substr($myFavorite, 0, -2);
		
			if(!empty($_POST) && isset($_POST)){
				$post = implode('', $_POST);

				if($findFavorite->findFavoriteByIdItem($post)){
					$deleteFavorite->deleteFavorite($post);
				}
				else{
					$insertFavorite->insert([
						'id_member' => $_SESSION['user']['id'],
						'id_item'	=> $post, 
					]);
				}
			}
		}

		$data = [
			'affiche' 		 => $afficheItems,
			'afficheNewItem' => $afficheNewItems,
			'favorite'		 => explode(', ', $favoriteList),
			'max' 			 => $max,
			'page'			 => $page,
			'nb'			 => $nb,
		];

		$this->show('front/Items/classics', $data);
	}

	/**
	 * Affiche la page de tous les classics
	 */
	public function listClassicsItemsFull()
	{
		/*pagination*/
		$nbpage= new ItemModel();
		$nb=$nbpage->countResults();

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('PlaymobilClassique', 'nouveaute');

		$getClassicItems = new ItemModel();
		$items = $getClassicItems->findByCategory('PlaymobilClassique', $page, $max);

		$insertFavorite = new FavoriteModel();
		$findFavorite = new FavoriteModel();
		$deleteFavorite = new FavoriteModel();
		$favorite = new FavoriteModel();

		$favoriteList = '';
		if(!empty($this->getUser())){
			$userFavorite = $favorite->findFavorisItem($_SESSION['user']['id']);

			$myFavorite = '';

			foreach ($userFavorite as $favoris) {
				foreach ($favoris as $value) {
					$myFavorite.= $value.', ';
				}
			}

			$favoriteList = substr($myFavorite, 0, -2);
		
			if(!empty($_POST) && isset($_POST)){
				$post = implode('', $_POST);

				if($findFavorite->findFavoriteByIdItem($post)){
					$deleteFavorite->deleteFavorite($post);
				}
				else{
					$insertFavorite->insert([
						'id_member' => $_SESSION['user']['id'],
						'id_item'	=> $post, 
					]);
				}
			}
		}

		$data = [
			'afficheNewItem' => $afficheNewItems,
			'items'			 => $items,
			'favorite'		 => explode(', ', $favoriteList),
			'max' 			 => $max,
			'page' 			 => $page,
			'nb'			 => $nb,
		];

		$this->show('front/Items/classicsFull', $data);
	}

	/**
	 * Affiche la page des items "Customs"
	 */
	public function listItemCustoms($sub_category)
	{
		/*pagination*/
		$nbpage= new ItemModel();
		$nb=$nbpage->countResults();

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;

		$affiche = new ItemModel();
		$afficheItems = $affiche->findSubCategory($sub_category, $page, $max);

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('PlaymobilCustom', 'nouveaute');

		$insertFavorite = new FavoriteModel();
		$findFavorite = new FavoriteModel();
		$deleteFavorite = new FavoriteModel();
		$favorite = new FavoriteModel();

		$favoriteList = '';
		if(!empty($this->getUser())){
			$userFavorite = $favorite->findFavorisItem($_SESSION['user']['id']);

			$myFavorite = '';

			foreach ($userFavorite as $favoris) {
				foreach ($favoris as $value) {
					$myFavorite.= $value.', ';
				}
			}

			$favoriteList = substr($myFavorite, 0, -2);
		
			if(!empty($_POST) && isset($_POST)){
				$post = implode('', $_POST);

				if($findFavorite->findFavoriteByIdItem($post)){
					$deleteFavorite->deleteFavorite($post);
				}
				else{
					$insertFavorite->insert([
						'id_member' => $_SESSION['user']['id'],
						'id_item'	=> $post, 
					]);
				}
			}
		}

		$data = [
			'affiche' 		 => $afficheItems,
			'afficheNewItem' => $afficheNewItems,
			'favorite'		 => explode(', ', $favoriteList),
			'max' 			 => $max,
			'page' 			 => $page,
			'nb'			 => $nb,
		];

		$this->show('front/Items/customs', $data);
	}

	/**
	* Affiche la page de tous les customs
	*/
	public function listCustomItemsFull()
	{
		/*pagination*/
		$nbpage= new ItemModel();
		$nb=$nbpage->countResults();

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('PlaymobilCustom', 'nouveaute');

		$getCLassicItems = new ItemModel();
		$items = $getCLassicItems->findByCategory('PlaymobilCustom', $page, $max);

		$insertFavorite = new FavoriteModel();
		$findFavorite = new FavoriteModel();
		$deleteFavorite = new FavoriteModel();
		$favorite = new FavoriteModel();

		$favoriteList = '';
		if(!empty($this->getUser())){
			$userFavorite = $favorite->findFavorisItem($_SESSION['user']['id']);

			$myFavorite = '';

			foreach ($userFavorite as $favoris) {
				foreach ($favoris as $value) {
					$myFavorite.= $value.', ';
				}
			}

			$favoriteList = substr($myFavorite, 0, -2);
		
			if(!empty($_POST) && isset($_POST)){
				$post = implode('', $_POST);

				if($findFavorite->findFavoriteByIdItem($post)){
					$deleteFavorite->deleteFavorite($post);
				}
				else{
					$insertFavorite->insert([
						'id_member' => $_SESSION['user']['id'],
						'id_item'	=> $post, 
					]);
				}
			}
		}

		$data = [
			'afficheNewItem' => $afficheNewItems,
			'items'			 => $items,
			'favorite'		 => explode(', ', $favoriteList),
			'max'			 => $max,
			'page'			 => $page,
			'nb'			 => $nb,
		];

		$this->show('front/Items/customsFull', $data);
	}

	/**
	 * Affiche la page des items "Pièces détachées"
	 */
	public function listItemPieces($sub_category)
	{
		/*pagination*/
		$nbpage= new ItemModel();
		$nb=$nbpage->countResults();

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;

		$affiche = new ItemModel();
		$afficheItems = $affiche->findSubCategory($sub_category, $page, $max);

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('PiecesDetachees', 'nouveaute');

		$insertFavorite = new FavoriteModel();
		$findFavorite = new FavoriteModel();
		$deleteFavorite = new FavoriteModel();
		$favorite = new FavoriteModel();

		$favoriteList = '';
		if(!empty($this->getUser())){
			$userFavorite = $favorite->findFavorisItem($_SESSION['user']['id']);

			$myFavorite = '';

			foreach ($userFavorite as $favoris) {
				foreach ($favoris as $value) {
					$myFavorite.= $value.', ';
				}
			}

			$favoriteList = substr($myFavorite, 0, -2);
		
			if(!empty($_POST) && isset($_POST)){
				$post = implode('', $_POST);

				if($findFavorite->findFavoriteByIdItem($post)){
					$deleteFavorite->deleteFavorite($post);
				}
				else{
					$insertFavorite->insert([
						'id_member' => $_SESSION['user']['id'],
						'id_item'	=> $post, 
					]);
				}
			}
		}

		$data = [
			'affiche' 		 => $afficheItems,
			'afficheNewItem' => $afficheNewItems,
			'favorite'		 => explode(', ', $favoriteList),
			'max'			 => $max,
			'page'			 => $page,
			'nb'			 => $nb,
		];

		$this->show('front/Items/pieces', $data);
	}

	/**
	* Affiche la page de toutes les pièces détachées
	*/
	public function listPiecesItemsFull()
	{
		/*pagination*/
		$nbpage= new ItemModel();
		$nb=$nbpage->countResults();

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('PiecesDetachees', 'nouveaute');

		$getCLassicItems = new ItemModel();
		$items = $getCLassicItems->findByCategory('PiecesDetachees', $page, $max);

		$insertFavorite = new FavoriteModel();
		$findFavorite = new FavoriteModel();
		$deleteFavorite = new FavoriteModel();
		$favorite = new FavoriteModel();

		$favoriteList = '';
		if(!empty($this->getUser())){
			$userFavorite = $favorite->findFavorisItem($_SESSION['user']['id']);

			$myFavorite = '';

			foreach ($userFavorite as $favoris) {
				foreach ($favoris as $value) {
					$myFavorite.= $value.', ';
				}
			}

			$favoriteList = substr($myFavorite, 0, -2);
		
			if(!empty($_POST) && isset($_POST)){
				$post = implode('', $_POST);

				if($findFavorite->findFavoriteByIdItem($post)){
					$deleteFavorite->deleteFavorite($post);
				}
				else{
					$insertFavorite->insert([
						'id_member' => $_SESSION['user']['id'],
						'id_item'	=> $post, 
					]);
				}
			}
		}

		$data = [
			'afficheNewItem' => $afficheNewItems,
			'items'			 => $items,
			'favorite'		 => explode(', ', $favoriteList),
			'max'			 => $max,
			'page'			 => $page,
			'nb'			 => $nb,
		];

		$this->show('front/Items/piecesFull', $data);
	}

	/**
	 * Affiche la page des items "Divers"
	 */
	public function listItemDivers($sub_category)
	{
		/*pagination*/
		$nbpage= new ItemModel();
		$nb=$nbpage->countResults();

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;

		$affiche = new ItemModel();
		$items = $affiche->findSubCategory($sub_category, $page, $max);

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('Divers', 'nouveaute');

		$insertFavorite = new FavoriteModel();
		$findFavorite = new FavoriteModel();
		$deleteFavorite = new FavoriteModel();
		$favorite = new FavoriteModel();

		$favoriteList = '';
		if(!empty($this->getUser())){
			$userFavorite = $favorite->findFavorisItem($_SESSION['user']['id']);

			$myFavorite = '';

			foreach ($userFavorite as $favoris) {
				foreach ($favoris as $value) {
					$myFavorite.= $value.', ';
				}
			}

			$favoriteList = substr($myFavorite, 0, -2);
		
			if(!empty($_POST) && isset($_POST)){
				$post = implode('', $_POST);

				if($findFavorite->findFavoriteByIdItem($post)){
					$deleteFavorite->deleteFavorite($post);
				}
				else{
					$insertFavorite->insert([
						'id_member' => $_SESSION['user']['id'],
						'id_item'	=> $post, 
					]);
				}
			}
		}

		$data = [
			'items' 		 => $items,
			'afficheNewItem' => $afficheNewItems,
			'favorite'		 => explode(', ', $favoriteList),
			'max'			 => $max,
			'page'			 => $page,
			'nb'			 => $nb,
		];

		$this->show('front/Items/divers', $data);
	}

	/**
	* Affiche la page de tous les divers
	*/
	public function listDiversItemsFull()
	{
		/*pagination*/
		$nbpage= new ItemModel();
		$nb=$nbpage->countResults();

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('Divers', 'nouveaute');

		$getDiversItems = new ItemModel();
		$items = $getDiversItems->findByCategory('Divers', $page, $max);

		$insertFavorite = new FavoriteModel();
		$findFavorite = new FavoriteModel();
		$deleteFavorite = new FavoriteModel();
		$favorite = new FavoriteModel();

		$favoriteList = '';
		if(!empty($this->getUser())){
			$userFavorite = $favorite->findFavorisItem($_SESSION['user']['id']);

			$myFavorite = '';

			foreach ($userFavorite as $favoris) {
				foreach ($favoris as $value) {
					$myFavorite.= $value.', ';
				}
			}

			$favoriteList = substr($myFavorite, 0, -2);
		
			if(!empty($_POST) && isset($_POST)){
				$post = implode('', $_POST);

				if($findFavorite->findFavoriteByIdItem($post)){
					$deleteFavorite->deleteFavorite($post);
				}
				else{
					$insertFavorite->insert([
						'id_member' => $_SESSION['user']['id'],
						'id_item'	=> $post, 
					]);
				}
			}
		}

		$data = [
			'afficheNewItem' => $afficheNewItems,
			'items'			 => $items,
			'favorite'		 => explode(', ', $favoriteList),
			'max'			 => $max,
			'page'			 => $page,
			'nb'			 => $nb,
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
			'items'			 => $items,
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

		$favorite = new FavoriteModel();
		$findFavorite = $favorite->findFavoriteByUser($_SESSION['user']['id']); 

		$items = new ItemModel();

		$data = [
				'user'	   => $findUser,
				'favorite' => $findFavorite,
				'items'    => $items,
			];

		if(!empty($this->getUser())){
			$this->show('front/Items/favorite', $data);	
		}
		else {
			$this->redirectToRoute('login');
		}
	}

}