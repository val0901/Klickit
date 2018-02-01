<?php
namespace Model;

use \W\Model\UserModel;

class GuestbookModel extends \W\Model\Model 
{
    protected $table_column = array(
        'id'            => null,
        'username'      => null,
        'email'         => null,
        'subject'       => null,
        'content'       => null,
        'id_member'     => null,
        'date_creation' => null,
        'published'     => null
    );

    /*retourne tous les messages avec jointure et pagination*/
    public function findAllMessage($page, $max)
    {
        $debut = ($page - 1) * $max;

        $sql = 'SELECT ' .$this->table.'.*, u.firstname, u.lastname, u.username FROM ' . $this->table . ' LEFT JOIN user AS u ON '.$this->table.'.id_member = u.id ORDER BY ' .$this->table. '.id DESC LIMIT :debut, :max';

        if($this->dbh->errorInfo() != null) {
            $sth = $this->dbh->prepare($sql);
            $sth->bindValue(':max', $max, \PDO::PARAM_INT);
            $sth->bindValue(':debut', $debut, \PDO::PARAM_INT);
            $sth->execute();
            return $sth->fetchAll();
        } else {
            return $this->table_column;
        }
    }

    /*retourne un message ene focntion de l'id*/
    public function viewMessage($id)
    {
        $sql = 'SELECT ' .$this->table.'.*, u.email, u.firstname, u.lastname FROM ' . $this->table . ' LEFT JOIN user AS u ON '.$this->table.'.id_member = u.id WHERE '.$this->table.'.id = :id';

        if($this->dbh->errorInfo() != null) {
            $sth = $this->dbh->prepare($sql);
            $sth->bindValue(':id', $id);
            $sth->execute();
            return $sth->fetch();
        } else {
            return $this->table_column;
        }
    }

    /*Cherche les 15 derniers commentaires*/
    public function find15Comments()
    {

        $sql = 'SELECT ' .$this->table.'.*, u.firstname, u.lastname, u.username FROM ' . $this->table . ' LEFT JOIN user AS u ON '.$this->table.'.id_member = u.id ORDER BY ' .$this->table.'.date_creation DESC LIMIT 15';

        if($this->dbh->errorInfo() != null) {
            $sth = $this->dbh->prepare($sql);
            $sth->execute();
            return $sth->fetchAll();
        } else {
            return $this->table_column;
        }
    }

    /** 
    *Méthode pour compter le nombre de résultat 
    * @return le nombre de lignes contenu ds la table
    */

    public function countResults()
    {

        $sql = 'SELECT COUNT(*) as total FROM ' . $this->table;

        if($this->dbh->errorInfo() != null) {
            $sth = $this->dbh->prepare($sql);
            $sth->execute();
            $result = $sth->fetch();
            return $result['total'];
        } else {
            return $this->table_column;
        }
    }

    /*retourne tous les messages*/
    public function findAllMessageFront()
    {
        $sql = 'SELECT ' .$this->table.'.*, u.social_title, u.firstname, u.lastname, u.username FROM ' . $this->table . ' LEFT JOIN user AS u ON '.$this->table.'.id_member = u.id ORDER BY ' .$this->table. '.id';

        // Dump pour afficher le contenu d'un objet
        // var_dump(get_class_methods($this->dbh/*->errorInfo()*/));
        if($this->dbh->errorInfo() != null) {
            $sth = $this->dbh->prepare($sql);
            $sth->execute();
            return $sth->fetchAll();
        } else {
            return $this->table_column;
        }
    }
}
