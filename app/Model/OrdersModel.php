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

	public function findItems()
	{

		$sql = 'SELECT ' .$this->table.'.*, i.name, i.quantity, i.price, i.newPrice FROM ' . $this->table . ' LEFT JOIN item AS i ON '.$this->table.'.contenu = i.id';

		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
	}


	/*Requête sur la table orders avec jointure sur la table user*/
	public function findAllOrders($page, $max)
	{
		//on definit la page de démarrage
		$debut = ($page - 1) * $max;

		// requête avec jointure où on definit les variables de la page de démarrage($debut) et là le nombre de lignes par page($max)
		$sql = 'SELECT ' .$this->table.'.*, u.firstname, u.lastname,u.social_title, u.adress, u.zipcode,u.city FROM ' . $this->table . ' LEFT JOIN user AS u ON '.$this->table.'.idMember = u.id ORDER BY ' .$this->table.'.date_creation DESC LIMIT :debut, :max';

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