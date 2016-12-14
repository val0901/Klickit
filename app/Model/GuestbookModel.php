<?php
namespace Model;

class GuestbookModel extends \W\Model\Model 
{

	public function findAllMessage()
	{
		$sql = 'SELECT ' .$this->table.'.*, u.firstname, u.lastname FROM ' . $this->table . ' LEFT JOIN user AS u ON '.$this->table.'.id_member = u.id ORDER BY ' .$this->table.'.id DESC ';

		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
	}
}