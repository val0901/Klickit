<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\GuestbookModel;
use \W\Security\AuthorizationModel;

class FrontGuestbookController extends Controller 
{


	/**
	 * formulaire du Livre d'Or
	 */
	public function affGuestbook()
	{
		$this->show('front/User/guestbook');
	}


}