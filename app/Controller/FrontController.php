<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\GuestbookModel;

class FrontController extends Controller
{
	
	/**
	 * Page d'accueil par défaut
	 */
	public function index()
	{	
		$getComment = new GuestbookModel();
		$comments = $getComment->findAllMessageFront();
		$data = [
			'comments' => $comments,
			
		]; 
		$this->show('front/index', $data);
	}

	/**
	 * Page de connexion
	 */
	public function login()
	{
		$post = [];
		$errors = [];

		if(!empty($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));

			if(empty($post['pseudo']) && empty($post['password'])) {
				$errors[] = 'Veuillez saisir un pseudo et un mot de passe';
			}
			else {
				$connexion = new AuthentificationModel();
				$idConnexion = $connexion->isValidLoginInfo($post['pseudo'], $post['password']);

				if($connexion){
					$userModel = new UserModel();
					$user = $userModel->find($idConnexion);

					$connexion->logUserIn($user);
				}
				else {
					$error = 'Erreur d\'identifiant ou de mot de passe';
				}
			}
		if(!empty($this->getUser())){
			$this->redirectToRoute('front/index');
		}
		else {
			$param = ['error' => $errors];
			$this->show('front/User/login', $param);			
		}

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

}