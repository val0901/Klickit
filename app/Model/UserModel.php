<?php
namespace Model;

use \W\Model\UsersModel;

class UserModel extends \W\Model\UsersModel 
{
	public function findAllUsers($page, $max)
	{	
		$debut = ($page - 1) * $max;

		$sql = 'SELECT * FROM '.$this->table.' ORDER BY lastname ASC LIMIT :debut, :max';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':max', $max, \PDO::PARAM_INT);
		$sth->bindValue(':debut', $debut, \PDO::PARAM_INT);
		
		$sth->execute(); 

		return $sth->fetchAll();	
	}

	/**
	 * Requête pour les user sans pagination 
	 */
	public function findUser($id)
	{
		$sql = 'SELECT * FROM '.$this->table.' WHERE id = :id';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);

		$sth->execute();

		return $sth->fetch();
	}

	/** 
	* Méthode pour compter le nombre de résultat 
	* @return le nombre de lignes contenu ds la table
	*/

	public function countResults()
	{
    
    $sql = 'SELECT COUNT(*) as total FROM ' . $this->table;

    $sth = $this->dbh->prepare($sql);
    $sth->execute();

    $result = $sth->fetch();

    return $result['total'];
	}

	/**
	* @param $email string l'email pour récupérer le nom et le prénom
	* @return string le nom est le prénom dans un tableau
	*/
	public function getNameByMail($email)
	{	
		//$rename = new BackModel();

		$sql = 'SELECT user.firstname, user.lastname, user.id FROM '.$this->table.' WHERE email = :email';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':email', $email);

		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	* Modifie le mot de passe en fonction du mail de l'utilisateur
	* @param string $password le nouveau mot de passe
	* @param string $email l'adresse email
	* @return true si update réussi, false sinon
	*/
	public function updateByMail($password, $email)
	{
		$sql = 'UPDATE '.$this->table.' SET password = :password WHERE email = :email';
		$sth = $this->dbh->prepare($sql);

		$sth->bindValue(':password', $password);
		$sth->bindValue(':email', $email);

		if($sth->execute()){
			return true;
		}

		return false;
	}

	/**
	 * Récupère les favoris
	 */
	public function findFavorite($id)
	{
		$sql = 'SELECT * FROM '.$this->table.' WHERE id = :id';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);

		$sth->execute();

		return $sth->fetch();
	}

	/**
	 * Mis à jour de la colonne Favorites
	 */
	public function updateFavorites($favorites, $id)
	{
		$sql = 'UPDATE '.$this->table.' SET favorites = :favorites WHERE id = :id';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);
		$sth->bindValue(':favorites', $favorites);

		if($sth->execute()){
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * Recherche d'utilisateur
	 */
	public function searchUser($search)
	{
		$sql = '';

		if(isset($search) && !empty($search)) {
			$sql = ' WHERE lastname LIKE :search OR firstname LIKE :search OR username LIKE :search OR email LIKE :search OR city LIKE :search OR zipcode LIKE :search';
		}

		$query = 'SELECT * FROM '.$this->table.$sql;

		$sth = $this->dbh->prepare($query);

		if(!empty($sql)) {
			$sth->bindValue(':search', '%'.$search.'%');
		}

		if($sth->execute()) {
			return $sth->fetchAll();
		}
	}
}