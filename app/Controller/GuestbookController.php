<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\GuestbookModel;
use \W\Security\AuthorizationModel;

class GuestbookController extends Controller 
{
	public function listGuestbook()
	{
		$this->show('back/Guestbook/listGuestbook');
	}

	public function updateGuestbook()
	{
		$this->show('back/Guestbook/updateGuestbook');
	}

	public function deleteGuestbook()
	{
		$this->show('back/Guestbook/deleteGuestbook');
	}
}