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

		$list = new EventModel();
		$event = $list->findAll();

		$data = [
			'event'	=> $event,
		];

		if(!empty($_SESSION)){

			$this->show('back/Event/listEvent', $data);

			if($_SESSION['role'] == 'Utilisateur') {
				$this->redirectToRoute('front_index');
			}
		}
		else {
			$this->redirectToRoute('back_login');
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

			if(!v::notEmpty()->length(5,null)->validate($post['content'])){
				$errors[] = 'La description de l\'évènement doit contenir plus de 5 caractères';
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
					'content' => $post['content'],
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

		if(!empty($_SESSION)){

			$this->show('back/Event/addEvent', $params);

			if($_SESSION['role'] == 'Utilisateur') {
				$this->redirectToRoute('front_index');
			}
		}
		else {
			$this->redirectToRoute('back_login');
		}
	}

	/**
	 * Modification d'évènement
	 */
	public function updateEvent()
	{
		$this->show('back/Event/updateEvent');
	}
}