<?php

namespace Controller;

use \W\Controller\Controller;


class FrontController extends Controller
{
	
	/**
	 * Page d'accueil par défaut
	 */
	public function index()
	{
		$this->show('front/index');
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
			$this->redirectToRoute('front_index');
		}
		else {
			$param = ['error' => $errors];
			$this->show('front_login', $param);			
		}

		}

	}

}