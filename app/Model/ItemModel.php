<?php
namespace Model;

use \W\Model\UsersModel;

class ItemModel extends \W\Model\Model 
{
	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Playmobil classique"
	public function listItemClassic($page, $max)
	{
		$debut = ($page - 1) * $max;

		$play = 'SELECT * FROM '.$this->table.' WHERE category = "PlaymobilClassique" LIMIT :debut, :max';

		$classicPlay = $this->dbh->prepare($play);
		$classicPlay->bindValue(':max', $max, \PDO::PARAM_INT);
		$classicPlay->bindValue(':debut', $debut, \PDO::PARAM_INT);

		$classicPlay->execute();

		return $classicPlay->fetchAll();
	}

	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Playmobil custom"
	public function listItemCustom($page1, $max)
	{
		$debut = ($page1 - 1) * $max;

		$play2 = 'SELECT * FROM '.$this->table.' WHERE category = "PlaymobilCustom" LIMIT :debut, :max';

		$customPlay = $this->dbh->prepare($play2);
		$customPlay->bindValue(':max', $max, \PDO::PARAM_INT);
		$customPlay->bindValue(':debut', $debut, \PDO::PARAM_INT);

		$customPlay->execute();

		return $customPlay->fetchAll();
	}

	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Pièces Détachées"
	public function listItemPiece($page2, $max)
	{
		$debut = ($page2 - 1) * $max;

		$play3 = 'SELECT * FROM '.$this->table.' WHERE category = "PiecesDetachees" LIMIT :debut, :max';

		$piecePlay = $this->dbh->prepare($play3);
		$piecePlay->bindValue(':max', $max, \PDO::PARAM_INT);
		$piecePlay->bindValue(':debut', $debut, \PDO::PARAM_INT);

		$piecePlay->execute();

		return $piecePlay->fetchAll();
	}

	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Divers"
	public function listItemDivers($page3, $max)
	{
		$debut = ($page3 - 1) * $max;

		$play4 = 'SELECT * FROM '.$this->table.' WHERE category = "Divers" LIMIT :debut, :max';
		$piecePlay = $this->dbh->prepare($play4);

		$piecePlay->bindValue(':max', $max, \PDO::PARAM_INT);
		$piecePlay->bindValue(':debut', $debut, \PDO::PARAM_INT);

		$piecePlay->execute();

		return $piecePlay->fetchAll();
	}

	/** 
	*Méthode pour compter le nombre de résultat 
	* @return le nombre de lignes contenu ds la table
	*/

	public function countResults($column = false)
	{
    $sql = 'SELECT COUNT(*) as total FROM ' . $this->table ;

    if ($column) {
    	$sql.= ' WHERE category = "' .$column .'"';
    }
    $sth = $this->dbh->prepare($sql);
    $sth->execute();

    $result = $sth->fetch();

    return $result['total'];
	}

	/*REQUÊTE SUR LA ITEM PAR ID*/
	public function findItems($id)
	{

		$sql = 'SELECT * FROM '.$this->table.' WHERE id = :id';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);
		$sth->execute();

		return $sth->fetch();
	}

	/**
	 * REQUÊTE D'AFFICHAGE EN FONCTION DU STATUT
	 */
	public function findCategoryStatutCustom($category, $statut)
	{
		$sql = 'SELECT * FROM '.$this->table.' WHERE category = :category AND statut = :statut';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':category', $category);
		$sth->bindValue(':statut', $statut);
		$sth->execute();

		return $sth->fetchAll();
	}	

	/**
	 * REQUÊTE D'AFFICHAGE D'UNE SUB_CATEGORY
	 */
	public function findSubCategory($sub_category)
	{
		$sql = 'SELECT * FROM '.$this->table.' WHERE sub_category = :subCategory';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':subCategory', $sub_category);
		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	*	Affichage par catégorie
	*/
	public function findByCategory($category, $page, $max)
	{
		$debut = ($page - 1) * $max;
		$sql = 'SELECT * FROM '.$this->table.' WHERE category = :category LIMIT :debut, :max';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':category', $category);
		$sth->bindValue(':max', $max, \PDO::PARAM_INT);
		$sth->bindValue(':debut', $debut, \PDO::PARAM_INT);

		$sth->execute();

		return $sth->fetchAll();
	}
	
}