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
	public function listItemCustom($page, $max)
	{
		$debut = ($page - 1) * $max;

		$play = 'SELECT * FROM '.$this->table.' WHERE category = "PlaymobilCustom" LIMIT :debut, :max';

		$customPlay = $this->dbh->prepare($play);
		$customPlay->bindValue(':max', $max, \PDO::PARAM_INT);
		$customPlay->bindValue(':debut', $debut, \PDO::PARAM_INT);

		$customPlay->execute();

		return $customPlay->fetchAll();
	}

	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Pièces Détachées"
	public function listItemPiece($page, $max)
	{
		$debut = ($page - 1) * $max;

		$play = 'SELECT * FROM '.$this->table.' WHERE category = "PiecesDetachees" LIMIT :debut, :max';

		$piecePlay = $this->dbh->prepare($play);
		$piecePlay->bindValue(':max', $max, \PDO::PARAM_INT);
		$piecePlay->bindValue(':debut', $debut, \PDO::PARAM_INT);

		$piecePlay->execute();

		return $piecePlay->fetchAll();
	}

	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Divers"
	public function listItemDivers($page, $max)
	{
		$debut = ($page - 1) * $max;

		$play = 'SELECT * FROM '.$this->table.' WHERE category = "Divers" LIMIT :debut, :max';
		$piecePlay = $this->dbh->prepare($play);

		$piecePlay->bindValue(':max', $max, \PDO::PARAM_INT);
		$piecePlay->bindValue(':debut', $debut, \PDO::PARAM_INT);

		$piecePlay->execute();

		return $piecePlay->fetchAll();
	}

	/** 
	*Méthode pour compter le nombre de résultat par catégorie 
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

	/** 
	*Méthode pour compter le nombre de résultat par sous catégorie 
	* @return le nombre de lignes contenu ds la table
	*/

	public function countResultssub($column = false)

    {
	    $sql = 'SELECT COUNT(*) as total FROM ' . $this->table;

	    if ($column) {
	    	$sql.= ' WHERE sub_category = "' .$column .'"';
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
	 * Requête spéciale pour l'API PayPal
	 */
	public function findItemsForAPI($id)
	{
		$sql = 'SELECT name, price, newPrice FROM '.$this->table.' WHERE id = :id';

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
	 * Requête d'affichage pour statut promotion et nouveauté
	 */	
	public function findStatut($statut1, $statut2)
	{
		$sql = 'SELECT * FROM '.$this->table.' WHERE statut = :statut1 OR statut = :statut2';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':statut1', $statut1);
		$sth->bindValue(':statut2', $statut2);
		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	 * REQUÊTE D'AFFICHAGE D'UNE SUB_CATEGORY
	 */
	public function findSubCategory($sub_category, $page, $max)
	{
		$debut = ($page - 1) * $max;
		
		$sql = 'SELECT * FROM '.$this->table.' WHERE sub_category = :subCategory LIMIT :debut, :max';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':subCategory', $sub_category);
		$sth->bindValue(':max', $max, \PDO::PARAM_INT);
		$sth->bindValue(':debut', $debut, \PDO::PARAM_INT);
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

	/**
	 * Récupère tout les ID
	 */
	public function RealLastInsertId()
	{
		$sql = 'SELECT id FROM '.$this->table.' ORDER BY id ASC';

		$sth = $this->dbh->prepare($sql);

		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	 * Récupère la ligne filter en fonction de l'id
	 */
	public function findFilterItem($id)
	{
		$sql = 'SELECT filter FROM '.$this->table.' WHERE id = :id';

		$sth = $this->dbh->prepare($sql);

		$sth->execute();

		return $sth->fetch();
	}

	/**
	 * Recherche globale d'article
	 */
	public function globalSearch($search)
	{
		$sql = '';

		if(isset($search) && !empty($search)) {
			$sql = ' WHERE name LIKE :search OR description LIKE :search OR statut LIKE :search OR category LIKE :search OR sub_category LIKE :search';
		}

		$query = 'SELECT id FROM '.$this->table.$sql;

		$sth = $this->dbh->prepare($query);

		if(!empty($sql)) {
			$sth->bindValue(':search', '%'.$search.'%');
		}

		if($sth->execute()) {
			return $sth->fetchAll();
		}
	}

	/**
	 * Recherche sur la page ListItem en BACK
	 */
	public function searchItem($search, $category)
	{
		$sql = '';

		if(isset($search) && !empty($search)) {
			$sql = ' WHERE name LIKE :search OR description LIKE :search OR statut LIKE :search OR category LIKE :search OR sub_category LIKE :search AND category = :category';
		}

		$query = 'SELECT * FROM '.$this->table.$sql;

		$sth = $this->dbh->prepare($query);

		if(!empty($sql)) {
			$sth->bindValue(':search', '%'.$search.'%');
		}
		$sth->bindValue(':category', $category);

		if($sth->execute()) {
			return $sth->fetchAll();
		}
	}

	public function selectStock($id_item)
	{
		$sql = 'SELECT quantity FROM '.$this->table.' WHERE id = :id';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id_item);

		$sth->execute();

		return $sth->fetch();
	}

	/**
	 * Soustraction du stock lors de l'achat
	 */
	public function stockSoustraction($id_item, $number)
	{
		$sql = 'UPDATE '.$this->table.' SET quantity = :quantity WHERE id = :id';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id_item);
		$sth->bindValue(':quantity', $number);

		if($sth->execute()){
			return true;
		}
		else{
			return false;
		}
	}
}