<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\ResetModel;
use \PHPMailer;

class ResetController extends Controller
{
	
	public function reset_pwd($email, $token)
	{	
		$email = $_GET['email'];
		$token = $_GET['token'];

		if(isset($email) && !empty($email) && isset($token) && !empty($token)){

			$getInfosReset = new ResetModel;
			$this->show('back/reset_password');

		}
		
		
	}

}