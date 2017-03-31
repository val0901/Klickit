<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Model\UsersModel;
use \Model\UserModel;
use \Model\BackModel;
use \Model\ResetModel;
use \Model\OrdersModel;
use \Model\ItemModel;
use \Model\MessageModel;
use \Model\GuestbookModel;
use \Model\FilterModel;
use \Model\FiltrearticleModel;
use \W\Security\AuthentificationModel;
use \W\Security\AuthorizationModel;
use \W\Security\StringUtils;
use \PHPMailer;
use \Respect\Validation\Validator as v;
use \Intervention\Image\ImageManagerStatic as Image;

class ItemController extends Controller 
{
	/**
	 * Liste des articles
	 */
	public function listItem()
	{

		$nbpage= new ItemModel();
		$nb=$nbpage->countResults('PlaymobilClassique');
		$nb1=$nbpage->countResults('PlaymobilCustom');
		$nb2=$nbpage->countResults('PiecesDetachees');
		$nb3=$nbpage->countResults('Divers');

		$max = 15;

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		

		$page1 = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

		$page2 = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

		$page3 = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;


		/**** REQUÊTE CONCERNANT LES PLAYMOBILS DE CATEGORIE "CLASSIQUE" ****/
		$listItemClassic = new ItemModel();
		$itemsClassic = $listItemClassic->listItemClassic($page, $max);


		/**** REQUÊTE CONCERNANT LES PLAYMOBILS DE CATEGORIE "CUSTOM" ****/
		$listItemCustom = new ItemModel();
		$itemsCustom = $listItemCustom->listItemCustom($page1, $max);


		/**** REQUÊTE CONCERNANT LES PLAYMOBILS DE CATEGORIE "PIECES DETACHEES" ****/
		$listItemPiece = new ItemModel();
		$itemsPiece = $listItemPiece->listItemPiece($page2, $max);

		/**** REQUÊTE CONCERNANT LES PLAYMOBILS DE CATEGORIE "DIVERS" ****/
		$listItemDivers = new ItemModel();
		$itemsDivers = $listItemDivers->listItemDivers($page3, $max);

		$data = [
			'Classic'	=> $itemsClassic,
			'Custom'    => $itemsCustom,
			'Piece'     => $itemsPiece,
			'Divers'	=> $itemsDivers,
			'max' => $max,
			'page' => $page,
			'page1' => $page1,
			'page2' => $page2,
			'page3' => $page3,
			'nb' => $nb,
			'nb1' => $nb1,
			'nb2' => $nb2,
			'nb3' => $nb3,
		];

		if(!empty($this->getUser())){

			$verification = new AuthorizationModel();

			if ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
			else {
				$this->show('back/Item/listItem', $data);
			}
		}
		else {
			$this->redirectToRoute('login');
		}
	}

	/**
	 * Ajoût d'article
	 */
	public function addItem()
	{
		$post = [];
		$errors = [];
		$statut_product = ['promotion', 'nouveaute', 'defaut'];
		$category_product = ['PlaymobilClassique', 'PlaymobilCustom', 'PiecesDetachees', 'Divers'];
		$subCategory_Classic = ['Chevaliers','Pirates','Antique','Western','Fantasy','XVIIIe','FeesPrincesses','Police','Animaux','Sport', 'Divers', 'Robot'];
		$subCategory_Custom = ['CustomsTampographies','CustomsPeints','BustesTampographies','PiecesEnResine','Stickers'];
		$subCategory_Piece = ['Armes','Coiffes','Manchettes','Cols','Ceinturons','Tetes','Cheveux','Divers'];
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

			if(!v::notEmpty()->length(3,50)->validate($post['name'])){
				$errors[] = 'Le nom du produit doit comporter entre 3 et 50 caractères';
			}

			if(!v::notEmpty()->length(5,null)->validate($post['description'])){
				$errors[] = 'La description doit comporter au moins 5 caractères';
			}

			if(!v::notEmpty()->digit()->length(1,null)->validate($post['quantity'])){
				$errors[] = 'La quantité doit comporter au moins 1 unité';
			}

			if(!v::notEmpty()->validate($post['price'])){
				$errors[] = 'Le prix doit être supérieur à 0';
			}

			if(!v::image()->validate($_FILES['picture1']['tmp_name'])){
				$errors[] = 'Le fichier envoyé dans "Image 1" n\'est pas une image valide';
			}

			if(!v::size(null, '2MB')->validate($_FILES['picture1']['tmp_name'])){
				$errors[] = 'La taille de votre image dans "Image 1" doit être inférieur à 2MB';
			}

			if(!v::uploaded()->validate($_FILES['picture1']['tmp_name'])){
				$errors[] = 'Une erreur est survenue lors de l\'upload de l\'image dans "Image 1"';
			}

			if(!empty($_POST['picture2']) && isset($_POST['picture2'])){
				if(!v::image()->validate($_FILES['picture2']['tmp_name'])){
					$errors[] = 'Le fichier envoyé dans "Image 1" n\'est pas une image valide';
				}

				if(!v::size(null, '2MB')->validate($_FILES['picture2']['tmp_name'])){
					$errors[] = 'La taille de votre image dans "Image 1" doit être inférieur à 2MB';
				}

				if(!v::uploaded()->validate($_FILES['picture2']['tmp_name'])){
					$errors[] = 'Une erreur est survenue lors de l\'upload de l\'image dans "Image 1"';
				}
			}

			if($post['category'] == 'PlaymobilClassique' && !in_array($post['subCategory'], $subCategory_Classic)){
				$errors[] = 'Vous avez entré une sous-catégorie qui n\'est pas liée à la catégorie Classique';
			}

			if($post['category'] == 'PlaymobilCustom' && !in_array($post['subCategory'], $subCategory_Custom)){
				$errors[] = 'Vous avez entré une sous-catégorie qui n\'est pas liée à la catégorie Custom';
			}

			if($post['category'] == 'PiecesDetachees' && !in_array($post['subCategory'], $subCategory_Piece)){
				$errors[] = 'Vous avez entré une sous-catégorie qui n\'est pas liée à la catégorie Pièces Detachées';
			}

			if(count($errors) === 0) {
				$img1 = Image::make($_FILES['picture1']['tmp_name']);
				if(!empty($_POST['picture2']) && isset($_POST['picture2'])){
					$img2 = Image::make($_FILES['picture2']['tmp_name']);
				}

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

				if(!empty($_POST['picture2']) && isset($_POST['picture2'])){
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
				}

				$imgName = uniqid('art_').$extension;
				if(!empty($_POST['picture2']) && isset($_POST['picture2'])){
					$imgName2 = uniqid('art_').$extension2;
				}
				elseif(empty($_POST['picture2'])) {
					$imgName2 = '';
				}

				$img1->save($fullFolderUpload.$imgName);
				if(!empty($_POST['picture2']) && isset($_POST['picture2'])){
					$img2->save($fullFolderUpload.$imgName2);
				}

				$itemModel = new ItemModel();

				$insert = $itemModel->insert([
					'name'		   => $post['name'],
					'description'  => $post['description'],
					'quantity' 	   => $post['quantity'],
					'price' 	   => str_replace(',', '.', $post['price']),
					'picture1'	   => $imgName,
					'picture2'     => $imgName2,
					'statut' 	   => $post['statut'],
					'category' 	   => $post['category'],
					'sub_category' => $post['subCategory'],
				]);

				if($insert){
					$success = true;
				}
				else {
					$errors[] = 'Erreur lors de l\'ajout en base de données';
				}
			}
		}

		$findFilter = new FilterModel();

		$filter = $findFilter->findAll();

		$params = [
			'filter'  => $filter,
			'errors'  => $errors,
			'success' => $success,
		];

		if(!empty($this->getUser())){

			$verification = new AuthorizationModel();

			if ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
			else {
				$this->show('back/Item/addItem', $params);
			}
		}
		else {
			$this->redirectToRoute('login');
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

		$post = [];
		$errors = [];
		$statut_product = ['promotion', 'nouveaute', 'defaut'];
		$category_product = ['PlaymobilClassique', 'PlaymobilCustom', 'PiecesDetachees', 'Divers'];
		$subCategory_Classic = ['Chevaliers','Pirates','Antique','Western','Fantasy','XVIIIe','FeesPrincesses','Police','Animaux','Sport', 'Divers', 'Robot'];
		$subCategory_Custom = ['CustomsTampographies','CustomsPeints','BustesTampographies','PiecesEnResine','Stickers'];
		$subCategory_Piece = ['Armes','Coiffes','Manchettes','Cols','Ceinturons','Tetes','Cheveux','Divers'];
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
					$afficheItem['statut'] = $post['statut'];
				}
			}

			if(!empty($post['category']) && isset($post['category'])) {
				if(!in_array($post['category'], $category_product)){
					$errors[] = 'Veuillez choisir une catégorie valide';
				}
				else{
					$afficheItem['category'] = $post['category'];
				}
			}

			if(!empty($post['subCategory']) && isset($post['subCategory'])) {
				if($post['category'] == 'PlaymobilClassique' && !in_array($post['subCategory'], $subCategory_Classic)){
					$errors[] = 'Vous avez entré une sous-catégorie qui n\'est pas liée à la catégorie Classique';
				}
				else {
					$afficheItem['sub_category'] = $post['subCategory'];
				}

				if($post['category'] == 'PlaymobilCustom' && !in_array($post['subCategory'], $subCategory_Custom)){
					$errors[] = 'Vous avez entré une sous-catégorie qui n\'est pas liée à la catégorie Custom';
				}
				else {
					$afficheItem['sub_category'] = $post['subCategory'];
				}

				if($post['category'] == 'PiecesDetachees' && !in_array($post['subCategory'], $subCategory_Piece)){
					$errors[] = 'Vous avez entré une sous-catégorie qui n\'est pas liée à la catégorie Pièces Detachées';
				}
				else {
					$afficheItem['sub_category'] = $post['subCategory'];
				}
			}

			if(!empty($post['name']) && isset($post['name'])) {
				if(!v::notEmpty()->length(3,50)->validate($post['name'])){
					$errors[] = 'Le nom du produit doit comporter entre 3 et 50 caractères';
				}
				else {
					$afficheItem['name'] = $post['name'];
				}
			}

			if(!empty($post['description']) && isset($post['description'])) {
				if(!v::notEmpty()->length(5,null)->validate($post['description'])){
					$errors[] = 'La description doit comporter au moins 5 caractères';
				}
				else {
					$afficheItem['description'] = $post['description'];
				}
			}

			if(isset($post['quantity']) || !empty($post['price'])) {
				if(!v::digit()->length(1,null)->validate($post['quantity'])){
					$errors[] = 'La quantité doit comporter au moins 1 unité';
				}
				else {
					$afficheItem['quantity'] = $post['quantity'];
				}
			}

			if(!empty($post['price']) && isset($post['price'])) {
				if(!v::notEmpty()->validate($post['price'])){
					$errors[] = 'Le nouveau prix doit être supérieur à 0';
				}
				else {
					$afficheItem['price'] = str_replace(',', '.', $post['price']);
				}
			}

			if(!empty($post['newPrice']) && isset($post['newPrice'])) {
				if(!v::notEmpty()->validate($post['newPrice'])){
					$errors[] = 'Le nouveau prix doit être supérieur à 0';
				}
				else {
					$afficheItem['newPrice'] = str_replace(',', '.', $post['newPrice']);
				}
			}

			if(!empty($_FILES['picture1']) && file_exists($_FILES['picture1']['tmp_name'])) {
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

			if(!empty($_FILES['picture2']) && file_exists($_FILES['picture2']['tmp_name'])) {
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

				if(!empty($_FILES['picture1']) && file_exists($_FILES['picture1']['tmp_name'])) {	
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
						$afficheItem['picture1'] = $imgName;
					}
				}

				if(!empty($_FILES['picture2']) && file_exists($_FILES['picture2']['tmp_name'])) {
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
						$afficheItem['picture2'] = $imgName2;
					}
				}

				if($insert->update($afficheItem, $id)){
					$success = true;
				}
				else {
					$errors[] = 'Erreur lors de la mise à jour en base de données';
				}
			}
		}

			$findFilterItem = new FiltrearticleModel();

			$findFilter = new FilterModel();
			$filter = $findFilter->findAll();

			$data = [
				'filter'	 => $filter,
				'ItemFilter' => $findFilterItem,
				'affichage'  => $afficheItem,
				'success'	 => $success,
				'errors'	 => $errors
			];

			if(!empty($this->getUser())){

				$verification = new AuthorizationModel();

				if ($verification->isGranted('Utilisateur')) {
					$this->redirectToRoute('front_index');
				}
				else {
					$this->show('back/Item/updateItem', $data);
				}
			}
			else {
				$this->redirectToRoute('login');
			}
	}
}