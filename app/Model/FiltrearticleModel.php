<?php
namespace Model;

class FiltrearticleModel extends \W\Model\Model 
{
	/**
	 * Recherchez articles en fonction du nom du filtre
	 */
	public function findItemByFilter($filter)
	{
		$sql = 'SELECT id_item FROM '.$this->table.' WHERE name_filter = :name_filter';

		 $sth = $this->dbh->prepare($sql);
		 $sth->bindValue(':name_filter', $filter);
		 $sth->execute();

		 return $sth->fetchAll();
	}
}