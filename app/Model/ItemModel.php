<?php
namespace Model;

class ItemModel extends \W\Model\Model 
{
	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Playmobil classique"
	public function listItemClassic()
	{
		$play = 'SELECT * FROM '.$this->table.' WHERE category = Playmobil classique';
		$classicPlay = $this->dbh->prepare($play);
		$classicPlay->execute();

		return $classicPlay->fetchAll();
	}

	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Playmobil custom"
	public function listItemCustom()
	{
		$play = 'SELECT * FROM '.$this->table.' WHERE category = Playmobil Custom';
		$customPlay = $this->dbh->prepare($play);
		$customPlay->execute();

		return $customPlay->fetchAll();
	}

	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Pièces Détachées"
	public function listItemPiece()
	{
		$play = 'SELECT * FROM '.$this->table.' WHERE category = Playmobil Custom';
		$piecePlay = $this->dbh->prepare($play);
		$piecePlay->execute();

		return $piecePlay->fetchAll();
	}
}