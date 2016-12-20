<?php

namespace Model;

use \W\Model\Model;

class ResetModel extends \W\Model\Model 
{
	/**
	* Retourne les infos via l'id du token
	* @param string $id_token l'id du token
	*/
	public function findByIdToken($id_token)
	{	

		if(empty($id_token) || !is_string($id_token)){
			return false;
		}

		$sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $this->primaryKey .'  = :id LIMIT 1';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id_token);
		$sth->execute();

		return $sth->fetch();
	}
}