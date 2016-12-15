<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\ShippingModel;
use \W\Security\AuthorizationModel;

class ShippingController extends Controller 
{
	/**
	 * Liste des options d'envoie
	 */
	public function listShipping()
	{	
		$getShipping = new ShippingModel();
		$list = $getShipping->findAll();

		$data = [
			'options'	=> $list
		];

		if(!empty($_SESSION)){

			$this->show('back/Shipping/listShipping',$data);

			if($_SESSION['role'] == 'Utilisateur') {
				$this->redirectToRoute('front_index');
			}
		}
		else {
			$this->redirectToRoute('back_login');
		}
		
	}

	/**
	 * Ajout d'option d'envoie
	 */
	public function addShipping()
	{	
		$post = [];
		$errors = [];
		$insert = new ShippingModel();
		$success = false;

		if(!empty($_POST)){

			foreach ($_POST as $key => $value) {
				$post[$key] = trim(strip_tags($value));
			}

			if(strlen($post['title']) < 3 || strlen($post['title']) > 25){
				$errors[] = 'Le nom de l\'option d\'envoi doit comporter entre 3 et 25 caractères';
			}

			if(strlen($post['content']) < 5){
				$errors[] = 'La description de l\'option d\'envoi doit comporter au minimum 5 caractères';
			}

			if(!is_numeric($post['price'])){
				$errors[] = 'Le prix doit être de type numérique';
			}

			if(count($errors) === 0){
				$dataInsert = [
					'title'		=> $post['title'],
					'content'	=> $post['content'],
					'price'		=> $post['price'],
				];

				if($insert->insert($dataInsert)){
					$success = true;
				}else{
					$errors[] = 'Erreur lors de l\'ajout en base de données';
				}
			}
		}

		$params = [
			'success'	=> $success,
			'errors'	=> $errors,
		];

		if(!empty($_SESSION)){

			$this->show('back/Shipping/addShipping',$params);

			if($_SESSION['role'] == 'Utilisateur') {
				$this->redirectToRoute('front_index');
			}
		}
		else {
			$this->redirectToRoute('back_login');
		}
		
	}

	/**
	 * Suppression d'option d'envoie
	 */
	public function deleteShipping()
	{
		$this->show('back/Shipping/deleteShipping');
	}
}