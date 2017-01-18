<?php
namespace Model;

use \W\Model\UsersModel;

class FavoriteModel extends \W\Model\Model
{
	/**
	 * Permet de rechercher tout les favoris lié à l'id d'un utilisateur
	 */
	public function findFavoriteByUser($id_member)
	{
		$sql = 'SELECT * FROM '.$this->table.' WHERE id_member = :id_member';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_member', $id_member);

		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	 * Récupète uniquement la ligne id_item de la bdd
	 */

	public function findFavorisItem($id_member)
	{
		$sql = 'SELECT id_item FROM '.$this->table.' WHERE id_member = :id_member';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_member', $id_member);

		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	 * Permet de rechercher un favoris en fonction de l'id_item
	 */
	public function findFavoriteByIdItem($id_item, $id_member)
	{
		$sql = 'SELECT * FROM '.$this->table.' WHERE id_item = :id_item AND id_member = :id_member';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_item', $id_item);
		$sth->bindValue(':id_member', $id_member);

		$sth->execute();

		return $sth->fetch();
	}

	/**
	 * Permet de supprimer un favoris en fonction de l'id_item et du membre
	 */
	public function deleteFavorite($id_item, $id_member)
	{
		$sql = 'DELETE FROM '.$this->table.' WHERE id_item = :id_item AND id_member = :id_member';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_item', $id_item);
		$sth->bindValue(':id_member', $id_member);

		return $sth->execute();
	}

	/**
	 * Permet de supprimer tout les favoris d'un utilisateur
	 */
	public function deleteAllFavorite($id_member)
	{
		$sql = 'DELETE FROM '.$this->table.' WHERE id_member = :id_member';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_member', $id_member);

		return $sth->execute();
	}
}