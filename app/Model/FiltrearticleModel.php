<?php
namespace Model;

class FiltrearticleModel extends \W\Model\Model 
{
	/**
	 * Rechercher articles en fonction du nom du filtre
	 */
	public function findItemByFilter($filter)
	{
		$sql = 'SELECT id_item FROM '.$this->table.' WHERE name_filter = :name_filter';

		 $sth = $this->dbh->prepare($sql);
		 $sth->bindValue(':name_filter', $filter);
		 $sth->execute();

		 return $sth->fetchAll();
	}

	/**
	 * Rechercher les différents filtre par l'id_item
	 */
	public function findByIdItem($id)
	{
		$sql = 'SELECT * FROM '.$this->table.' WHERE id_item = :id_item';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_item', $id);
		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	 * Suppression par l'id_item
	 */
	public function deleteByItem($id)
	{
		$sql = 'DELETE FROM '.$this->table.' WHERE id_item = :id_item';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_item', $id);

		return $sth->execute();
	}
}