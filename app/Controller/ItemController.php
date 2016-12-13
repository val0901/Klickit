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