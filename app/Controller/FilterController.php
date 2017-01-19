<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\FilterModel;
use \W\Security\AuthorizationModel;
use \Respect\Validation\Validator as v;

class FilterController extends Controller 
{
	/*Liste des filtres*/
	public function listFilter()
	{
		$filter = new FilterModel();
		$list = $filter->findAll();

		$data = [
			'filters'	=> $list
		];

		if(!empty($this->getUser())){

			$verification = new AuthorizationModel();

			if ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
			else {
				$this->show('back/Filter/listFilter',$data);
			}
		}
		else {
			$this->redirectToRoute('login');
		}
	}

	/*Ajout des filtres*/
	public function addFilter()
	{
		$post = [];
		$errors = [];
		$insert = new FilterModel();
		$success = false;

		if(!empty($_POST)){

			foreach ($_POST as $key => $value) {
				$post[$key] = trim(strip_tags($value));
			}

			if(strlen($post['name']) < 3 || strlen($post['name']) > 25){
				$errors[] = 'Le nom du filtre doit comporter entre 3 et 25 caractères';
			}

			if(count($errors) === 0){
				$dataInsert = [
					'name'		=> $post['name'],
				];

				if($insert->insert($dataInsert)){
					$success = true;
				}else{
					$errors[] = 'Erreur lors de l\'ajout en base de données';
				}
			}
		}

		$data = [
			'success'	=> $success,
			'errors'	=> $errors,
		];

		if(!empty($this->getUser())){

			$verification = new AuthorizationModel();

			if ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
			else {
				$this->show('back/Filter/addFilter', $data);
			}
		}
		else {
			$this->redirectToRoute('login');
		}
		
	}

	/*Mise à jour des filtres*/
	public function updateFilter($id)
	{
		$success = false;
		$post = [];
		$errors = [];
		if(!is_numeric($id) || empty($id)){
			$this->showNotFound();
		}else{
			$update  = new FilterModel();
			$filter = $update->find($id);
		}

		if(!empty($_POST)){
			
			//On nettoie les entrées du formulaire
			foreach ($_POST as $key => $value) {
				$post[$key] = trim(strip_tags($value));
			}

			//Contrôle des entrées du formulaire

			if(!empty($post['name']) && isset($post['name'])){
				if(!v::notEmpty()->length(3,25)->validate($post['name'])){
					$errors[] = 'Le nom du filtre doit comporter entre 3 et 25 caractères';
				}
				else{
					$filter['name'] = $post['name'];
				}
			}
				
			if(count($errors) === 0){

				if($update->update($filter, $id)){
					$success = true;
				}
				else{
					$errors[] = 'Erreur lors de l\'ajout en base de données';
				}
				
			}
		}

		$data = [
			'filter'	=> $filter, 
			'success'	=> $success, //success et errors vont nous servir à afficher les messages d'erreur ou de réussite
			'errors'	=> $errors
		];	

		if(!empty($this->getUser())){

			$verification = new AuthorizationModel();

			if ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
			else {
				$this->show('back/Filter/updateFilter', $data);
			}
		}
		else {
			$this->redirectToRoute('login');
		}

	}

}