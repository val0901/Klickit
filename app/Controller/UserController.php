<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UserModel;
use \W\Security\AuthorizationModel;

class UserController extends Controller 
{
	public function listUser()
	{
		$this->show('back/User/listUser');
	}

	public function addUser()
	{
		$this->show('back/User/addUser');
	}

	public function updateUser()
	{
		$this->show('back/User/updateUser');
	}

	public function deleteUser()
	{
		$this->show('back/User/deleteUser');
	}
}