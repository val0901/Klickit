<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\SlideModel;
use \W\Security\AuthorizationModel;
use \W\Security\AuthentificationModel;
use \Respect\Validation\Validator as v;
use \Intervention\Image\ImageManagerStatic as Image;

class SlideController extends Controller 
{
	/**
	 * Liste des Slides
	 */
	public function listSlide()
	{
		$list = new SlideModel();
		$slide = $list->findAll();

		$data = [
			'slide'	=> $slide,
		];

		if(!empty($this->getUser())){

			$verification = new AuthorizationModel();

			if ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
			else {
				$this->show('back/Slide/listSlide', $data);
			}
		}
		else {
			$this->redirectToRoute('login');
		}
	}

	/**
	 * Ajout de Slide
	 */
	public function addSlide()
	{

		$post = [];
		$errors = [];
		$insert = new SlideModel();
		$success = false;

		$folderUpload = getApp()->getConfig('upload_dir_slide'); 
		$fullFolderUpload = $_SERVER['DOCUMENT_ROOT'].$_SERVER['W_BASE'].'/assets'.$folderUpload;

		if(!empty($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));

			if(!v::notEmpty()->length(3,50)->validate($post['title'])){
				$errors[] = 'Le titre du slide doit comporter plus de 3 caractères';
			}

			if(!v::image()->validate($_FILES['picture']['tmp_name'])){
				$errors[] = 'L\'image envoyé n\'est pas une image valide';
			}

			if(!v::size(null, '2MB')->validate($_FILES['picture']['tmp_name'])){
				$errors[] = 'La taille de votre image doit être inférieur à 2MB';
			}

			if(!v::uploaded()->validate($_FILES['picture']['tmp_name'])){
				$errors[] = 'Une erreur est survenue lors de l\'upload de l\'image';
			}

			if(!v::notEmpty()->url()->validate($post['link'])){
				$errors[] = 'L\'url du slide n\'est pas valide';
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

				$imgName = uniqid('slide_').$extension;
				$img->save($fullFolderUpload.$imgName);

				$dataInsert = [
					'title'   => $post['title'],
					'picture' => $imgName,
					'link'	  => $post['link'],
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
				$this->show('back/Slide/addSlide', $params);
			}
		}
		else {
			$this->redirectToRoute('login');
		}
	}
	

	/**
	 * Mise à jour de Slide
	 */
	public function updateSlide($id)
	{

		if(!is_numeric($id) || empty($id)){
			$this->showNotFound();
		}else{
			$affiche = new SlideModel();
			$afficheSlide = $affiche->find($id);
		}

		$post = [];
		$errors = [];
		$insert = new SlideModel();
		$success = false;

		$folderUpload = getApp()->getConfig('upload_dir_slide'); 
		$fullFolderUpload = $_SERVER['DOCUMENT_ROOT'].$_SERVER['W_BASE'].'/assets'.$folderUpload;

		if(!empty($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));

			if(!empty($post['title']) && isset($post['title'])){
				if(!v::notEmpty()->length(3,50)->validate($post['title'])){
					$errors[] = 'Le titre du slide doit comporter plus de 3 caractères';
				}
				else {
					$afficheSlide['title'] = $post['title'];
				}
			}

			if(!empty($_FILES['picture']) && file_exists($_FILES['picture']['tmp_name'])) {
				if(!v::image()->validate($_FILES['picture']['tmp_name'])){
					$errors[] = 'L\'image envoyé n\'est pas une image valide';
				}

				if(!v::size(null, '2MB')->validate($_FILES['picture']['tmp_name'])){
					$errors[] = 'La taille de votre image doit être inférieur à 2MB';
				}

				if(!v::uploaded()->validate($_FILES['picture']['tmp_name'])){
					$errors[] = 'Une erreur est survenue lors de l\'upload de l\'image';
				}
			}

			if(!empty($post['link']) && isset($post['link'])){
				if(!v::notEmpty()->url()->validate($post['link'])){
					$errors[] = 'L\'url du slide n\'est pas valide';
				}
				else {
					$afficheSlide['link'] = $post['link'];
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
					$imgName = uniqid('slide_').$extension;
					if($img->save($fullFolderUpload.$imgName)){
						$afficheSlide['picture'] = $imgName;
					}
				}

				if($insert->update($afficheSlide, $id)){
					$success = true;
				}
				else {
					$errors[] = 'Erreur lors de la mise à jour en base de données';
				}
			}
		}

			$data = [
				'affichage' => $afficheSlide,
				'success'	=> $success,
				'errors'	=> $errors
			];

		if(!empty($this->getUser())){

			$verification = new AuthorizationModel();
			
			if ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
			else {
				$this->show('back/Slide/updateSlide', $data);
			}
		}
		else {
			$this->redirectToRoute('login');
		}
	}
}