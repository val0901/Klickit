<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\AdminModel;
use \W\Security\AuthorizationModel;

class AdminController extends Controller 
{
	/**
	 * Liste de tout les admin
	 */
	public function listAdmin()
	{
		$this->show('back/Admin/listAdmin');
	}

	/**
	 * Ajout d'Admin
	 */
	public function addAdmin()
	{
		$this->show('back/Admin/addAdmin');
	}

	/**
	 * Mise à jour d'un admin
	 */
	public function updateAdmin()
	{
		$this->show('back/Admin/updateAdmin');
	}

	/**
	 * Suppression d'un Admin
	 */
	public function deleteAdmin()
	{
		$this->show('back/Admin/deleteAdmin');
	}
}