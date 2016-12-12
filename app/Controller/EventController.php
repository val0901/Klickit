<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\EventModel;
use \W\Security\AuthorizationModel;

class EventController extends Controller 
{
	public function listEvent()
	{
		$this->show('back/Event/listEvent');
	}

	public function addEvent()
	{
		$this->show('back/Event/addEvent');
	}

	public function updateEvent()
	{
		$this->show('back/Event/updateEvent');
	}

	public function deleteEvent()
	{
		$this->show('back/Event/deleteEvent');
	}
}