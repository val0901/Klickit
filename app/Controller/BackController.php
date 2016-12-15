<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UserModel;
use \Model\OrdersModel;
use \Model\MessageModel;
use \Model\GuestbookModel;
use \W\Security\AuthentificationModel;
use \W\Security\AuthorizationModel;

class BackController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function index()
	{

		$orders = new OrdersModel();
		$list_orders = $orders->findAllWithUsers();

		$messages = new MessageModel();
		$list_messages = $messages->find15Messages();

		$comments = new GuestbookModel();
		$list_guestbook = $comments->find15Comments();

		$items = new OrdersModel();
        $list_items = $items->findItems();

		$data = [
			'orders'   => $list_orders,
			'messages' => $list_messages,
			'items' => $list_items,
			'comments' => $list_guestbook,
		];
		
		if(!empty($_SESSION)){

			$this->show('back/index', $data);

			if($_SESSION['role'] == 'Utilisateur') {
				$this->redirectToRoute('front_index');
			}
		}
		else {
			$this->redirectToRoute('back_login');
		}
		
	}

	/**
	 * Page de connexion
	 */
	public function login()
	{
		$post = [];
		$error = '';

		if(!empty($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));

			if(empty($post['pseudo']) && empty($post['password'])) {
				$error = 'Veuillez saisir un pseudo et un mot de passe';
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
			$param = ['error' => $error];
			$this->show('back/login', $param);			
		}
	}

	public function forgot_pwd()
	{
		
	}
}