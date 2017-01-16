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

	public function optimizeCart($id)
	{
		//On récupère le panier tel quel
		$shoppingCart = $this->getShoppingCartItem($id);

		$sql = 'SELECT item.name, item.id, '.$this->table.'.id_item, '.$this->table.'.quantity FROM '.$this->table.' LEFT JOIN item ON '.$this->table.'.id_item = item.id WHERE id_member = :id ';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);
		$sth->execute();		
		$myCart = $sth->fetchAll();

		//On va le nettoyer
		// if(in_array($shoppingCart['name'], $myCart['name'])){

			
		// }

	}
	

}