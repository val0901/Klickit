<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\EventModel;
use \W\Security\AuthorizationModel;
use \W\Security\AuthentificationModel;
use \Respect\Validation\Validator as v;
use \Intervention\Image\ImageManagerStatic as Image;

class FrontEventController extends MasterController 
{
	
	/**
	*Page créer un évènement
	*/
	public function createEvent()
	{
		$this->redirectToRoute('front_contact');
	}

}