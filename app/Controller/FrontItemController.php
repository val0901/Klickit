<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\ItemModel;
use \W\Security\AuthorizationModel;
use \W\Security\AuthentificationModel;
use \Respect\Validation\Validator as v;

class FrontItemController extends Controller 
{

	public function listItemClassics()
	{
		$this->show('front/Items/classics');
	}
	public function listItemCustoms()
	{
		$this->show('front/Items/customs');
	}
	public function listItemDivers()
	{
		$this->show('front/Items/divers');
	}
	public function listItemPieces()
	{
		$this->show('front/Items/pieces');
	}


}