<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Model\UsersModel;
use \W\Security\AuthentificationModel;

use \Respect\Validation\Validator as v; 

class AjaxController extends Controller
{	
	/**
	* Déconnexion en ajax
	*/
	public function logout()
	{
		$logout = new AuthentificationModel();
			
		if($logout->logUserOut()) {
			$this->showJson(['code' => 'ok']);
		}
	}

	/**
	* Effacer un utilisateur en ajax
	* @param int $id le membre qu'on veut effacer
	*/
	public function deleteUser($id)
	{
		if(!is_numeric($id) || empty($id)){
			$this->showNotFound();
		}else{
			$delete  = new UsersModel();
			if($delete->delete($id)){
				$this->showJson(['code'	=> 'ok']);
			}

		}
	}
}