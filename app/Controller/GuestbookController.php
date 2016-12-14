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
		$list = $guestbookModel->findAll();

		$data = [
			'guestbook'	=> $list
		];

		$this->show('back/Guestbook/listGuestbook', $data);
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