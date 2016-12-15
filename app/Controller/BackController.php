<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Model\UsersModel;
use \Model\UserModel;
use \Model\BackModel;
use \Model\OrdersModel;
use \Model\MessageModel;
use \Model\GuestbookModel;
use \W\Security\AuthentificationModel;
use \W\Security\AuthorizationModel;
use \W\Security\StringUtils;
use \PHPMailer;

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

	/**
	* Envoi d'un mail pour réinitialiser le mot de passe
	*/
	public function forgot_pwd()
	{	
		$post = [];
		$error = '';
		$verify_mail = new UsersModel(); //Pour vérifier si le mail est bien dans la bdd
		$generateToken = new StringUtils(); //Va générer le token pour le lien
		$user = new UserModel(); //Sert pour récupérer le nom et le prénom lié au mail
		$success = false;

		if(!empty($_POST)){
			foreach ($_POST as $key => $value) {
				$post[$key] = trim(strip_tags($value));
			}

			if(!$verify_mail->emailExists($post['email'])){
				$error = 'L\'adresse email n\'existe pas';
			}
			else{

				//Récupération de l'utilisateur lié au mail
				$info = $user->getNameByMail($post['email']);
				foreach($info as $name){
					$name_user = $name['firstname'].' '.$name['lastname'];
				}

				//Génération du token
				$token = $generateToken->randomString(30);

				//Préparation de l'envoi du mail
				$sendMail = new PHPMailer;

				$contentEmail = 'Lien pour réinitialiser votre mot de passe : '.$this->generateUrl('back_reset_pwd', ['email'=> $post['email'], 'token' => $token]);

				$sendMail->isSMTP();                                      
				$sendMail->Host = 'smtp.mailgun.org';  									// Hôte du SMTP
				$sendMail->SMTPAuth = true;                               				// SMTP Authentification
				$sendMail->Username = 'postmaster@dev.axw.ovh';          				// SMTP username
				$sendMail->Password = 'WF3Phil0#3';                    	 				// SMTP password
				$sendMail->SMTPSecure = 'tls';                         					// Enable TLS encryption, `ssl` also accepted
				$sendMail->Port = 587;                                					// TCP port to connect to
				$sendMail->CharSet = 'UTF-8';

				$sendMail->setFrom('mail de Klickit', 'Klickit');		  				//Expéditeur
				$sendMail->addAddress($post['email'], $name_user); 	   	//Destinataire

				$sendMail->Subject = 'Réinitialisation du mot de passe';
				$sendMail->Body    = $contentEmail; //On envoi le message éventuellement en HTML
				$sendMail->AltBody = $contentEmail; //On envoi le message sans HTML

				if(!$sendMail->send()){
					$error = 'Erreur lors de l\'envoi du mail';
				}else{
					$success = true;
				}
			}

		}
		$data = ['error' => $error, 'success' => $success];
		$this->show('back/forgot_password', $data);
	}
}