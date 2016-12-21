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
use \W\Security\AuthentificationModel;
use \W\Security\AuthorizationModel;
use \W\Security\StringUtils;
use \PHPMailer;
use \Respect\Validation\Validator as v;

class FrontController extends Controller
{
	
	/**
	 * Page d'accueil par défaut
	 */
	public function index()
	{	
		$data = [];
		/******************Affichage des commentaires*****************/

		$getComment = new GuestbookModel();
		$comments = $getComment->findAllMessageFront();

		/************Affichage des articles dans le panier***********/
		$getShoppingCart = new UserModel();
		$getItems = new ItemModel();
		$user = $this->getUser();
		$shoppingCart = $getShoppingCart->find($user['id']);

		$panier = explode(', ', $shoppingCart['cart_item']);

		foreach($panier as $value){
			$list_items = $getItems->findItems($value);
			var_dump($list_items);

		}
		
		$data = [
			'comments'		=>	$comments,
		];	


		$this->show('front/index', $data);
	}

	/**
	 * Page de connexion
	 */
	public function login()
	{
		$post = [];
		$error = [];

		if(!empty($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));

			if(empty($post['pseudo']) && empty($post['password'])) {
				$errors[] = 'Veuillez saisir un pseudo et un mot de passe';
			}
			else {
				$connexion = new AuthentificationModel();
				$idConnexion = $connexion->isValidLoginInfo($post['pseudo'], $post['password']);

				if($idConnexion > 0){
					$userModel = new UserModel();
					$user = $userModel->find($idConnexion);

					$connexion->logUserIn($user);
				}
				elseif($idConnexion === 0) {
					$error = 'Erreur d\'identifiant ou de mot de passe';
				}
			}
		}

		if(!empty($this->getUser())){
			$verification = new AuthorizationModel();

			if($verification->isGranted('Admin')) {
				$this->redirectToRoute('back_index');
			}
			elseif ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
		}
		else {
			$data = [
				'error' => $error,
			];
			$this->show('front/login', $data);			
		}
	}

	/**
	 * Page A propos
	 */
	public function about()
	{
		$this->show('front/Pages/aPropos');
	}

	/**
	 * Page CGV
	 */
	public function cgv()
	{
		$this->show('front/Pages/cgv');
	}

	/**
	 * Page A propos
	 */
	public function contact()
	{	
		$post = [];
		$errors = [];
		$success = false;

		if(!empty($_POST)){

			foreach($_POST as $key => $value){
				$post[$key] = trim(strip_tags($value));
			}

			if(!v::notEmpty()->length(3,20)->validate($post['firstname'])){
				$errors[] = 'Le prénom doit comporter entre 3 et 20 caractères';
			}

			if(!v::notEmpty()->length(3,20)->validate($post['lastname'])){
				$errors[] = 'Le nom doit comporter entre 3 et 20 caractères';
			}

			if(!v::notEmpty()->length(3,null)->validate($post['subject'])){
				$errors[] = 'Le sujet doit comporter au minimum 3 caractères';
			}

			if(!v::notEmpty()->length(10,null)->validate($post['message'])){
				$errors[] = 'Le message doit comporter au minimum 10 caractères';
			}

			if(!v::notEmpty()->email()->validate($post['email'])){
				$errors[] = 'L\'adresse email n\'est pas valide';
			}

			if(count($errors) === 0){
				$insert = new MessageModel;
				$user = $this->getUser();

				if(!empty($user)){
					$dataInsert = [
						'username'		=> $user['username'],
						'date_creation'	=> date('Y-m-d H:i:s'),
						'subject'		=> $post['subject'],
						'email'			=> $post['email'],
						'statut'		=> 'NonLu',
						'content'		=> nl2br($post['message']),
						'idMember'		=> $user['id'],
					];
				}else{
					$dataInsert = [
						'username'		=> $post['firstname'].' '.$post['lastname'],
						'date_creation'	=> date('Y-m-d H:i:s'),
						'subject'		=> $post['subject'],
						'email'			=> $post['email'],
						'content'		=> nl2br($post['message']),
						'statut'		=> 'NonLu',
					];
				}
				

				if($insert->insert($dataInsert)){
					$success = true;
				}else{
					$errors[] = 'Erreur lors de l\'envoi de votre message';
				}
			}
		}

		$data = [
			'errors'	=> $errors,
			'success'	=> $success
		];
		$this->show('front/Pages/contact', $data);
	}

	/**
	 * Page A propos
	 */
	public function legalMention()
	{
		$this->show('front/Pages/legalMention');
	}

	/**
	 * Page Events
	 */
	public function events()
	{
		$this->show('front/Event/viewEvent');
	}

	/**
	 * Page équipe
	 */
	public function team()
	{
		$this->show('front/Pages/team');
	}



}