<?php
namespace Model;

class GuestbookModel extends \W\Model\Model 
{

	/*retourne tous les messages*/
	public function findAllMessage()
	{
		$sql = 'SELECT ' .$this->table.'.*, u.firstname, u.lastname, u.username FROM ' . $this->table . ' LEFT JOIN user AS u ON '.$this->table.'.id_member = u.id ORDER BY ' .$this->table.'.id DESC ';

		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
	}

	/*retourne un message ene focntion de l'id*/
	public function viewMessage($id)
	{
		$sql = 'SELECT ' .$this->table.'.*, u.email, u.firstname, u.lastname FROM ' . $this->table . ' LEFT JOIN user AS u ON '.$this->table.'.id_member = u.id WHERE '.$this->table.'.id = :id';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);
		$sth->execute();

		return $sth->fetch();
	}

	/*Cherche les 15 derniers commentaires*/
	public function find15Comments()
	{

		$sql = 'SELECT ' .$this->table.'.*, u.firstname, u.lastname, u.username FROM ' . $this->table . ' LEFT JOIN user AS u ON '.$this->table.'.id_member = u.id ORDER BY ' .$this->table.'.date_creation DESC LIMIT 15';

		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
	}
}