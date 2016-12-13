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

		/**** REQUÊTE CONCERNANT LES PLAYMOBILS DE CATEGORIE "CLASSIQUE" ****/
		$listItemClassic = new ItemModel();
		$itemsClassic = $listItemClassic->listItemClassic();


		/**** REQUÊTE CONCERNANT LES PLAYMOBILS DE CATEGORIE "CUSTOM" ****/
		$listItemCustom = new ItemModel();
		$itemsCustom = $listItemCustom->listItemCustom();


		/**** REQUÊTE CONCERNANT LES PLAYMOBILS DE CATEGORIE "PIECES DETACHEES" ****/
		$listItemPiece = new ItemModel();
		$itemsPiece = $listItemPiece->listItemPiece();

		/**** REQUÊTE CONCERNANT LES PLAYMOBILS DE CATEGORIE "DIVERS" ****/
		$listItemDivers = new ItemModel();
		$itemsDivers = $listItemDivers->listItemDivers();

		$data = [
			'Classic'	=> $itemsClassic,
			'Custom'    => $itemsCustom,
			'Piece'     => $itemsPiece,
			'Divers'	=> $itemsDivers,
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
		$post = [];
		$errors = [];
		$statut_product = ['promotion', 'nouveauté', 'par defaut'];
		$category_product = ['PlaymobilClassique', 'PlaymobilCustom', 'PiecesDetachees', 'Divers'];
		$insert = new ItemModel();
		$success = false;

		if(!empty($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));

			if(!in_array($post['statut'], $statut_product)){
				$errors[] = 'Veuillez choisir un statut valide';
			}

			if(!in_array($post['category'], $category_product)){
				$errors[] = 'Veuillez choisir une catégorie valide';
			}

			if(!v::notEmpty()->length(3,30)->validate($post['name'])){
				$errors[] = 'Le nom du produit doit comporter entre 3 et 30 caractères';
			}

			if(!v::notEmpty()->length(5,null)->validate($post['description'])){
				$errors[] = 'La description doit comporter au moins 5 caractères';
			}

			if(!v::notEmpty()->digit()->length(1,null)->validate($post['quantity'])){
				$errors[] = 'La quantité doit comporter au moins 1 unité';
			}

			if(!v::notEmpty()->digit()->length(1,null)->validate($post['price'])){
				$errors[] = 'Le prix doit être supérieur à 0';
			}

			
		}

		if(!empty($_SESSION)){

			$this->show('back/Item/addItem', $params);

			if($_SESSION['role'] == 'Utilisateur') {
				$this->redirectToRoute('front_index');
			}
		}
		else {
			$this->redirectToRoute('back_login');
		}
	}

	/**
	 * Modification d'article 
	 */
	public function updateItem()
	{
		$this->show('back/Item/updateItem');
	}
}