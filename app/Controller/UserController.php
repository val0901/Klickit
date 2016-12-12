<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UserModel;
use \W\Security\AuthorizationModel;

class UserController extends Controller 
{
	public function listUser()
	{
		$this->show('back/User/add');
	}
}