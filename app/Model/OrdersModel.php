<?php
namespace Model;

use \Model\UserModel;


class OrdersModel extends \W\Model\Model 
{

	public function findAllWithUsers()
	{
		$sql = 'SELECT ' .$this->table.'.* FROM ' . $this->table . ' LEFT JOIN user AS u ON '.$this->table.'.idMember = u.id';

		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
	}


}