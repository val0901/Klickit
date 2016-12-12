<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\AdminModel;
use \W\Security\AuthorizationModel;

class AdminController extends Controller 
{
	public function listAdmin()
	{
		$this->show('back/Admin/listAdmin');
	}

	public function addAdmin()
	{
		$this->show('back/Admin/addAdmin');
	}

	public function updateAdmin()
	{
		$this->show('back/Admin/updateAdmin');
	}

	public function deleteAdmin()
	{
		$this->show('back/Admin/deleteAdmin');
	}
}