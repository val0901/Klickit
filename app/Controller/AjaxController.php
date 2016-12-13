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
	*/
	public function deleteUser()
	{

		if(!empty($_POST)){

			if(is_numeric($_POST['id_user'])){
				$userModel  = new UsersModel();
				$delete = $userModel->delete($_POST['id_user']);

				if($delete){
					$json = ['code' => 'ok'];
				}
			}
			else {
				$json = ['code' => 'error'];
			}
		}


		$this->showJson(['code'	=> 'ok']);

	}

	/**
	 * Effacer un article en Ajax
	 */
	public function deleteItem()
	{
		if(!empty($_POST))
	}
}