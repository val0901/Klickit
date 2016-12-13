<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\GuestbookModel;
use \W\Security\AuthorizationModel;

class GuestbookController extends Controller 
{


	/**
	 * Suppression des messages du Livre d'Or
	 */
	public function affGuestbook()
	{
		$this->show('front/User/guestbook');
	}


}