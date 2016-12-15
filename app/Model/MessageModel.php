<?php
namespace Model;

use \Model\UserModel;

class MessageModel extends \W\Model\Model 
{
	/**
	* Cherche tous les messages avec le username et l'email de l'expéditeur
	*/
	public function findAllMessage()
	{
		$sql = 'SELECT ' .$this->table.'.*, u.username, u.email FROM ' . $this->table . ' LEFT JOIN user AS u ON '.$this->table.'.idMember = u.id ORDER BY ' .$this->table.'.id DESC ';

		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	* Cherche un seul message en fonction d'un id
	*/
	public function findOneMessage($id)
	{
		$sql = 'SELECT ' .$this->table.'.*, user.email, user.firstname, user.lastname FROM ' . $this->table . ' LEFT JOIN user ON '.$this->table.'.idMember = user.id WHERE '.$this->table.'.id = :id';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);
		$sth->execute();

		return $sth->fetch();
	}

	/*retourne une liste de 15 messages*/
	public function find15Messages()
	{

		$sql = 'SELECT ' .$this->table.'.*, u.username, u.email FROM ' . $this->table . ' LEFT JOIN user AS u ON '.$this->table.'.idMember = u.id ORDER BY ' .$this->table.'.date_creation DESC LIMIT 15';

		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
	}

}