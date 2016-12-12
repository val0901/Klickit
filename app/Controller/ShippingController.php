<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\ShippingModel;
use \W\Security\AuthorizationModel;

class ShippingController extends Controller 
{
	/**
	 * Liste des options d'envoie
	 */
	public function listShipping()
	{
		$this->show('back/Shipping/listShipping');
	}

	/**
	 * Ajout d'option d'envoie
	 */
	public function addShipping()
	{
		$this->show('back/Shipping/addShipping');
	}

	/**
	 * Suppression d'option d'envoie
	 */
	public function deleteShipping()
	{
		$this->show('back/Shipping/deleteShipping');
	}
}