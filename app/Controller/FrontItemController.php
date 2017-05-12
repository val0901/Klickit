<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\ItemModel;
use \Model\UserModel;
use \Model\FavoriteModel;
use \Model\FilterModel;
use \Model\FiltrearticleModel;
use \W\Security\AuthorizationModel;
use \W\Security\AuthentificationModel;
use \Respect\Validation\Validator as v;

class FrontItemController extends MasterController 
{
	/**
	 * Affiche la page des items "Classiques"
	 */
	public function listItemClassics($sub_category)
	{
		/*Pagination*/
		$nbpage= new ItemModel();
		$nb=$nbpage->countResultssub($sub_category);

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;



		// Permet de récupéré la sous-catégorie sélectionner pour afficher uniquement les playmobils de cette sous-catégorie
		$affiche = new ItemModel();
		$afficheItems = $affiche->findSubCategoryAndCategory('PlaymobilClassique', $sub_category, $page, $max);

		// Permet de récupérer les playmobils qui sont de la catégorie annoncé avec le statut nouveauté pour les affichés dans le slider du bas de page
		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('PlaymobilClassique', 'nouveaute');

		// On instancie nos différentes class pour la gestion des Favoris
		$favorite = new FavoriteModel(); // Cette variable servira pour stock la liste des favoris d'un utilisateur
		$favoriteList = ''; // On instancie cette variable à l'avance pour éviter les erreurs

		if(!empty($this->getUser())){ // Si $_SESSION['user'] n'est pas vide ...
			$userFavorite = $favorite->findFavorisItem($_SESSION['user']['id']); // Alors on stock tout les favoris de l'utilisateur en question dans $userFavorite

			$myFavorite = ''; // On instancie la variable qui servira à stocker, sous forme "String" le contenu de $userFavorite

			// $userFavorite est un tableau multidimensionnel et c'est problématique pour le parcourir donc on voudrait le transformer en tableau simple
			foreach ($userFavorite as $favoris) { // On foreach donc le tableau qui content tout les tableaux ...
				foreach ($favoris as $value) { // Puis on foreach ses derniers tableau ...
					$myFavorite.= $value.', '; // Pour stocker tout sous forme string dans la variable $myFavorite avec un délimiteur pour que les différent id ne se mélange pas
				}
			}

			$favoriteList = substr($myFavorite, 0, -2); // Ensuite ici on défini notre variable instencié plus haut avec le contenu de $myFavorite et on supprime les deux derniers caractère inutile qui sont une virgule et un espace donc : ', '
		}

		// affichage des filtres
		$getfilters = new FilterModel();
		$filters= $getfilters->findAll();

		$i = 0;
		while ($i < 3){
			$i++;
			shuffle($afficheNewItems);
			switch ($i) {
				case 1:
					$statut1 = array_slice($afficheNewItems, 0, 4);
					break;
				case 2:
					$statut2 = array_slice($afficheNewItems, 0, 4);
					break;
				case 3:
					$statut3 = array_slice($afficheNewItems, 0, 4);
					break;
			}
		}

		$data = [
			'affiche' 		  => $afficheItems,
			'afficheNewItem1' => $statut1,
			'afficheNewItem2' => $statut2,
			'afficheNewItem3' => $statut3,
			'favorite'		  => explode(', ', $favoriteList), // Ici on transforme sous forme de tableau, simple, le contenu string de la variable $favoriteList, on pourra donc parcourir le tableau facilement grâce à un in_array comme on a besoin
			'max' 			  => $max,
			'page'			  => $page,
			'nb'			  => $nb,
			'filters'		  => $filters,
		];

		$this->showStuff('front/Items/classics', $data);
	}

	/**
	 * Affiche la page de tous les classics
	 */
	public function listClassicsItemsFull($column= 'PlaymobilClassique')
	{
		/*pagination*/
		$nbpage= new ItemModel();
		$nb=$nbpage->countResults($column);

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('PlaymobilClassique', 'nouveaute');

		$getClassicItems = new ItemModel();
		$items = $getClassicItems->findByCategory('PlaymobilClassique', $page, $max);


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
		}

		// affichage des filtres
		$getfilters = new FilterModel();
		$filters= $getfilters->findAll();

		$i = 0;
		while ($i < 3){
			$i++;
			shuffle($afficheNewItems);
			switch ($i) {
				case 1:
					$statut1 = array_slice($afficheNewItems, 0, 4);
					break;
				case 2:
					$statut2 = array_slice($afficheNewItems, 0, 4);
					break;
				case 3:
					$statut3 = array_slice($afficheNewItems, 0, 4);
					break;
			}
		}

		$data = [
			'afficheNewItem1' => $statut1,
			'afficheNewItem2' => $statut2,
			'afficheNewItem3' => $statut3,
			'items'			  => $items,
			'favorite'		  => explode(', ', $favoriteList),
			'max' 			  => $max,
			'page' 			  => $page,
			'nb'			  => $nb,
			'filters'		  => $filters,

		];

		$this->showStuff('front/Items/classicsFull', $data);
	}

	/**
	 * Affiche la page des items "Customs"
	 */
	public function listItemCustoms($sub_category)
	{
		/*pagination*/
		$nbpage= new ItemModel();
		$nb=$nbpage->countResultssub($sub_category);

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;

		$affiche = new ItemModel();
		$afficheItems = $affiche->findSubCategory($sub_category, $page, $max);

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('PlaymobilCustom', 'nouveaute');


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
		}

		// affichage des filtres
		$getfilters = new FilterModel();
		$filters= $getfilters->findAll();

		$i = 0;
		while ($i < 3){
			$i++;
			shuffle($afficheNewItems);
			switch ($i) {
				case 1:
					$statut1 = array_slice($afficheNewItems, 0, 4);
					break;
				case 2:
					$statut2 = array_slice($afficheNewItems, 0, 4);
					break;
				case 3:
					$statut3 = array_slice($afficheNewItems, 0, 4);
					break;
			}
		}

		$data = [
			'affiche' 		 => $afficheItems,
			'afficheNewItem1' => $statut1,
			'afficheNewItem2' => $statut2,
			'afficheNewItem3' => $statut3,
			'favorite'		 => explode(', ', $favoriteList),
			'max' 			 => $max,
			'page' 			 => $page,
			'nb'			 => $nb,
			'filters'		 => $filters,
		];

		$this->showStuff('front/Items/customs', $data);
	}

	/**
	* Affiche la page de tous les customs
	*/
	public function listCustomItemsFull($column= 'PlaymobilCustom')
	{
		/*pagination*/
		$nbpage= new ItemModel();
		$nb=$nbpage->countResults($column);

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('PlaymobilCustom', 'nouveaute');

		$getCLassicItems = new ItemModel();
		$items = $getCLassicItems->findByCategory('PlaymobilCustom', $page, $max);


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
		}

		// affichage des filtres
		$getfilters = new FilterModel();
		$filters= $getfilters->findAll();

		$i = 0;
		while ($i < 3){
			$i++;
			shuffle($afficheNewItems);
			switch ($i) {
				case 1:
					$statut1 = array_slice($afficheNewItems, 0, 4);
					break;
				case 2:
					$statut2 = array_slice($afficheNewItems, 0, 4);
					break;
				case 3:
					$statut3 = array_slice($afficheNewItems, 0, 4);
					break;
			}
		}

		$data = [
			'afficheNewItem1' => $statut1,
			'afficheNewItem2' => $statut2,
			'afficheNewItem3' => $statut3,
			'items'			 => $items,
			'favorite'		 => explode(', ', $favoriteList),
			'max'			 => $max,
			'page'			 => $page,
			'nb'			 => $nb,
			'filters'		 => $filters,
		];

		$this->showStuff('front/Items/customsFull', $data);
	}

	/**
	 * Affiche la page des items "Pièces détachées"
	 */
	public function listItemPieces($sub_category)
	{
		/*pagination*/
		$nbpage= new ItemModel();
		$nb=$nbpage->countResultssub($sub_category);

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;

		$affiche = new ItemModel();
		$afficheItems = $affiche->findSubCategoryAndCategory('PiecesDetachees', $sub_category, $page, $max);

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('PiecesDetachees', 'nouveaute');


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
		}

		// affichage des filtres
		$getfilters = new FilterModel();
		$filters= $getfilters->findAll();

		$i = 0;
		while ($i < 3){
			$i++;
			shuffle($afficheNewItems);
			switch ($i) {
				case 1:
					$statut1 = array_slice($afficheNewItems, 0, 4);
					break;
				case 2:
					$statut2 = array_slice($afficheNewItems, 0, 4);
					break;
				case 3:
					$statut3 = array_slice($afficheNewItems, 0, 4);
					break;
			}
		}

		$data = [
			'affiche' 		 => $afficheItems,
			'afficheNewItem1' => $statut1,
			'afficheNewItem2' => $statut2,
			'afficheNewItem3' => $statut3,
			'favorite'		 => explode(', ', $favoriteList),
			'max'			 => $max,
			'page'			 => $page,
			'nb'			 => $nb,
			'filters'		 => $filters,
		];

		$this->showStuff('front/Items/pieces', $data);
	}

	/**
	* Affiche la page de toutes les pièces détachées
	*/
	public function listPiecesItemsFull($column = 'PiecesDetachees' )
	{
		/*pagination*/
		$nbpage= new ItemModel();
		$nb=$nbpage->countResults($column);

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('PiecesDetachees', 'nouveaute');

		$getCLassicItems = new ItemModel();
		$items = $getCLassicItems->findByCategory('PiecesDetachees', $page, $max);


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
		}

		// affichage des filtres
		$getfilters = new FilterModel();
		$filters= $getfilters->findAll();

		$i = 0;
		while ($i < 3){
			$i++;
			shuffle($afficheNewItems);
			switch ($i) {
				case 1:
					$statut1 = array_slice($afficheNewItems, 0, 4);
					break;
				case 2:
					$statut2 = array_slice($afficheNewItems, 0, 4);
					break;
				case 3:
					$statut3 = array_slice($afficheNewItems, 0, 4);
					break;
			}
		}

		$data = [
			'afficheNewItem1' => $statut1,
			'afficheNewItem2' => $statut2,
			'afficheNewItem3' => $statut3,
			'items'			 => $items,
			'favorite'		 => explode(', ', $favoriteList),
			'max'			 => $max,
			'page'			 => $page,
			'nb'			 => $nb,
			'filters'		 => $filters,
		];

		$this->showStuff('front/Items/piecesFull', $data);
	}

	/**
	 * Affiche la page des items "Divers"
	 */
	public function listItemDivers($sub_category)
	{
		/*pagination*/
		$nbpage= new ItemModel();
		$nb=$nbpage->countResultssub($sub_category);

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;

		$affiche = new ItemModel();
		$items = $affiche->findSubCategory($sub_category, $page, $max);

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('Divers', 'nouveaute');


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
		}

		// affichage des filtres
		$getfilters = new FilterModel();
		$filters= $getfilters->findAll();

		$i = 0;
		while ($i < 3){
			$i++;
			shuffle($afficheNewItems);
			switch ($i) {
				case 1:
					$statut1 = array_slice($afficheNewItems, 0, 4);
					break;
				case 2:
					$statut2 = array_slice($afficheNewItems, 0, 4);
					break;
				case 3:
					$statut3 = array_slice($afficheNewItems, 0, 4);
					break;
			}
		}

		$data = [
			'items' 		 => $items,
			'afficheNewItem1' => $statut1,
			'afficheNewItem2' => $statut2,
			'afficheNewItem3' => $statut3,
			'favorite'		 => explode(', ', $favoriteList),
			'max'			 => $max,
			'page'			 => $page,
			'nb'			 => $nb,
			'filters'		 => $filters,
		];

		$this->showStuff('front/Items/divers', $data);
	}

	/**
	* Affiche la page de tous les divers
	*/
	public function listDiversItemsFull($column = 'Divers')
	{
		/*pagination*/
		$nbpage= new ItemModel();
		$nb=$nbpage->countResults($column);

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 12;

		$newItems = new ItemModel();
		$afficheNewItems = $newItems->findCategoryStatutCustom('Divers', 'nouveaute');

		$getDiversItems = new ItemModel();
		$items = $getDiversItems->findByCategory('Divers', $page, $max);


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
		}

		// affichage des filtres
		$getfilters = new FilterModel();
		$filters= $getfilters->findAll();

		$i = 0;
		while ($i < 3){
			$i++;
			shuffle($afficheNewItems);
			switch ($i) {
				case 1:
					$statut1 = array_slice($afficheNewItems, 0, 4);
					break;
				case 2:
					$statut2 = array_slice($afficheNewItems, 0, 4);
					break;
				case 3:
					$statut3 = array_slice($afficheNewItems, 0, 4);
					break;
			}
		}

		$data = [
			'afficheNewItem1' => $statut1,
			'afficheNewItem2' => $statut2,
			'afficheNewItem3' => $statut3,
			'items'			 => $items,
			'favorite'		 => explode(', ', $favoriteList),
			'max'			 => $max,
			'page'			 => $page,
			'nb'			 => $nb,
			'filters'		 => $filters,
		];
		
		$this->showStuff('front/Items/diversFull', $data);
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
		}

		$i = 0;
		while ($i < 3){
			$i++;
			shuffle($afficheNewItems);
			switch ($i) {
				case 1:
					$statut1 = array_slice($afficheNewItems, 0, 4);
					break;
				case 2:
					$statut2 = array_slice($afficheNewItems, 0, 4);
					break;
				case 3:
					$statut3 = array_slice($afficheNewItems, 0, 4);
					break;
			}
		}

		$data = [
			'afficheNewItem1' => $statut1,
			'afficheNewItem2' => $statut2,
			'afficheNewItem3' => $statut3,
			'favorite'		 => explode(', ', $favoriteList),
			'items'			 => $items,
		];

		$this->showStuff('front/Items/viewArt', $data);
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
			$this->showStuff('front/Items/favorite', $data);	
		}
		else {
			$this->redirectToRoute('login');
		}
	}

	/**
	 * Option de recherche
	 */
	public function searchItems()
	{	
		$findItem = new ItemModel();
		$searchByItemTable = new ItemModel();
		$searchByFilter = new FiltrearticleModel();

		$idItem = '';
		$countItem = null;

		if($searchByItemTable->globalSearch($_SESSION['general_search'])){
			foreach ($searchByItemTable->globalSearch($_SESSION['general_search']) as $valueByitem) {
				foreach ($valueByitem as $itemID) {
					$idItem.= $itemID.', ';
				}
			}

			$countItem = count($searchByItemTable->globalSearch($_SESSION['general_search']));
		}
		else{
			foreach($searchByFilter->globalSearchByFilter($_SESSION['general_search']) as $valueByFilter){
				foreach ($valueByFilter as $item_id){
					$idItem.= $item_id.', ';
				}
			}
			$countItem = count($searchByFilter->globalSearchByFilter($_SESSION['general_search']));
		}

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
		}

		$data = [
			'findItem'  => $findItem,
			'items'     => explode(', ', substr($idItem, 0, -2)),
			'countItem' => $countItem,
			'favorite'  => explode(', ', $favoriteList),
		];

		if(!empty($_SESSION['general_search'])){
			$this->showStuff('front/Items/search', $data);
		}
		else {
			$this->redirectToRoute('front_index');
		}
	}
}