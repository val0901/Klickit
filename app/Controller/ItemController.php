<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\ItemModel;
use \W\Security\AuthorizationModel;

class ItemController extends Controller 
{
	public function listItem()
	{
		$this->show('back/Item/listItem');
	}

	public function addItem()
	{
		$this->show('back/Item/addItem');
	}

	public function updateItem()
	{
		$this->show('back/Item/updateItem');
	}

	public function deleteItem()
	{
		$this->show('back/Item/deleteItem');
	}
}