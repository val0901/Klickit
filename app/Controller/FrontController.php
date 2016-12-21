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
		$this->show('front/Pages/contact');
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