<?php
namespace Model;

use \Model\UserModel;

class MessageModel extends \W\Model\Model 
{
	/**
	* Cherche tous les messages avec le username et l'email de l'expéditeur
	*/
	public function findAllMessage($page, $max)
	{
		$debut = ($page - 1) * $max;
		$sql = 'SELECT ' .$this->table.'.* FROM ' . $this->table.' ORDER BY ' .$this->table.'.id DESC LIMIT :debut, :max';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':max', $max, \PDO::PARAM_INT);
		$sth->bindValue(':debut', $debut, \PDO::PARAM_INT);

		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	* Cherche un seul message en fonction d'un id
	*/
	public function findOneMessage($id)
	{
		$sql = 'SELECT * FROM ' .$this->table.' WHERE '.$this->table.'.id = :id';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);
		$sth->execute();

		return $sth->fetch();
	}

	/**
	*retourne une liste de 15 messages
	*/
	public function find15Messages()
	{

		$sql = 'SELECT ' .$this->table.'.*, u.username, u.email FROM ' . $this->table . ' LEFT JOIN user AS u ON '.$this->table.'.idMember = u.id ORDER BY ' .$this->table.'.date_creation DESC LIMIT 15';

		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
	}

	/** 
	*Méthode pour compter le nombre de résultat 
	* @return le nombre de lignes contenu ds la table
	*/

	public function countResults()
	{
    
    $sql = 'SELECT COUNT(*) as total FROM ' . $this->table;

    $sth = $this->dbh->prepare($sql);
    $sth->execute();

    $result = $sth->fetch();

    return $result['total'];
	}

}