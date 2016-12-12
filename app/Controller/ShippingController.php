<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\ShippingModel;
use \W\Security\AuthorizationModel;

class ShippingController extends Controller 
{
	public function listShipping()
	{
		$this->show('back/Shipping/listShipping');
	}

	public function addShipping()
	{
		$this->show('back/Shipping/addShipping');
	}

	public function deleteShipping()
	{
		$this->show('back/Shipping/deleteShipping');
	}
}