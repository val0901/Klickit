<?php
namespace Model;

class ItemModel extends \W\Model\Model 
{
	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Playmobil classique"
	public function listItemClassic()
	{
		$play = 'SELECT * FROM '.$this->table.' WHERE category = "PlaymobilClassique" LIMIT 15';
		$classicPlay = $this->dbh->prepare($play);
		$classicPlay->execute();

		return $classicPlay->fetchAll();
	}

	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Playmobil custom"
	public function listItemCustom()
	{
		$play2 = 'SELECT * FROM '.$this->table.' WHERE category = "PlaymobilCustom" LIMIT 15';
		$customPlay = $this->dbh->prepare($play2);
		$customPlay->execute();

		return $customPlay->fetchAll();
	}

	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Pièces Détachées"
	public function listItemPiece()
	{
		$play3 = 'SELECT * FROM '.$this->table.' WHERE category = "PiecesDetachees" LIMIT 15';
		$piecePlay = $this->dbh->prepare($play3);
		$piecePlay->execute();

		return $piecePlay->fetchAll();
	}

	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Divers"
	public function listItemDivers()
	{
		$play4 = 'SELECT * FROM '.$this->table.' WHERE category = "Divers" LIMIT 15';
		$piecePlay = $this->dbh->prepare($play4);
		$piecePlay->execute();

		return $piecePlay->fetchAll();
	}
}