<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\MessageModel;
use \W\Security\AuthorizationModel;

class MessageController extends Controller 
{
	public function listMessage()
	{
		$this->show('back/Message/listMessage');
	}

	public function viewMessage()
	{
		$this->show('back/Message/viewMessage');
	}

	public function deleteMessage()
	{
		$this->show('back/Message/deleteMessage');
	}
}