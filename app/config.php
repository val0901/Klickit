<?php 

$w_config = [
   	//information de connexion à la bdd
	'db_host' => 'klickitfrjlol333.mysql.db',						//hôte (ip, domaine) de la bdd
    'db_user' => 'klickitfrjlol333',							//nom d'utilisateur pour la bdd
    'db_pass' => 'Chipster33',								//mot de passe de la bdd
    'db_name' => 'klickitfrjlol333',								//nom de la bdd
    'db_table_prefix' => '',						//préfixe ajouté aux noms de table

	//authentification, autorisation
	'security_user_table' => 'user',				//nom de la table contenant les infos des utilisateurs
	'security_id_property' => 'id',					//nom de la colonne pour la clef primaire
	'security_username_property' => 'username',		//nom de la colonne pour le "pseudo"
	'security_email_property' => 'email',			//nom de la colonne pour l'"email"
	'security_password_property' => 'password',		//nom de la colonne pour le "mot de passe"
	'security_role_property' => 'role',				//nom de la colonne pour le "role"

	'security_login_route_name' => 'login',	//nom de la route affichant le formulaire de connexion

	// configuration globale
	'site_name'	=> 'http://www.klickit.fr/', 								// contiendra le nom du site

	'upload_dir' 	   => '/art/', 						// Répertoire de stockage des images uploadées
	'upload_dir_event' => '/events/',
	'upload_dir_slide' => '/slide/',
];

require('routes.php');

