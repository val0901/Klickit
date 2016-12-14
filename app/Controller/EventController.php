<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\EventModel;
use \W\Security\AuthorizationModel;

class EventController extends Controller 
{
	/**
	 * Liste des évènements 
	 */
	public function listEvent()
	{

		$list = new EventModel();
		$event = $list->findAll();

		$data = [
			'event'	=> $event,
		];

		if(!empty($_SESSION)){

			$this->show('back/Event/listEvent', $data);

			if($_SESSION['role'] == 'Utilisateur') {
				$this->redirectToRoute('front_index');
			}
		}
		else {
			$this->redirectToRoute('back_login');
		}
	}

	/**
	 * Ajout d'évènement
	 */
	public function addEvent()
	{
		$this->show('back/Event/addEvent');
	}

	/**
	 * Modification d'évènement
	 */
	public function updateEvent()
	{
		$this->show('back/Event/updateEvent');
	}
}