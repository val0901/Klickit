<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\EventModel;
use \W\Security\AuthorizationModel;
use \W\Security\AuthentificationModel;
use \Respect\Validation\Validator as v;
use \Intervention\Image\ImageManagerStatic as Image;

class EventController extends Controller 
{
	/**
	 * Liste des évènements 
	 */
	public function listEvent()
	{

		$nbpage= new EventModel();
		$nb=$nbpage->countResults();

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 15;

		$list = new EventModel();
		$event = $list->findAllEvent($page, $max);

		$data = [
			'event'	=> $event,
			'max' => $max,
			'page' => $page,
			'nb' => $nb,
		];

		if(!empty($this->getUser())){

			$verification = new AuthorizationModel();

			if ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
			else {
				$this->show('back/Event/listEvent', $data);
			}
		}
		else {
			$this->redirectToRoute('login');
		}
	}

	/**
	 * Ajout d'évènement
	 */
	public function addEvent()
	{

		$post = [];
		$errors = [];
		$insert = new EventModel();
		$success = false;

		$folderUpload = getApp()->getConfig('upload_dir_event'); 
		$fullFolderUpload = $_SERVER['DOCUMENT_ROOT'].$_SERVER['W_BASE'].'/assets'.$folderUpload;

		if(!empty($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));

			if(!v::notEmpty()->length(3,50)->validate($post['title'])){
				$errors[] = 'Le titre de l\'évènement doit comporter plus de 3 caractères';
			}

			if(!v::image()->validate($_FILES['picture']['tmp_name'])){
				$errors[] = 'L\'affiche envoyé n\'est pas une image valide';
			}

			if(!v::size(null, '2MB')->validate($_FILES['picture']['tmp_name'])){
				$errors[] = 'La taille de votre affiche doit être inférieur à 2MB';
			}

			if(!v::uploaded()->validate($_FILES['picture']['tmp_name'])){
				$errors[] = 'Une erreur est survenue lors de l\'upload de l\'affiche';
			}

			if(count($errors) === 0){
				$img = Image::make($_FILES['picture']['tmp_name']);

				switch($img->mime()){
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

				$imgName = uniqid('events_').$extension;
				$img->save($fullFolderUpload.$imgName);

				$dataInsert = [
					'title' => $post['title'],
					'picture' => $imgName,
				];

				if($insert->insert($dataInsert)){
					$success = true;
				}
				else {
					$errors[] = 'Erreur lors de l\'ajout en base de données';
				}
			}
		}

		$params = [
			'success'	=> $success,
			'errors'	=> $errors
		];

		if(!empty($this->getUser())){

			$verification = new AuthorizationModel();

			if ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
			else {
				$this->show('back/Event/addEvent', $params);
			}
		}
		else {
			$this->redirectToRoute('login');
		}
	}

	/**
	 * Modification d'évènement
	 */
	public function updateEvent($id)
	{
		if(!is_numeric($id) || empty($id)){
			$this->showNotFound();
		}else{
			$affiche = new EventModel();
			$afficheEvent = $affiche->find($id);
		}

		$post = [];
		$errors = [];
		$insert = new EventModel();
		$success = false;

		$folderUpload = getApp()->getConfig('upload_dir_event'); 
		$fullFolderUpload = $_SERVER['DOCUMENT_ROOT'].$_SERVER['W_BASE'].'/assets'.$folderUpload;

		if(!empty($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));

			if(!empty($post['title']) && isset($post['title'])){
				if(!v::notEmpty()->length(3,50)->validate($post['title'])){
					$errors[] = 'Le titre de l\'évènement doit comporter plus de 3 caractères';
				}
				else {
					$afficheEvent['title'] = $post['title'];
				}
			}

			if(!empty($_FILES['picture']) && file_exists($_FILES['picture']['tmp_name'])) {
				if(!v::image()->validate($_FILES['picture']['tmp_name'])){
					$errors[] = 'L\'affiche envoyé n\'est pas une image valide';
				}

				if(!v::size(null, '2MB')->validate($_FILES['picture']['tmp_name'])){
					$errors[] = 'La taille de votre affiche doit être inférieur à 2MB';
				}

				if(!v::uploaded()->validate($_FILES['picture']['tmp_name'])){
					$errors[] = 'Une erreur est survenue lors de l\'upload de l\'affiche';
				}
			}

			if(count($errors) === 0){

				if(!empty($_FILES['picture']) && file_exists($_FILES['picture']['tmp_name'])) {
					$img = Image::make($_FILES['picture']['tmp_name']);
					switch($img->mime()){
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
					$imgName = uniqid('events_').$extension;
					if($img->save($fullFolderUpload.$imgName)){
						$afficheEvent['picture'] = $imgName;
					}
				}

				if($insert->update($afficheEvent, $id)){
					$success = true;
				}
				else {
					$errors[] = 'Erreur lors de la mise à jour en base de données';
				}
			}
		}

			$data = [
				'affichage' => $afficheEvent,
				'success'	=> $success,
				'errors'	=> $errors
			];

		if(!empty($this->getUser())){

			$verification = new AuthorizationModel();

			if ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
			else {
				$this->show('back/Event/updateEvent', $data);
			}
		}
		else {
			$this->redirectToRoute('login');
		}	
	}
}