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
		$sql = 'SELECT * FROM '.$this->table.' ORDER BY date_creation DESC LIMIT 0, 15';

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

	/**
	 * Recherche d'utilisateur
	 */
	public function searchMessage($search)
	{
		$sql = '';

		if(isset($search) && !empty($search)) {
			$sql = ' WHERE username LIKE :search OR email LIKE :search OR subject LIKE :search OR content LIKE :search OR statut LIKE :search';
		}

		$query = 'SELECT * FROM '.$this->table.$sql;

		$sth = $this->dbh->prepare($query);

		if(!empty($sql)) {
			$sth->bindValue(':search', '%'.$search.'%');
		}

		if($sth->execute()) {
			return $sth->fetchAll();
		}
	}
}