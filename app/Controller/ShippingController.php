<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\ShippingModel;
use \W\Security\AuthorizationModel;
use \Respect\Validation\Validator as v;

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
	public function updateShipping($id)
	{	
		$success = false;
		$post = [];
		$errors = [];
		if(!is_numeric($id) || empty($id)){
			$this->showNotFound();
		}else{
			$update  = new ShippingModel();
			$shipping = $update->find($id);

		}

		if(!empty($_POST)){
			
			//On nettoie les entrées du formulaire
			foreach ($_POST as $key => $value) {
				$post[$key] = trim(strip_tags($value));
			}

			//Contrôle des entrées du formulaire

			if(!empty($post['title']) && isset($post['title'])){
				if(!v::notEmpty()->length(3,25)->validate($post['title'])){
					$errors[] = 'Le nom de l\'option d\'envoi doit comporter entre 3 et 25 caractères';
				}
				else{
					$shipping['title'] = $post['title'];
				}

			}

			if(!empty($post['content']) && isset($post['content'])){
				if(!v::notEmpty()->length(5,null)->validate($post['content'])){
					$errors[] = 'La description doit au moins comporter 5 caractères';
				}
				else{
					$shipping['content'] = $post['content'];
				}
			}	


			if(!empty($post['price']) && isset($post['price'])){
				if(!is_numeric($post['price'])){
					$errors[] = 'Le prix doit être de type numérique';
				}
				else{
					$shipping['price'] = $post['price'];
				}
			}
				
			if(count($errors) === 0){

				if($update->update($shipping, $id)){
					$success = true;
				}
				else{
					$errors[] = 'Erreur lors de l\'ajout en base de données';
				}
				
			}
		}

		$data = [
			'shipping'	=> $shipping, 
			'success'	=> $success, //success et errors vont nous servir à afficher les messages d'erreur ou de réussite
			'errors'	=> $errors
		];	

		if(!empty($_SESSION)){

			$this->show('back/Shipping/updateShipping', $data);

			if($_SESSION['role'] == 'Utilisateur') {
				$this->redirectToRoute('front_index');
			}
		}
		else {
			$this->redirectToRoute('back_login');
		}
		$this->show('back/Shipping/updateShipping');
	}
}