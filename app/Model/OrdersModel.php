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
			$sql = ' WHERE '.$this->table.'.id LIKE :search OR user.firstname LIKE :search OR user.lastname LIKE :search';
		}

		$query = 'SELECT user.*, '.$this->table.'.* FROM '.$this->table.' LEFT JOIN user ON '.$this->table.'.idMember = user.id'.$sql;

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

	public function updateOrder($id, $contenu, $quantity, $sub_total, $shipping, $total)
	{
		$sql = 'UPDATE '.$this->table.' SET contenu = :contenu, quantity = :quantity, date_creation = :date_creation, sub_total = :sub_total, shipping = :shipping, total = :total WHERE idMember = :id AND order_process = "EnCours"';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);
		$sth->bindValue(':contenu', $contenu);
		$sth->bindValue(':quantity', $quantity);
		$sth->bindValue(':date_creation', date('Y-m-d H:i:s'));
		$sth->bindValue(':sub_total', $sub_total);
		$sth->bindValue(':shipping', $shipping);
		$sth->bindValue(':total', $total);

		if($sth->execute()){
			return true;
		}

		return false;

	}

	/**
	 * Mise à jour de l'adresse d'une commande
	 */
	public function updateAddressOrder($id_member, $address, $zipcode, $city, $country)
	{
		$sql = 'UPDATE '.$this->table.' SET address = :address, zipcode = :zipcode, city = :city, country = :country WHERE idMember = :id AND order_process = "EnCours"';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':address', $address);
		$sth->bindValue(':zipcode', $zipcode);
		$sth->bindValue(':city', $city);
		$sth->bindValue(':country', $country);
		$sth->bindValue(':id', $id_member);

		if($sth->execute()){
			return true;
		}

		return false;
	}

	/**
	 * Mise à jour du paiement d'une commande
	 */
	public function updatePaymentOrder($id_member, $payment)
	{
		$sql = 'UPDATE '.$this->table.' SET payment = :payment, order_process = "Fini" WHERE idMember = :id AND order_process = "EnCours"';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':payment', $payment);
		$sth->bindValue(':id', $id_member);

		if($sth->execute()){
			return true;
		}

		return false;
	}

	/**
	* Affichage des commandes 
	*/
	public function showOrders($id)
	{

		$sql = 'SELECT * FROM '.$this->table.' WHERE idMember = :idMember AND order_process = "Fini"';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':idMember', $id);
		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	* Affichage d'une seul commande pour l'utilisateur
	*/
	public function findOrderByID($id_member, $id_order)
	{
		$sql = 'SELECT * FROM '.$this->table.' WHERE idMember = :id_member AND id = :id_order';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_member', $id_member);
		$sth->bindValue(':id_order', $id_order);
		$sth->execute();

		return $sth->fetch();
	}

	/**
	 * Mise à jour du statut de la commande
	 */
	public function updateStatutOrder($id, $statut)
	{
		$sql = 'UPDATE '.$this->table.' SET statut = :statut WHERE id = :id';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':statut', $statut);
		$sth->bindValue(':id', $id);

		if($sth->execute()){
			return true;
		}

		return false;
	}

	public function findSalesRevenue()
	{
		$sql = 'SELECT * from '.$this->table.' WHERE statut = "expedie"';

		$sth = $this->dbh->prepare($sql);

		if($sth->execute()){
			return true;
		}

		return false;
	}
}