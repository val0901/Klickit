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

	/* Requête pour trouver chaque commande par client*/
	public function findOrdersAndCustom($id)
	{
		$sql = 'SELECT ' .$this->table.'.*, u.* FROM ' . $this->table . ' LEFT JOIN user AS u ON '.$this->table.'.idMember = u.id WHERE ' .$this->table.'.id = :id';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);
		$sth->execute();

		return $sth->fetchAll();
	}

	/* Requete pour trouver le prix en focntion de l'id*/
	public function findPrice($id)
	{
		$sql = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);
		$sth->execute();

		return $sth->fetchAll();

	}

	/**
	 * Recherche de commande
	 */
	public function searchOrder($search)
	{
		$sql = '';

		if(isset($search) && !empty($search)) {
			$sql = ' WHERE statut LIKE :search OR payment';
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

	/**
	 * Recherche d'une commande par id member et order_process
	 */
	public function processOrder($id)
	{
		$sql = 'SELECT * FROM '.$this->table.' WHERE idMember = :id AND order_process = "EnCours"';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);
		$sth->execute();

		return $sth->fetch();
	}

	/**
	 * Mise à jour d'une commande
	 */
	public function updateAddressOrder($id_member, $address, $zipcode, $city, $country)
	{
		$sql = 'UPDATE '.$this->table.' SET address = :address, zipcode = :zipcode, city = :city, country = :country WHERE idMember = :id AND order_process = "EnCours"';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':address', $address);
		$sth->bindValue(':zipcode', $zipcode);
		$sth->bindValue(':city', $city);
		$sth->bindValue(':country', $country);
		$sth->bindValue(':id', $id);

		if($sth->execute()){
			return true;
		}

		return false;
	}
}