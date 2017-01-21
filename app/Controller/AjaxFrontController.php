<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Model\UsersModel;
use \Model\UserModel;
use \Model\ItemModel;
use \Model\MessageModel;
use \Model\EventModel;
use \Model\GuestbookModel;
use \Model\OrdersModel;
use \Model\BasketModel;
use \Model\SlideModel;
use \Model\ShippingModel;
use \Model\FavoriteModel;
use \W\Security\AuthentificationModel;

use \Respect\Validation\Validator as v; 

class AjaxFrontController extends Controller
{	

	/**
	 * Ajoute un article depuis la vue Article
	 */
	public function addToCartView()
	{	

		$insert = new BasketModel();
		
		if(!empty($_POST)){


			if(is_numeric($_POST['id_product']) && is_numeric($_POST['id_quantity']) && $_POST['id_quantity'] >= 1){
				$islogged = new Controller;
				$loggedUser = $islogged->getUser(); //On récupère l'utilisateur connecté

				if(!empty($loggedUser)){

					if(isset($_POST['id_product'])){
						$dataInsert = [
							'id_member'	=>	$loggedUser['id'],
							'id_item'	=>	$_POST['id_product'],
							'quantity'	=>	$_POST['id_quantity'],
						];

						if($insert->insert($dataInsert)){
							
							$json = ['code' => 'ok'];
									
						}
						else
						{
							$json = ['code' => 'error'];
						}	
					}	
				}
			}
		}
		$this->showJson($json);
	}
	


	/**
	 * Ajoute un produit au panier depuis toutes les pages sauf viewArt
	 */
	public function addToCart()
	{	

		$insert = new BasketModel();

		if(!empty($_POST)){


			if(is_numeric($_POST['id_product'])){
				$islogged = new Controller;
				$loggedUser = $islogged->getUser(); //On récupère l'utilisateur connecté

				if(!empty($loggedUser)){

					if(isset($_POST['id_product'])){
						$dataInsert = [
							'id_member'	=>	$loggedUser['id'],
							'id_item'	=>	$_POST['id_product'],
							'quantity'	=>	'1',
						];

						if($insert->insert($dataInsert)){
							
							$json = ['code' => 'ok'];
									
						}
						else
						{
							$json = ['code' => 'error'];
						}	
					}	
				}
			}
		}
		$this->showJson($json);
	}

	/**
	 * Déconnexion Front
	 */
	public function logout()
	{
		$logout = new AuthentificationModel();
			
		if(isset($_GET['id_logout'])) {
			
			if($logout->logUserOut()){
			
				$this->showJson(['code' => 'ok']);

			}
		}
	}

	/**
	 * Ajoût en Favoris
	 */
	public function favorite()
	{
		$insertFavorite = new FavoriteModel(); // cette variable servira pour l'insertion d'un item en Favoris
		$findFavorite = new FavoriteModel(); // Cette variable servira à vérifier qu'un item est déjà, ou non, en favoris
		$deleteFavorite = new FavoriteModel(); // Cette variable servira pour la suppression d'un favoris

		$json = [];

		if(!empty($this->getUser())){ // Si $_SESSION['user'] n'est pas vide ...
			if(!empty($_POST) && isset($_POST)){ // Donc si $_POST n'est pas vide et qu'il est défini ... On fait en sorte que les favoris rentre en bdd UNIQUEMENT à l'activation des boutons
				$post = implode('', $_POST); // Ici on stock le contenu de $_POST dans $post, $_POST étant un tableau on veut le résultat sous forme de string, vu que les différents boutons sont de types submit, l'utilisateur ne pourra pas rentrer plusieurs favoris en même temps et donc nous n'avons pas besoin d'un délimiteur, au contraire il serait gênant 

				if($findFavorite->findFavoriteByIdItem($post, $_SESSION['user']['id'])){ // Ici grâce à la fonction findFavorite on vérifie si le favoris envoyé existe dans la bdd et si c'est le cas ...
					if($deleteFavorite->deleteFavorite($post, $_SESSION['user']['id'])){ // Si on le supprime grâce à son id et à l'id du membre
						$json = [ // On crée un tableau $json à renvoyer en ajax
							'msg' => 'ok',
						];
					}
				}
				else{ // Sinon ...
					$result = $insertFavorite->insert([ // On insère dans la table Favorite une nouvelle ligne, en stockant d'une part l'id du membre(qui n'est pas unique, un membre peut avoir autant de favoris qu'il souhaite) et d'autre part l'id de l'article (qui lui est unique, on ne peut pas avoir deux fois le même favoris en bdd)
						'id_member' => $_SESSION['user']['id'],
						'id_item'	=> $post, 
					]);

					if($result){ // Et on crée un tableau $json à renvoyer en Ajax
						$json = [
							'msg' => 'ok',
						];
					}
				}
			}
		}
		$this->showJson($json); // On renvoie le tableau $json sur notre page
	}

	/**
	 * Suppression de TOUT les favoris
	 */
	public function deleteAllFavorite()
	{
		$json = [];

		$deleteAllFavorite = new FavoriteModel();
		
		if(isset($_POST['allDelete'])){
			if($deleteAllFavorite->deleteAllFavorite($_SESSION['user']['id'])){
				$json = [
					'msg' => 'ok',
				];
			}
		}
		$this->showJson($json);
	}

	/**
	 * Suppression d'un article dans le panier
	 */
	public function deleteArt()
	{	
		$delete = new BasketModel;
		$user = $this->getUser();
		$json = [];

		if(!empty($_POST)){

			if(is_numeric($_POST['id_delete'])){

				if($delete->deleteItem($user['id'], $_POST['id_delete'])){
					$json = ['code' => 'ok'];
				}			
			}
		}
		$this->showJson($json);
	}

	/**
	 * Nouvelle commande
	 */
	public function newOrder()
	{	
		$insert = new OrdersModel;
		$user = $this->getUser();
		$json = [];

		if(!empty($_POST)){
			
			foreach($_POST as $key => $value){
				$post[$key] = trim(strip_tags($value));
			}

				$content = substr($post['id'], 0, -1);
				$quantity = substr($post['quantity'], 0, -1);

				$data = [
					'idMember'	=>	$user['id'],
					'contenu'	=>	$content,
					'quantity'	=>	$quantity,
					'date_creation'	=> date('Y-m-d H:i:s'),
					'statut'	=>	'commande',
					'sub_total'	=>	$post['sub_total'],
					'shipping'	=>	$post['shipping'],
					'total'		=>	$post['total'],
					'address'	=>	$user['adress'],
					'zipcode'	=>	$user['zipcode'],
					'city'		=>	$user['city'],
					'country'	=>  $post['country'],

				];

			if($insert->insert($data)){
				$json = ['code'=> 'ok'];
			}
		}	
		$this->showJson($json);
	}

	/**
	 * Mise à jour du pays dans Basket
	 */
	public function updateCountry()
	{
		$update = new BasketModel;
		$user = $this->getUser();
		$json = [];

		if(!empty($_POST) && isset($_POST)){
			if($update->updateAllBasket($user['id'], $_POST['country_choice'])){
				$json = [
					'code'=> 'ok'
				];
			}
		}
		$this->showJson($json);
	}
}