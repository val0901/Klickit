<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UserModel;
use \W\Security\AuthorizationModel;

class UserController extends Controller 
{
	/**
	 * Liste des utilisateurs
	 */
	public function listUser()
	{
		$this->show('back/User/listUser');
	}

	/**
	 * Ajout d'utilisateur
	 */
	public function addUser()
	{
		$this->show('back/User/addUser');
	}

	/**
	 * Mise à jour des utilisateurs
	 */
	public function updateUser()
	{
		$this->show('back/User/updateUser');
	}

	/**
	 * Suppression d'utilisateur
	 */
	public function deleteUser()
	{
		$this->show('back/User/deleteUser');
	}
}