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
		$this->show('back/Event/listEvent');
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

	/**
	 * Suppression d'évènement
	 */
	public function deleteEvent()
	{
		$this->show('back/Event/deleteEvent');
	}
}