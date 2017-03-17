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
		$sql = 'SELECT item.id, item.name, item.price, item.newPrice, item.picture1, '.$this->table.'.id_item, '.$this->table.'.id_member, '.$this->table.'.quantity AS qt FROM '.$this->table.' LEFT JOIN item ON '.$this->table.'.id_item = item.id WHERE id_member = :id';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);
		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	 * Permet de cherche si un article est déjà au panier en fonction de l'utilisateur
	 */
	public function getBasketByUser($id_member, $id_item)
	{
		$sql = 'SELECT * FROM '.$this->table.' WHERE id_member = :id_member AND id_item = :id_item';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_member', $id_member);
		$sth->bindValue(':id_item', $id_item);
		$sth->execute();

		return $sth->fetch();
	}

	/**
	 * Permet de mettre à jour la quantité si l'article est déjà dans le panier de l'utilisateur
	 */
	public function updateQuantityBasket($id_member, $id_item, $quantity)
	{
		$sql = 'UPDATE '.$this->table.' SET quantity = :quantity WHERE id_member = :id_member AND id_item = :id_item';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':quantity', $quantity);
		$sth->bindValue(':id_member', $id_member);
		$sth->bindValue(':id_item', $id_item);

		if($sth->execute()){
			return true;
		}

		return false;
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

		$sql = 'SELECT SUM('.$this->table.'.quantity) AS somme FROM '.$this->table.' WHERE id_member = :id_member ';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_member', $id_member);
		$sth->execute();

		return $sth->fetch();

	}

	/**
	 * Permet de récupérer les sous catégorier
	 */
	public function sub_categoryFDP($id_member)
	{
		$sql = 'SELECT item.sub_category, '.$this->table.'.id_item FROM '.$this->table.' LEFT JOIN item ON '.$this->table.'.id_item = item.id WHERE id_member = :id_member';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_member', $id_member);
		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	* Suppression d'un article dans le panier
	*/

	public function deleteItem($id_member, $id_item)
	{
		$sql = 'DELETE FROM '.$this->table.' WHERE id_item = :id_item AND id_member = :id_member';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_member', $id_member);
		$sth->bindValue(':id_item', $id_item);

		return $sth->execute();

	}

	/**
	 * Sélection des articles par id_member
	 */
	public function selectCountry($id)
	{
		$sql = 'SELECT country FROM '.$this->table.' WHERE id_member = :id_member';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_member', $id);
		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	 * Sélection des quantity par id_member
	 */
	public function selectQuantity($id)
	{
		$sql = 'SELECT quantity FROM '.$this->table.' WHERE id_member = :id_member';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_member', $id);
		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	 * Mise à jour de tout les articles dans le panier
	 */
	public function updateAllBasket($id_member, $country)
	{
		$sql = 'UPDATE '.$this->table.' SET country = :country WHERE id_member = :id_member';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue('id_member', $id_member);
		$sth->bindValue(':country', $country);

		if($sth->execute()){
			return true;
		}

		return false;
	}

	/**
	 * Suppression de tout les articles d'un utilisateur
	 */
	public function deleteAllBasket($id_member)
	{
		$sql = 'DELETE FROM '.$this->table.' WHERE id_member = :id_member';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_member', $id_member);

		return $sth->execute();
	}

	/**
	 * Suppresion de tout les articles après avoir supprimé l'article en back
	 */
	public function deleteItem($id_item)
	{
		$sql = 'DELETE FROM '.$this->table.' WHERE id_item = :id_item';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_item', $id_item);

		return $sth->execute();
	}

	/**
	 * Update des pays
	 */
	public function resetCountry($id)
	{
		$sql = 'UPDATE '.$this->table.' SET country = "" WHERE id_member = :id_member';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue('id_member', $id);

		if($sth->execute()){
			return true;
		}

		return false;
	}
}