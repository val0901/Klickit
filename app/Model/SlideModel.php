<?php
namespace Model;

class SlideModel extends \W\Model\Model 
{
	/**
	 * Requête pour sélectionner uniquement les ID de la table
	 */
	public function realLastSlide(){
		$sql = $sql = 'SELECT id FROM '.$this->table.' ORDER BY id ASC';

		$sth = $this->dbh->prepare($sql);

		$sth->execute();

		return $sth->fetchAll();
	}
}