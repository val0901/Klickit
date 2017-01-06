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
			$listFavorite = $favorite->findFavorite($_SESSION['user']['id']); // Utilise la fonction pour retrouver les favoris dans la bdd en fonction de l'id de l'utilisateur
			$existFavorite = $listFavorite['favorites']; // Stock le contenu de la colonne favorites dans la variable existFavorite (qui est de type string !)
			$favorisNew = ''; // Instancie la variable pour ajouter des nouveaux favoris
			$favoriteArray = []; // Instancie la variable qui servira à mettre existFavorite sous forme de tableau

			if(!empty($_POST) && isset($_POST)){ // Si $_POST n'est pas vide et qu'il est défini
				$favorisNew = implode('', $_POST); // On transforme le tableau $_POST en string
			}

			// Permet de gérer la liste des favoris des utilisateurs
			$newFavorite = new UserModel();
			if(empty($existFavorite)){ // Si existFavorite est vide
				// Cette condition est la pour entrer des favoris dans la colonne favoris QUE quand la colonne est vide
				$newFavoris = $newFavorite->updateFavorites($favorisNew, $_SESSION['user']['id']); // On se sert de la fonction updateFavorite pour mettre les favoris à jour avec le contenu de la variable favorisNew et en fonction de l'id de l'utilisateur connecté 
			}
			elseif(!empty($existFavorite) && isset($existFavorite)){ // Si existFavorite n'est pas vide et qu'il est défini
				// Cette condition est la pour entrer des favoris dans la colonne favoris QUE quand la colonne a déjà du contenu 
				$fullFavorite = $existFavorite.', '.$favorisNew; // La variable est la pour concatener existFavorite et favorisNew avec entre les deux variables les séparateurs ', '
				$newFavoris = $newFavorite->updateFavorites($fullFavorite, $_SESSION['user']['id']); // On se sert de la fonction updateFavorite pour mettre les favoris à jour avec le contenu de la variable favorisNew et en fonction de l'id de l'utilisateur connecté 

				$favoriteArray = explode(', ', $existFavorite); // Donc ici on défini la variable existFavorite dans favoriteArray
				$favorisDelete = implode(', ', $_POST); // Ici on récupère le contenu de $_POST 
				if(in_array($favorisDelete, $favoriteArray)){ // On compare le contenue de $favorisDelete au tableau FavoriteArray et si il y a une correspondance ...
					$deleteUpdate = substr(implode(', ', str_replace($favorisDelete, '', $favoriteArray)), 0, -2); // Donc on supprime la correspondance grâce à str_replace, puis on implode le tout pour que ça soit sous forme de string (oui, la bdd stock sous forme string) et avec substr on supprime les deux derniers caractères car sinon on aura ça à la fin de la string ', ' et on en veut pas
					$newFavoriteDelete = $newFavorite->updateFavorites($deleteUpdate, $_SESSION['user']['id']); // On se sert de la fonction updateFavorite pour mettre les favoris à jour avec le contenu de la variable favorisNew et en fonction de l'id de l'utilisateur connecté 
				}
			}
		}

		$data = [
			'affiche' 		 => $afficheItems,
			'afficheNewItem' => $afficheNewItems,
			'favoris'		 => $favoriteArray,
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