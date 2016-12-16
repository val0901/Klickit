<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \Model\ResetModel;
use \Model\UserModel;
use \PHPMailer;

class ResetController extends Controller
{
	
	public function reset_pwd($id, $token)
	{	

		if(isset($id) && !empty($id) && isset($token) && !empty($token)){

			

			//Insertion du nouveau mot de passe
			$update = new UserModel;
			$post = [];
			$hash = new AuthentificationModel;
			$success = false;
			$error = '';	

			if(!empty($_POST)){
				
				foreach($_POST as $key => $value){
					$post[$key] =trim(strip_tags($value));	
				}

				if(strlen($post['password']) < 8 || strlen($post['password']) > 20){
					$error = 'Votre mot de passe doit comporter entre 8 et 20 caractères';
				}

				if(empty($error)){	
					$newPassword = [
						'password'	=>	$hash->hashPassword($post['password'])
					]; 	

					if($update->update($newPassword, $id)){
						$success = true;
					}
					else{
						$error = 'Erreur lors de la mise à jour du mot de passe';
					}
				}

			}
			$data = ['success'=>$success, 'error'=>$error];
			$this->show('back/reset_password',$data);

		}		
		
	}

}