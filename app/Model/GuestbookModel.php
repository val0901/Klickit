<?php
namespace Model;

use \W\Model\UserModel;

class GuestbookModel extends \W\Model\Model 
{

	/*retourne tous les messages avec jointure et pagination*/
	public function findAllMessage($page, $max)
	{
		$debut = ($page - 1) * $max;

		$sql = 'SELECT ' .$this->table.'.*, u.firstname, u.lastname, u.username FROM ' . $this->table . ' LEFT JOIN user AS u ON '.$this->table.'.id_member = u.id ORDER BY ' .$this->table. '.id DESC LIMIT :debut, :max';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':max', $max, \PDO::PARAM_INT);
		$sth->bindValue(':debut', $debut, \PDO::PARAM_INT);

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

		/*retourne tous les messages*/
		public function findAllMessageFront()
		{
			$sql = 'SELECT ' .$this->table.'.*, u.social_title, u.firstname, u.lastname, u.username FROM ' . $this->table . ' LEFT JOIN user AS u ON '.$this->table.'.id_member = u.id ORDER BY ' .$this->table. '.id';

			$sth = $this->dbh->prepare($sql);		

			$sth->execute();

			return $sth->fetchAll();
		}
}