<?php
namespace Model;

use \Model\UserModel;


class OrdersModel extends \W\Model\Model 
{

	public function findAllWithUsers()
	{

		$sql = 'SELECT ' .$this->table.'.*, u.firstname, u.lastname FROM ' . $this->table . ' LEFT JOIN user AS u ON '.$this->table.'.idMember = u.id ORDER BY ' .$this->table.'.date_creation DESC LIMIT 15';



		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
	}


}