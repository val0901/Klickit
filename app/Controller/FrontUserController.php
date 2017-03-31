<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UserModel;
use \W\Security\AuthorizationModel;
use \W\Security\AuthentificationModel;
use \PHPMailer;
use \Respect\Validation\Validator as v;

class FrontUserController extends MasterController 
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
		$sendMail = new PHPMailer;
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
					'role'	=> 'Utilisateur',
					'password'	=> $hashPassword->hashPassword($post['password']),
				];

				if($insert->insert($dataInsert)){
					$success = true;
				}else{
					$errors[] = 'Erreur lors de l\'ajout en base de données';
				}
			}
		}

		if($success == true){
			$contentEmail = 'Création du comporter';

			$sendMail->isSMTP();                                      
			$sendMail->Host = 'ssl0.ovh.net';  									// Hôte du SMTP
			$sendMail->SMTPAuth = true;                               				// SMTP Authentification
			$sendMail->Username = 'contact@klickit.fr'; //Username         				// SMTP username
			$sendMail->Password = 'silSAV33@'; //mot de passe                    	 				// SMTP password
			$sendMail->SMTPSecure = 'tls';                         					// Enable TLS encryption, `ssl` also accepted
			$sendMail->Port = 587;                                					// TCP port to connect to
			$sendMail->CharSet = 'UTF-8';

			$sendMail->setFrom('contact@klickit.fr', 'Klickit');		  		//Expéditeur
			
			$sendMail->addAddress($post['email'], $post['firstname'].' '.$post['lastname']); 	   	//$user['email']
			//$sendMail->addCC(''); 					//Copie envoyer à l'adresse souhaitée du mail

			$sendMail->Subject = 'Création du compte klickit.fr';
			$sendMail->Body    = $contentEmail="Bonjour ".$post['lastname'].' '.$post['firstname']." la création de votre compte klickit.fr est réussi ! <br><br> votre nom d'utilisateur : ".$post['username'].'veuillez ne jamais divulger vos identifiants !'; 
            //On envoi le message éventuellement en HTML

			$sendMail->AltBody = $contentEmail="";

			$sendMail->send();
		}

		$params = [
			'success'	=> $success,
			'errors'	=> $errors,
		];	
		$this->showStuff('front/User/addUser', $params);
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
			$this->showStuff('front/User/cptUser', $data);
		}
		else {
			$this->redirectToRoute('front_faddUser');
		}
	}

	/**
	 * Update compte utilisateur
	 */

	public function fupdateUser($id){

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
			$this->showStuff('front/User/UpdateUser', $data);	
		}
		else {
			$this->redirectToRoute('login');
		}
	}

	/**
	 * Update compte utilisateur
	 */

	public function fconnectUser(){
		$this->showStuff('front/Order/orderLogin');
	}
}