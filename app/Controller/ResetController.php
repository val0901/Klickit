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

			$verify_token = new ResetModel;
			$getInfos = $verify_token->find($id);

			if($getInfos['date_expire'] == date('Y-m-d H:i:s',strtotime($getInfos['date_expire']+'2 days'))){
				$error = 'Le jeton a expiré. Pour réinitialiser le mot de passe, veuillez cliquer <a href="'.$this->url('back_forgot_pwd').'">ici</a>';
			}

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