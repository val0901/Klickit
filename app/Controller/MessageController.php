<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\MessageModel;
use \W\Security\AuthorizationModel;

class MessageController extends Controller 
{
	/**
	* Liste des messages
	*/
	public function listMessage()
	{	

		$list = new MessageModel();
		$messages = $list->findAllMessage();

		$data = [
			'messages'	=> $messages,
		];

		//On sécurise la page, seulement accessible à l'Admin
		if(!empty($_SESSION)){

			$this->show('back/Message/listMessage', $data);

			if($_SESSION['role'] == 'Utilisateur') {
				$this->redirectToRoute('front_index');
			}
		}
		else {
			$this->redirectToRoute('back_login');
		}
		
	}

	/**
	 * Vue unique d'un message avec changement de statut
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
		if(isset($_POST['read'])){

			//On change le statut du message
			$status = [
				'statut' => 'Lu'
			];
			$updated = $update_status->update($status,$id);

			$this->redirectToRoute('listMessage'); //et on redirige

		}elseif(isset($_POST['not-read'])){

			$status = [
				'statut' => 'Non lu'
			];
			$updated = $update_status->update($status,$id);

			$this->redirectToRoute('listMessage');
		}

		//On envoie le tableau $data qui contiendra les infos d'un message et le changement de statut
		$data = [
			'message'	=> $viewMessage,
		];

		if(!empty($_SESSION)){

			$this->show('back/Message/viewMessage', $data);

			if($_SESSION['role'] == 'Utilisateur') {
				$this->redirectToRoute('front_index');
			}
		}
		else {
			$this->redirectToRoute('back_login');
		}
	}

	/**
	 * Suppression de message
	 */
	public function deleteMessage()
	{
		$this->show('back/Message/deleteMessage');
	}

	
}