<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UserModel;
use \W\Security\AuthorizationModel;
use \W\Security\AuthentificationModel;
use \Respect\Validation\Validator as v;

class UserController extends Controller 
{


/**************** BACK ****************/


	/**
	 * Liste des utilisateurs
	 */
	public function listUser()
	{	
		$list = new UserModel();
		$users = $list->findAll();

		$data = [
			'users'	=> $users,
		];

		$this->show('back/User/listUser', $data);
	}

	/**
	 * Ajout d'utilisateur
	 */
	public function addUser()
	{	
		$post = [];
		$errors = [];
		$social_title = ['M', 'Mme'];
		$role = ['Admin', 'Utilisateur'];
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

			if(!in_array($post['role'], $role)){
				$errors[] = 'Vous devez choisir un niveau d\'utilisateur (Admin ou Utilisateur)';
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
					'role'		=> $post['role'],
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

		$this->show('back/User/addUser', $params);
	}

	/**
	 * Mise à jour des utilisateurs
	 * @param int $id l'id du membre qu'on veut modifier
	 */
	public function updateUser($id)
	{	
		
		//Sert pour afficher les infos de l'utilisateur
		if(!is_numeric($id) || empty($id)){
			$this->showNotFound();
		}else{
			$update  = new UserModel();
			$user = $update->find($id);

		}

		//Sert pour contrôler les entrées du formulaire
		$post = [];
		$errors = [];
		$social_title = ['M', 'Mme'];
		$role = ['Admin', 'Utilisateur'];
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

			if(!in_array($post['role'], $role)){
				$errors[] = 'Vous devez choisir un niveau d\'utilisateur (Admin ou Utilisateur)';
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
				
				$dataUpdate = [
					'social_title'	=> $post['social_title'],
					'role'		=> $post['role'],
					'firstname'	=> $post['firstname'],
					'lastname'	=> $post['lastname'],
					'username'	=> $post['username'],
					'adress'	=> $post['address'],
					'zipcode'	=> $post['zipcode'],
					'city'	=> $post['city'],
					'email'	=> $post['email'],
					'password'	=> $hashPassword->hashPassword($post['password']),
				];

				if($insert->update($dataUpdate, $id)){
					$success = true;
				}else{
					$errors[] = 'Erreur lors de l\'ajout en base de données';
				}
				
			}

		}
		$data = [
			'user'		=> $user, //Va récupérer les infos de l'utilisateur pour préremplir les champs
			'success'	=> $success, //success et errors vont nous servir à afficher les messages d'erreur ou de réussite
			'errors'	=> $errors
		];	

		$this->show('back/User/updateUser', $data);
	}

	/**
	 * Suppression d'utilisateur
	 */
	public function deleteUser()
	{
		$this->show('back/User/deleteUser');
	}

/**************** FRONT ****************/

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
	* Affichage page compte user 
	*/
/*	public function cptUse()
	{

		$this->show('front/User/cptUse', $params);

	}
*/

	/**
	* Affichage compte user 
	*/

	public function affCptUser(){
		$this->show('front/User/cptUser');
	}

}