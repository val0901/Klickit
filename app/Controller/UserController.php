<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UserModel;
use \W\Security\AuthorizationModel;
use \W\Security\AuthentificationModel;
use \Respect\Validation\Validator as v;

class UserController extends Controller 
{

	/**
	 * Liste des utilisateurs
	 */
	public function listUser()
	{	
		
		$nbpage= new UserModel();
		$nb=$nbpage->countResults();

		// on definit les variables, page courante et nb de lignes affichées
		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 15;

		$list = new UserModel();
		$users = $list->findAllUsers($page, $max);

		$data = [
			'users'	=> $users,
			'max' => $max,
			'page' => $page,
			'nb' => $nb,	
		];

		if(!empty($this->getUser())){
			if ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
			else {
				$this->show('back/User/listUser', $data);
			}
		}
		else {
			$this->redirectToRoute('login');
		}
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

		if(!empty($this->getUser())){
			if ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
			else {
				$this->show('back/User/addUser', $params);
			}
		}
		else {
			$this->redirectToRoute('login');
		}	
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
		$dataUpdate = [];
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

			if(!empty($post['social_title']) && isset($post['social_title'])) {
				if(!in_array($post['social_title'], $social_title)){
					$errors[] = 'Vous devez choisir votre civilité (M ou Mme)';
				}
				else {
					$user['social_title'] = $post['social_title'];
				}
			}

			if(!empty($post['role']) && isset($post['role'])) {
				if(!in_array($post['role'], $role)){
					$errors[] = 'Vous devez choisir un niveau d\'utilisateur (Admin ou Utilisateur)';
				}
				else {
					$user['role'] = $post['role'];
				}
			}

			if(!empty($post['firstname']) && isset($post['firstname'])){
				if(!v::notEmpty()->length(3,20)->validate($post['firstname'])){
					$errors[] = 'Le prénom doit comporter entre 3 et 20 caractères';
				}
				else{
					$user['firstname'] = $post['firstname'];
				}

			}

			if(!empty($post['lastname']) && isset($post['lastname'])){
				if(!v::notEmpty()->length(3,20)->validate($post['lastname'])){
					$errors[] = 'Le nom doit comporter entre 3 et 20 caractères';
				}
				else{
					$user['lastname'] = $post['lastname'];
				}
			}	


			if(!empty($post['username']) && isset($post['username'])){
				if(!v::notEmpty()->length(3,20)->validate($post['username'])){
					$errors[] = 'Le pseudonyme doit comporter entre 3 et 20 caractères';
				}
				else{
					$user['username'] = $post['username'];
				}
			}
			
			if(!empty($post['address']) && isset($post['address'])){	
				if(!v::notEmpty()->length(5,null)->validate($post['address'])){
					$errors[] = 'Votre adresse doit comporter au moins 5 caractères';
				}
				else{
					$user['adress'] = $post['address'];
				}
			}	


			if(!empty($post['zipcode']) && isset($post['zipcode'])){
				if(!v::notEmpty()->digit()->length(5,5)->validate($post['zipcode'])){
					$errors[] = 'Votre adresse doit comporter au moins 5 caractères';
				}
				else{
					$user['zipcode'] = $post['zipcode'];
				}
			}
				
			if(!empty($post['city']) && isset($post['city'])){
				if(!v::notEmpty()->length(3,null)->validate($post['city'])){
					$errors[] = 'Votre adresse doit comporter au moins 3 caractères';
				}
				else{
					$user['city'] = $post['city'];
				}
			}

			if(!empty($post['email']) && isset($post['email'])){	
				if(!v::notEmpty()->email()->validate($post['email'])){
					$errors[] = 'L\'adresse email n\'est pas valide';
				}
				else{
					$user['email'] = $post['email'];
				}
			}

			if(!empty($post['password']) && isset($post['password'])){
				if(!v::notEmpty()->length(8,20)->validate($post['password'])){
					$errors[] = 'Votre mot de passe doit comporter entre 8 et 20 caractères';
				}
				else{
					$user['password'] = $hashPassword->hashPassword($post['password']);
				}
			}
				
			if(count($errors) === 0){
				if($insert->update($user, $id)){
					$success = true;
				}
				else{
					$errors[] = 'Erreur lors de l\'ajout en base de données';
				}
			}
		}

		$data = [
			'user'		=> $user, //Va récupérer les infos de l'utilisateur pour préremplir les champs
			'success'	=> $success, //success et errors vont nous servir à afficher les messages d'erreur ou de réussite
			'errors'	=> $errors
		];

		if(!empty($this->getUser())){
			if ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
			else {
				$this->show('back/User/updateUser', $data);
			}
		}
		else {
			$this->redirectToRoute('login');
		}	
	}
}