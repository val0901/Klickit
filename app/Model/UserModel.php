<?php
namespace Model;

use \W\Model\UsersModel;

class UserModel extends \W\Model\UsersModel 
{
	public function findAllUsers($page, $max)
	{
		
		$debut = ($page - 1) * $max;

		$sql = 'SELECT * FROM '.$this->table.' ORDER BY lastname ASC LIMIT :debut, :max';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':max', $max, \PDO::PARAM_INT);
		$sth->bindValue(':debut', $debut, \PDO::PARAM_INT);
		
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