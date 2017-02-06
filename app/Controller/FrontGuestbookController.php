<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\GuestbookModel;
use \W\Security\AuthorizationModel;
use \Respect\Validation\Validator as v;

class FrontGuestbookController extends MasterController 
{


	/**
	 * formulaire du Livre d'Or
	 */
	public function affGuestbook()
	{
		$post = [];
		$errors = [];
		$insert = new GuestbookModel();
		$success = false;

		if(!empty($_POST)){
			
			//On nettoie les entrées du formulaire
			foreach ($_POST as $key => $value) {
				$post[$key] = trim(strip_tags($value));
			}

			//Contrôle des entrées du formulaire

			if(!v::notEmpty()->length(10,500)->validate($post['content'])){
				$errors[] = 'Le commentaire doit comporter entre 10 et 500 caractères';
			}

			if(count($errors) === 0){
				
				$dataInsert = [
					'username' 		=> $_SESSION['user']['username'],
					'email' 		=> $_SESSION['user']['email'],
					'id_member' 	=> $_SESSION['user']['id'],
					'date_creation' => date('Y-m-d H:i:s'),
					'published'		=> 'non',
					'content'		=> $post['content'],
				];

				if($insert->insert($dataInsert)){
					$success = true;
				}else{
					$errors[] = 'Erreur lors de l\'ajout en base de données';
				}
			}

		}
			$params = [
			'success'	=> $success,
			'errors'	=> $errors,
			];	

		if(!empty($this->getUser())){
			$this->showStuff('front/User/guestbook', $params);
		}else {
			$this->redirectToRoute('login');
		}
	}


}