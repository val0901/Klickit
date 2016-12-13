<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Model\UsersModel;
use \W\Security\AuthentificationModel;

use \Respect\Validation\Validator as v; 

class AjaxController extends Controller
{
	public function logout()
	{
		if(isset($_POST['logout']) && !empty($_SESSION)) {
			
			$logout = new AuthentificationModel();
			
			if($logout->logUserOut()) {
				$this->showJson(['code' => 'ok']);
			}
		}
	}
}