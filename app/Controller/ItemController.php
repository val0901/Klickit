<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\ItemModel;
use \W\Security\AuthorizationModel;
use \W\Security\AuthentificationModel;
use \Respect\Validation\Validator as v;
use \Intervention\Image\ImageManagerStatic as Image;

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

		$folderUpload = getApp()->getConfig('upload_dir'); 
		$fullFolderUpload = $_SERVER['DOCUMENT_ROOT'].$_SERVER['W_BASE'].'/assets'.$folderUpload;

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

			if(!v::image()->validate($_FILES['picture1']['tmp_name'])){
				$errors[] = 'Le fichier envoyé dans "Image 1" n\'est pas une image valide';
			}

			if(!v::size(null, '10MB')->validate($_FILES['picture1']['tmp_name'])){
				$errors[] = 'La taille de votre image dans "Image 1" doit être inférieur à 2MB';
			}

			if(!v::uploaded()->validate($_FILES['picture1']['tmp_name'])){
				$errors[] = 'Une erreur est survenue lors de l\'upload de l\'image dans "Image 1"';
			}

			if(!v::image()->validate($_FILES['picture2']['tmp_name'])){
				$errors[] = 'Le fichier envoyé dans "Image 1" n\'est pas une image valide';
			}

			if(!v::size(null, '10MB')->validate($_FILES['picture2']['tmp_name'])){
				$errors[] = 'La taille de votre image dans "Image 1" doit être inférieur à 2MB';
			}

			if(!v::uploaded()->validate($_FILES['picture2']['tmp_name'])){
				$errors[] = 'Une erreur est survenue lors de l\'upload de l\'image dans "Image 1"';
			}

			if(count($errors) === 0) {
				$img1 = Image::make($_FILES['picture1']['tmp_name']);
				$img2 = Image::make($_FILES['picture2']['tmp_name']);

				switch($img1->mime()){
					case 'image/jpg':
					case 'image/jpeg':
						$extension = '.jpg';
					break;
					case 'image/png':
						$extension = '.png';
					break;
					case 'image/gif':
						$extension = '.gif';
					break;
				}

				switch($img2->mime()){
					case 'image/jpg':
					case 'image/jpeg':
						$extension2 = '.jpg';
					break;
					case 'image/png':
						$extension2 = '.png';
					break;
					case 'image/gif':
						$extension2 = '.gif';
					break;

				}

				$imgName = uniqid('art_').$extension;
				$imgName2 = uniqid('art_').$extension2;

				$img1->save($fullFolderUpload.$imgName);
				$img2->save($fullFolderUpload.$imgName2);

				$itemModel = new ItemModel();

				$insert = $itemModel->insert([
					'name'		  => $post['name'],
					'description' => $post['description'],
					'quantity' 	  => $post['quantity'],
					'price' 	  => $post['price'],
					'picture1'	  => $imgName,
					'picture2'    => $imgName2,
					'statut' 	  => $post['statut'],
					'category' 	  => $post['category'],
				]);

				if($insert){
					$success = true;
				}
				else {
					$errors[] = 'Erreur lors de l\'ajout en base de données';
				}
			}
		}

		$params = [
			'errors'  => $errors,
			'success' => $success,
		];

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
	public function updateItem($id)
	{	
		if(!is_numeric($id) || empty($id)){
			$this->showNotFound();
		}else{
			$affiche = new ItemModel();
			$afficheItem = $affiche->find($id);
		}

		$dataUpdate = [];
		$post = [];
		$errors = [];
		$statut_product = ['promotion', 'nouveauté', 'par defaut'];
		$category_product = ['PlaymobilClassique', 'PlaymobilCustom', 'PiecesDetachees', 'Divers'];
		$insert = new ItemModel();
		$success = false;

		$folderUpload = getApp()->getConfig('upload_dir'); 
		$fullFolderUpload = $_SERVER['DOCUMENT_ROOT'].$_SERVER['W_BASE'].'/assets'.$folderUpload;

		if(!empty($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));

			if(!empty($post['statut']) && isset($post['statut'])) {
				if(!in_array($post['statut'], $statut_product)){
					$errors[] = 'Veuillez choisir un statut valide';
				}
				else {
					$dataUpdate['statut'] = $post['statut'];
				}
			}

			if(!empty($post['category']) && isset($post['category'])) {
				if(!in_array($post['category'], $category_product)){
					$errors[] = 'Veuillez choisir une catégorie valide';
				}
				else{
					$dataUpdate['category'] = $post['category'];
				}
			}

			if(!empty($post['name']) && isset($post['name'])) {
				if(!v::notEmpty()->length(3,30)->validate($post['name'])){
					$errors[] = 'Le nom du produit doit comporter entre 3 et 30 caractères';
				}
				else {
					$dataUpdate['name'] = $post['name'];
				}
			}

			if(!empty($post['description']) && isset($post['description'])) {
				if(!v::notEmpty()->length(5,null)->validate($post['description'])){
					$errors[] = 'La description doit comporter au moins 5 caractères';
				}
				else {
					$dataUpdate['description'] = $post['description'];
				}
			}

			if(!empty($post['quantity']) && isset($post['quantity'])) {
				if(!v::notEmpty()->digit()->length(1,null)->validate($post['quantity'])){
					$errors[] = 'La quantité doit comporter au moins 1 unité';
				}
				else {
					$dataUpdate['quantity'] = $post['quantity'];
				}
			}

			if(!empty($post['newPrice']) && isset($post['newPrice'])) {
				if(!v::notEmpty()->digit()->length(1,null)->validate($post['newPrice'])){
					$errors[] = 'Le nouveau prix doit être supérieur à 0';
				}
				else {
					$dataUpdate['newPrice'] = $post['newPrice'];
				}
			}

			if(!empty($post['picture1']) && isset($post['picture1'])) {
				if(!v::image()->validate($_FILES['picture1']['tmp_name'])){
					$errors[] = 'Le fichier envoyé dans "Image 1" n\'est pas une image valide';
				}

				if(!v::size(null, '6MB')->validate($_FILES['picture1']['tmp_name'])){
					$errors[] = 'La taille de votre image dans "Image 1" doit être inférieur à 2MB';
				}

				if(!v::uploaded()->validate($_FILES['picture1']['tmp_name'])){
					$errors[] = 'Une erreur est survenue lors de l\'upload de l\'image dans "Image 1"';
				}
			}

			if(!empty($post['picture2']) && isset($post['picture2'])) {
				if(!v::image()->validate($_FILES['picture2']['tmp_name'])){
					$errors[] = 'Le fichier envoyé dans "Image 1" n\'est pas une image valide';
				}

				if(!v::size(null, '6MB')->validate($_FILES['picture2']['tmp_name'])){
					$errors[] = 'La taille de votre image dans "Image 1" doit être inférieur à 2MB';
				}

				if(!v::uploaded()->validate($_FILES['picture2']['tmp_name'])){
					$errors[] = 'Une erreur est survenue lors de l\'upload de l\'image dans "Image 1"';
				}
			}


			if(count($errors) === 0) {

			if(!empty($post['picture1']) && isset($post['picture1'])) {	
				$img1 = Image::make($_FILES['picture1']['tmp_name']);
				switch($img1->mime()){
					case 'image/jpg':
					case 'image/jpeg':
						$extension = '.jpg';
					break;
					case 'image/png':
						$extension = '.png';
					break;
					case 'image/gif':
						$extension = '.gif';
					break;
				}
				$imgName = uniqid('art_').$extension;
				if($img1->save($fullFolderUpload.$imgName)){
					$dataUpdate['picture1'] = $imgName;
				}
			}

			if(!empty($post['picture2']) && isset($post['picture2'])) {
				$img2 = Image::make($_FILES['picture2']['tmp_name']);
				switch($img2->mime()){
					case 'image/jpg':
					case 'image/jpeg':
						$extension2 = '.jpg';
					break;
					case 'image/png':
						$extension2 = '.png';
					break;
					case 'image/gif':
						$extension2 = '.gif';
					break;
				}
				$imgName2 = uniqid('art_').$extension2;
				if($img2->save($fullFolderUpload.$imgName2)){
					$dataUpdate['picture2'] = $imgName2;
				}
			}
			
				if($insert->update($dataUpdate, $id)){
					$success = true;
				}
				else {
					$errors[] = 'Erreur lors de l\'ajout en base de données';
				}
			}

		}
			$data = [
				'affichage' => $afficheItem,
				'success'	=> $success,
				'errors'	=> $errors
			];

			if(!empty($_SESSION)){

				$this->show('back/Item/updateItem', $data);

				if($_SESSION['role'] == 'Utilisateur') {
					$this->redirectToRoute('front_index');
				}
			}
			else {
				$this->redirectToRoute('back_login');
			}
	}
}