<?php
namespace Model;

class ItemModel extends \W\Model\Model 
{
	public function listItemClassic()
	{
		$play1 = 'SELECT * FROM '.$this->table.' WHERE category = Playmobil classique';
		$classicPlay = $this->dbh->prepare($play1);
		$classicPlay->execute();

		return $classicPlay->fetchAll();
	}
}