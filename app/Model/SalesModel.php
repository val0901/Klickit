<?php
namespace Model;

class SalesModel extends \W\Model\Model 
{
		/*Requête popour afficher le CA*/
		public function findAllSales($page, $max)
		{
			//on definit la page de démarrage
			$debut = ($page - 1) * $max;

			// requête sur la table  où on definit les variables de la page de démarrage($debut) et là le nombre de lignes par page($max)
			$sql = 'SELECT * from '.$this->table. ' ORDER BY id ASC LIMIT :debut, :max '; 

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