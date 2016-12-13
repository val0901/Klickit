<?php
namespace Model;

use \Model\UserModel;


class OrdersModel extends \W\Model\Model 
{

	/*Requête sur la table orders avec jointure sur la table user*/
	public function findAllWithUsers()
	{

		$sql = 'SELECT ' .$this->table.'.*, u.firstname, u.lastname FROM ' . $this->table . ' LEFT JOIN user AS u ON '.$this->table.'.idMember = u.id ORDER BY ' .$this->table.'.date_creation DESC LIMIT 15';



		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
	}

	/*Requête sur la table orders avec jointure sur la table user*/
	public function findAllOrders()
	{

		$sql = 'SELECT ' .$this->table.'.*, u.firstname, u.lastname,u.social_title, u.adress, u.zipcode,u.city FROM ' . $this->table . ' LEFT JOIN user AS u ON '.$this->table.'.idMember = u.id ORDER BY ' .$this->table.'.date_creation DESC ';



		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
	}


}