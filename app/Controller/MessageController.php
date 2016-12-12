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
		$this->show('back/Message/listMessage');
	}

	/**
	 * Vu unique d'un message avec possibilité de réponse
	 */
	public function viewMessage()
	{
		$this->show('back/Message/viewMessage');
	}

	/**
	 * Suppression de message
	 */
	public function deleteMessage()
	{
		$this->show('back/Message/deleteMessage');
	}
}