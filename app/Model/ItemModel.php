<?php
namespace Model;

class ItemModel extends \W\Model\Model 
{
	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Playmobil classique"
	public function listItemClassic()
	{
		$play1 = 'SELECT * FROM '.$this->table.' WHERE category = Playmobil classique';
		$classicPlay = $this->dbh->prepare($play1);
		$classicPlay->execute();

		return $classicPlay->fetchAll();
	}

	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Playmobil custom"
	public function listItemCustom()
	{
		$play2 = 'SELECT * FROM '.$this->table.' WHERE category = Playmobil Custom';
		$customPlay = $this->dbh->prepare($play2);
		$customPlay->execute();

		return $customPlay->fetchAll();
	}

	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Pièces Détachées"
	public function listItemPiece()
	{
		$play3 = 'SELECT * FROM '.$this->table.' WHERE category = Playmobil Custom';
		$piecePlay = $this->dbh->prepare($play3);
		$piecePlay->execute();

		return $piecePlay->fetchAll();
	}
}