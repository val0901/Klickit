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
		$sql = 'SELECT item.id, item.name, item.price, item.newPrice, item.picture1, '.$this->table.'.id_item, '.$this->table.'.id_member, SUM('.$this->table.'.quantity) AS qt FROM '.$this->table.' LEFT JOIN item ON '.$this->table.'.id_item = item.id WHERE id_member = :id GROUP BY item.name';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);
		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	* Permet de calculer le prix total d'un panier
	* @param int $id = l'id du membre
	*/

	public function getTotal($id)
	{
		$shoppingCart = $this->getShoppingCartItem($id);
		$price = 0;

		foreach($shoppingCart as $value){

			if($value['newPrice'] == 0){
				$price = $value['price']*$value['qt'] + $price;
			}elseif($value['newPrice'] > 0){
				$price = $value['newPrice']*$value['qt'] + $price;
			}

		}
		return $price;
	}

	/**
	* Compte le nombre d'objet dans le dans le panier pour gérer les frais de ports
	* @param int $id_member = l'id du membre
	*/

	public function countFDP($id_member)
	{

		$sql = 'SELECT item.sub_category, SUM('.$this->table.'.quantity) AS somme FROM '.$this->table.' LEFT JOIN item ON '.$this->table.'.id_item = item.id WHERE id_member = :id_member ';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_member', $id_member);
		$sth->execute();

		return $sth->fetchAll();

	}	

}