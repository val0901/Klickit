<?php
namespace Model;

class SalesrevenueModel extends \W\Model\Model 
{
	/*Requête popour afficher le CA*/
	public function findAllSales($page, $max)
	{
		//on definit la page de démarrage
		$debut = ($page - 1) * $max;

		// requête sur la table  où on definit les variables de la page de démarrage($debut) et là le nombre de lignes par page($max)
		$sql = 'SELECT * from '.$this->table. ' ORDER BY id DESC LIMIT :debut, :max '; 

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':max', $max, \PDO::PARAM_INT);
		$sth->bindValue(':debut', $debut, \PDO::PARAM_INT);
		
		$sth->execute(); 

		return $sth->fetchAll();	
	}

	/**
	 * Requête select toute la table sans pagination
	 */
	public function findSales()
	{
		$sql = 'SELECT * FROM '.$this->table;

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
	 * Requête pour vérifier si le mois et l'année existe déjà
	 */
	public function monthAndYear($month, $year)
	{
		$sql = 'SELECT revenue FROM '.$this->table.' WHERE month = :month AND year = :year';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':month', $month);
		$sth->bindValue(':year', $year);
		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	 * Requête de mise à jour en fonction du mois et de l'année
	 */
	public function updateRevenu($month, $year, $revenue)
	{
		$sql = 'UPDATE '.$this->table.' SET revenue = :revenue WHERE month = :month AND year = :year';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':revenue', $revenue);
		$sth->bindValue(':month', $month);
		$sth->bindValue(':year', $year);
		
		if($sth->execute()){
			return true;
		}
	}

	/**
	 * Requête de recherche pour le chiffre d'affaire
	 */
	public function searchSales($search)
	{
		$sql = '';

		if(isset($search) && !empty($search)) {
			$sql = ' WHERE month LIKE :search OR year LIKE :search';
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
	 * Requête de recherche par mois pour le chiffre d'affaire
	 */
	public function searchSalesByMonth($search)
	{
		$sql = '';

		if(isset($search) && !empty($search)) {
			$sql = ' WHERE month LIKE :search';
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