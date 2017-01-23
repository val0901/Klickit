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
}