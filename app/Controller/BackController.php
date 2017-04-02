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
use \Model\SalesrevenueModel;
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

		$items = new ItemModel();

		$salesValue = [
			'month'   => '',
			'year' 	  => '',
			'revenue' => '',
		];

		$sales = new SalesrevenueModel();
		$allSales = array_reverse($sales->findSales());

		$lastSales = array_slice($allSales, 0, 2);

		$data = [
			'sales'	   => $lastSales,
			'orders'   => $list_orders,
			'messages' => $list_messages,
			'items'    => $items,
			'comments' => $list_guestbook,
		];

		if(!empty($this->getUser())){
			$verification = new AuthorizationModel();

			
			if ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
			else {
				$this->show('back/index', $data);
			}
		}
		else {
			$this->redirectToRoute('login');
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

				//Génération du token et de l'id correspondant
				$token = $generateToken->randomString(80);
				$id_token = $generateToken->randomString(40);

				//Préparation de l'envoi du mail
				$sendMail = new PHPMailer;

				$contentEmail = 'Bonjour '.$name_user.'.<br> Voici le lien pour réinitialiser votre mot de passe : '.'<a href="http://klickit.fr'.$this->generateUrl('back_reset_pwd', ['id_token'=> $id_token, 'token' => $token]).'">Cliquez ici</a>';

				$sendMail->isSMTP();                                      
				$sendMail->Host = 'ssl0.ovh.net';  									// Hôte du SMTP
				$sendMail->SMTPAuth = true;                               				// SMTP Authentification
				$sendMail->Username = 'contact@klickit.fr'; //Username         				// SMTP username
				$sendMail->Password = 'mdp'; //mot de passe                    	 				// SMTP password
				$sendMail->SMTPSecure = 'tls';                         					// Enable TLS encryption, `ssl` also accepted
				$sendMail->Port = 587;                                					// TCP port to connect to
				$sendMail->CharSet = 'UTF-8';

				$sendMail->setFrom('contact@klickit.fr', 'Klickit');		  				//Expéditeur
				$sendMail->addAddress($post['email'], $name_user); 	   	//Destinataire

				$sendMail->Subject = 'Réinitialisation du mot de passe';
				$sendMail->Body    = $contentEmail; //On envoi le message éventuellement en HTML
				$sendMail->AltBody = $contentEmail; //On envoi le message sans HTML

				if(!$sendMail->send()){
					$error = 'Erreur lors de l\'envoi du mail';
				}else{
					$insertInfos = new ResetModel();
					
					//Contiendra le token et le mail
					$resetInfos = [
						'email'			=> $post['email'],
						'token'			=> $token,
						'id'			=> $id_token,
						'date_expire'	=> date('Y-m-d H:i:s'),
					];

					$insertInfos->insert($resetInfos);

					$success = true;
				}
			}

		}
		$data = ['error' => $error, 'success' => $success];
		$this->show('back/forgot_password', $data);
	}
}