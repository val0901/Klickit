<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\GuestbookModel;
use \W\Security\AuthorizationModel;

class GuestbookController extends Controller 
{


/******************* BACK *********************/

	/**
	 * Liste des messages du Livre d'Or
	 */
	public function listGuestbook()
	{	
		$guestbookModel = new GuestbookModel();
		$list = $guestbookModel->findAllMessage();

		$data = [
			'messages'	=> $list
		];

		if(!empty($_SESSION)){

			$this->show('back/Guestbook/listGuestbook', $data);

			if($_SESSION['role'] == 'Utilisateur') {
				$this->redirectToRoute('front_index');
			}
		}
		else {
			$this->redirectToRoute('back_login');
		}
		
	}

	/**
	* Permet de publier ou non un commentaire laissé par les clients
	*/
	public function moderation($id)
	{	
		//Va servir pour changer le statut
		$publishing = new GuestbookModel();

		//Affichage du message
		if(!is_numeric($id) || empty($id)){
			$this->showNotFound();
		}else{
			$guestbook = new GuestbookModel(); //Sert pour afficher le message
			$message = $guestbook->viewMessage($id);
			$data = [
				'message' => $message
			];
		}

		//Publication du message ou non
		if(isset($_POST['publish'])){ //Si on décide de le publier, on change le statut à oui, sinon non

			$published = [
				'published' => 'oui'
			];

			$is_publish = $publishing->update($published,$id);
			$this->redirectToRoute('listGuestbook');
		
		}elseif(isset($_POST['no-publish'])){
			
			$published = [
				'published' => 'non'
			];

			$is_publish = $publishing->update($published,$id);
			$this->redirectToRoute('listGuestbook');
		}

		if(!empty($_SESSION)){

			$this->show('back/Guestbook/moderation', $data);

			if($_SESSION['role'] == 'Utilisateur') {
				$this->redirectToRoute('front_index');
			}
		}
		else {
			$this->redirectToRoute('back_login');
		}
	}

	/**
	 * Modification du Livre d'Or
	 */
	public function updateGuestbook()
	{
		$this->show('back/Guestbook/updateGuestbook');
	}

	/**
	 * Suppression des messages du Livre d'Or
	 */
	public function deleteGuestbook()
	{
		$this->show('back/Guestbook/deleteGuestbook');
	}

}