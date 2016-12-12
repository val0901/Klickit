<?php
namespace Model;

use \W\Controller\Controller;
use \Model\Model;
use \Model\UserModel;




class OrdersModel extends \W\Model\Model 
{

	public function index
	{

		$sql = 'SELECT o.*, u.firstname FROM orders AS o LEFT JOIN user AS u ON u.id = o.id_user WHERE o.id=:id';
		$sql= new Model;
		$orders = $list->findAll();

		
	}


}