<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UserModel;
use \W\Security\AuthorizationModel;
use \W\Security\AuthentificationModel;
use \Respect\Validation\Validator as v;

class FrontUserController extends Controller 
{


	/**
	 * Ajout d'utilisateur Front
	 */
	public function faddUser()
	{
		$post = [];
		$errors = [];
		$social_title = ['M', 'Mme'];
		$hashPassword = new AuthentificationModel();
		$insert = new UserModel();
		$success = false;

		if(!empty($_POST)){
			
			//On nettoie les entrées du formulaire
			foreach ($_POST as $key => $value) {
				$post[$key] = trim(strip_tags($value));
			}

			//Contrôle des entrées du formulaire

			if(!in_array($post['social_title'], $social_title)){
				$errors[] = 'Vous devez choisir votre civilité (M ou Mme)';
			}

			if(!v::notEmpty()->length(3,20)->validate($post['firstname'])){
				$errors[] = 'Le prénom doit comporter entre 3 et 20 caractères';
			}

			if(!v::notEmpty()->length(3,20)->validate($post['lastname'])){
				$errors[] = 'Le nom doit comporter entre 3 et 20 caractères';
			}

			if(!v::notEmpty()->length(3,20)->validate($post['username'])){
				$errors[] = 'Le pseudonyme doit comporter entre 3 et 20 caractères';
			}

			if(!v::notEmpty()->length(5,null)->validate($post['address'])){
				$errors[] = 'Votre adresse doit comporter au moins 5 caractères';
			}

			if(!v::notEmpty()->digit()->length(5,5)->validate($post['zipcode'])){
				$errors[] = 'Votre adresse doit comporter au moins 5 caractères';
			}

			if(!v::notEmpty()->length(3,null)->validate($post['city'])){
				$errors[] = 'Votre adresse doit comporter au moins 3 caractères';
			}

			if(!v::notEmpty()->email()->validate($post['email'])){
				$errors[] = 'L\'adresse email n\'est pas valide';
			}

			if(!v::notEmpty()->length(8,20)->validate($post['password'])){
				$errors[] = 'Votre mot de passe doit comporter entre 8 et 20 caractères';
			}

			if(count($errors) === 0){
				
				$dataInsert = [
					'social_title'	=> $post['social_title'],
					'firstname'	=> $post['firstname'],
					'lastname'	=> $post['lastname'],
					'username'	=> $post['username'],
					'adress'	=> $post['address'],
					'zipcode'	=> $post['zipcode'],
					'city'	=> $post['city'],
					'email'	=> $post['email'],
					'password'	=> $hashPassword->hashPassword($post['password']),
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
			'errors'	=> $errors
		];	
		$this->show('front/User/addUser', $params);
	}

	/**
	 * affichage compte utilisateur
	 */

	public function affCptUser($id){

		$user = $this->getUser();

		if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
			$data = [
				'user' => $user,
			];
			$this->show('front/User/cptUser', $data);
		}
		else {
			$this->redirectToRoute('front_faddUser');
		}
	}

	/**
	 * Update compte utilisateur
	 */

	public function fupdateUser($id){

			$this->show('front/User/UpdateUser');
		/*if(!empty($this->getUser())){
		}
		else {
			$this->redirectToRoute('front_faddUser');
		}*/
	}

	/**
	 * Update compte utilisateur
	 */

	public function fconnectUser(){
		$this->show('front/Order/orderLogin');
	}
}