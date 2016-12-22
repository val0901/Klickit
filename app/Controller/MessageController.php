<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\MessageModel;
use \W\Security\AuthorizationModel;
use \Respect\Validation\Validator as v;
use \PHPMailer;

class MessageController extends Controller 
{
	/**
	* Liste des messages
	*/
	public function listMessage()
	{	
		$nbpage= new MessageModel();
		$nb=$nbpage->countResults();

		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 15;

		$list = new MessageModel();
		$messages = $list->findAllMessage($page, $max);

		$data = [
			'messages'	=> $messages,
			'max' => $max,
			'page' => $page,
			'nb' => $nb,
		];

		if(!empty($this->getUser())){

			$verification = new AuthorizationModel();

			if ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
			else {
				$this->show('back/Message/listMessage', $data);
			}
		}
		else {
			$this->redirectToRoute('login');
		}
	}

	/**
	 * Vue unique d'un message avec changement de statut et possibilité de répondre
	 */
	public function viewMessage($id)
	{	
		$update_status = new MessageModel(); //servira pour changer le statut du message (lu/non lu)

		//Sert pour afficher le message souhaité
		if(!is_numeric($id) || empty($id)){
			$this->showNotFound();
		}else{

			$getMessage  = new MessageModel();
			$viewMessage = $getMessage->findOneMessage($id);
		}

		//Changement du statut du message
		if(isset($_GET['read'])){

			//On change le statut du message
			$status = [
				'statut' => 'Lu'
			];
			$updated = $update_status->update($status,$id);

			$this->redirectToRoute('listMessage'); //et on redirige

		}elseif(isset($_GET['not-read'])){

			$status = [
				'statut' => 'NonLu'
			];
			$updated = $update_status->update($status,$id);

			$this->redirectToRoute('listMessage');	
		}

		/********** GESTION DE LA REPONSE AU MESSAGE **********/

		$post = [];
		$errors = [];
		$success = false;

		if(!is_numeric($id) || empty($id)){
			$this->showNotFound();
		}else{

			$getMessage  = new MessageModel();
			$viewMessage = $getMessage->findOneMessage($id);
		}

		if(!empty($_POST)){

			foreach ($_POST as $key => $value) {
				$post[$key] = trim(strip_tags($value));
			}

			if(!v::notEmpty()->email()->validate($post['email'])){
				$errors[] = 'L\'adresse email n\'est pas valide';
			}

			if(!v::notEmpty()->length(5,null)->validate($post['subject'])){
				$errors[] = 'Le sujet du message doit au moins comporter 5 caractères';
			}

			if(!v::notEmpty()->length(10,null)->validate($post['content'])){
				$errors[] = 'Le message doit au moins comporter 10 caractères';
			}

			if(count($errors) === 0){
				$sendMail = new PHPMailer;

				$contentEmail = nl2br($post['content']);

				$sendMail->isSMTP();                                      
				$sendMail->Host = 'ssl0.ovh.net';  									// Hôte du SMTP
				$sendMail->SMTPAuth = true;                               				// SMTP Authentification
				$sendMail->Username = 'sav@klickit.fr'; //Username         				// SMTP username
				$sendMail->Password = 'silSAV33@'; //mot de passe                    	 				// SMTP password
				$sendMail->SMTPSecure = 'tls';                         					// Enable TLS encryption, `ssl` also accepted
				$sendMail->Port = 587;                                					// TCP port to connect to
				$sendMail->CharSet = 'UTF-8';

				$sendMail->setFrom('sav@klickit.fr', 'Klickit');		  		//Expéditeur
				
				$sendMail->addAddress($viewMessage['email'], $viewMessage['username']); 	   	//Destinataire
				$sendMail->addCC($post['email']); 					//Copie envoyer à l'adresse souhaitée du mail

				$sendMail->Subject = $post['subject'];
				$sendMail->Body    = $contentEmail; //On envoi le message éventuellement en HTML
				$sendMail->AltBody = $contentEmail; //On envoi le message sans HTML

				if(!$sendMail->send()){
					$errors[] = 'Erreur lors de l\'envoi du mail';

				}else{
					$success = true;
					$status = [
						'Statut' => 'Lu', 
					];
					$updated = $update_status->update($status, $id);
				}
			}

		}

		//On envoie le tableau $data qui contiendra les infos d'un message et le changement de statut
		$data = [
			'message'	=> $viewMessage,
			'errors'	=> implode('<br>',$errors),
			'success'	=> $success,
		];

		if(!empty($this->getUser())){

			$verification = new AuthorizationModel();
			
			if ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
			else {
				$this->show('back/Message/viewMessage', $data);
			}
		}
		else {
			$this->redirectToRoute('login');
		}
	}
}