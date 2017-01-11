<?php
namespace Model;

class BasketModel extends \W\Model\Model 
{

	/**
	* Permet de récupérer les articles dans le panier d'un utilisateur
	* @param int $id = l'id du membre
	*/
	public function getShoppingCartItem($id)
	{
		$sql = 'SELECT item.name, item.price, item.newPrice, '.$this->table.'.* FROM '.$this->table.' LEFT JOIN item ON '.$this->table.'.id_item = item.id WHERE id_member = :id';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);
		$sth->execute();

		return $sth->fetchAll();
	}

}