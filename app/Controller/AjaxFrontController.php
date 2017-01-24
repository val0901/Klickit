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
		$insert = new BasketModel;
		$find = new BasketModel;
		$update = new BasketModel;
		$islogged = new Controller;
		$loggedUser = $islogged->getUser(); //On récupère l'utilisateur connecté
		$updateQuantity = 0;
		
		if(!empty($_POST)){
			if(!empty($loggedUser)){

				if($find->getBasketByUser($loggedUser['id'], $_POST['id_product'])){
					$quantity = $find->getBasketByUser($loggedUser['id'], $_POST['id_product']);

					if(empty($_POST['id_quantity'])){
						$updateQuantity = $quantity['quantity'] + 1;
					}
					else {
						$updateQuantity = $quantity['quantity'] + $_POST['id_quantity'];
					}

					if(isset($_POST['id_product'])){
						if($update->updateQuantityBasket($loggedUser['id'], $_POST['id_product'], $updateQuantity)){
							$json = [
								'code' => 'ok'
							];
						}
						else
						{
							$json = [
								'code' => 'error'
							];
						}		
					}
				}
				else {
					if(isset($_POST['id_product'])){

						$dataInsert = [
							'id_member'	=>	$loggedUser['id'],
							'id_item'	=>	$_POST['id_product'],
							'quantity'	=>	$_POST['id_quantity'],
							'country'	=> '',
						];

						if($insert->insert($dataInsert)){	
							$json = [
								'code' => 'ok'
							];		
						}
						else
						{
							$json = [
								'code' => 'error'
							];
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
		$insert = new BasketModel;
		$find = new BasketModel;
		$update = new BasketModel;
		$islogged = new Controller;
		$loggedUser = $islogged->getUser(); //On récupère l'utilisateur connecté

		if(!empty($_POST)){

			if($find->getBasketByUser($loggedUser['id'], $_POST['id_product'])){
				if(is_numeric($_POST['id_product'])){

					$quantity = $find->getBasketByUser($loggedUser['id'], $_POST['id_product']);

					$updateQuantity = $quantity['quantity'] + 1;

					if(!empty($loggedUser)){

						if(isset($_POST['id_product'])){

							if($update->updateQuantityBasket($loggedUser['id'], $_POST['id_product'], $updateQuantity)){
								
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
			else{
				if(is_numeric($_POST['id_product'])){

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
					'order_process'	=> 'EnCours',

				];

			if($insert->insert($data)){
				$json = ['code'=> 'ok'];
			}
		}	
		$this->showJson($json);
	}

	/**
	* Mise à jour de la commande
	*/
	public function updateOrder()
	{
		$do = new OrdersModel;
		$json = [];
		$user = $this->getUser();


		if(!empty($_POST)){

			foreach($_POST as $key => $value){
				$post[$key] = trim(strip_tags($value));
			}

			$content = substr($post['u_id'], 0, -1);
			$quantity = substr($post['u_quantity'], 0, -1);

			if($do->updateOrder($user['id'], $content, $quantity, $post['u_sub_total'], $post['u_shipping'], $post['u_total'])){
				$json = ['code' => 'ok'];
			}else{
				$json = ['code' => 'nope'];
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

	/**
	 * Mise à jour table order avec address, zipcode, city, country
	 */
	public function updateOrderAddress()
	{
		$update = new OrdersModel;
		$user = $this->getUser();
		$json = [];
		$post = [];
		$errors = [];
		$address = '';

		if(!empty($_POST) && isset($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));

			if(!v::notEmpty()->length(5,null)->validate($post['address'])){
				$errors[] = 'Votre adresse doit comporter au moins 5 caractères <br>';
			}

			if(!empty($post['address_complement']) && isset($post['address_complement'])){
				if(!v::notEmpty()->length(3,null)->validate($post['address_complement'])){
					$errors[] = 'Votre adresse doit comporter au moins 5 caractères <br>';
				}
			}

			if(!v::notEmpty()->digit()->length(5,5)->validate($post['zipcode'])){
				$errors[] = 'Votre adresse doit comporter au moins 5 caractères <br>';
			}

			if(!v::notEmpty()->length(3,null)->validate($post['city'])){
				$errors[] = 'Votre adresse doit comporter au moins 3 caractères <br>';
			}

			if(!v::notEmpty()->length(3,null)->validate($post['country'])){
				$errors[] = 'Votre adresse doit comporter au moins 3 caractères <br>';
			}

			if(!empty($post['address_complement']) && isset($post['address_complement'])){
				$address = $post['address'].' / '.$post['address_complement'];
			}

			if(count($errors) === 0){
				if(!empty($post['address_complement']) && isset($post['address_complement'])){
					if($update->updateAddressOrder($user['id'], $address, $post['zipcode'], $post['city'], $post['country'])){
						$json = [
							'code'=> 'ok'
						];
					}
				}
				else{
					if($update->updateAddressOrder($user['id'], $post['address'], $post['zipcode'], $post['city'], $post['country'])){
						$json = [
							'code'=> 'ok'
						];
					}
				}
			}
			else{
				$json = [
					'code' => 'error',
					'msg'  => $errors
				];
			}
		}
		$this->showJson($json);
	}

	/**
	 * Mise à jour table order pour^payment
	 */
	public function updateOrderPayment()
	{
		$updateOrder = new OrdersModel;
		$deleteBasket = new BasketModel;
		$user = $this->getUser();
		$json = [];

		if(!empty($_POST) && isset($_POST)){
			if($_POST['payment'] == 'paypal'){
				if($updateOrder->updatePaymentOrder($user['id'], $_POST['payment'])){
					if($deleteBasket->deleteAllBasket($user['id'])){
						$json = [
							'code' => 'paypal'
						];
					}
				}
			}
			elseif ($_POST['payment'] == 'cheque') {
				if($updateOrder->updatePaymentOrder($user['id'], $_POST['payment'])){
					if($deleteBasket->deleteAllBasket($user['id'])){
						$json = [
							'code' => 'cheque'
						];
					}
				}
			}
			elseif($_POST['payment'] == 'virement') {
				if($updateOrder->updatePaymentOrder($user['id'], $_POST['payment'])){
					if($deleteBasket->deleteAllBasket($user['id'])){
						$json = [
							'code' => 'virement'
						];
					}
				}
			}
		}
		$this->showJson($json);
	}

	/**
	* Mise à jour des quantités depuis my_order
	*/
	public function updateQuantity()
	{
		$add = new BasketModel;
		$user = $this->getUser();
		$json = [];

		if(!empty($_POST)){
			if(is_numeric($_POST['id_product'])){

				$quantity = $add->getBasketByUser($user['id'], $_POST['id_product']);

				$updateQuantity = $quantity['quantity'] + 1;

					if($update = $add->updateQuantityBasket($user['id'], $_POST['id_product'], $updateQuantity)){
						$json = [
							'code' => 'ok'
						];
					}
					else{
						$json = [	
							'code' => 'no'
						];
					}
			}else{
				$json = [
					'code' => 'no'
				];
			}

		}
		$this->showJson($json);
	}

	/**
	* Mise à jour des quantités depuis my_order
	*/
	public function updateQuantitySubtraction()
	{
		$add = new BasketModel;
		$delete = new BasketModel;
		$user = $this->getUser();
		$json = [];
		$updateQuantity = 0;

		if(!empty($_POST)){
			if(is_numeric($_POST['id_product'])){

				$quantity = $add->getBasketByUser($user['id'], $_POST['id_product']);

				if($quantity['quantity'] > 1){
					$updateQuantity = $quantity['quantity'] - 1;
				}
				elseif($quantity['quantity'] == 1){
					if($delete->deleteItem($user['id'], $_POST['id_product'])){
						$json = [
							'code' => 'ok'
						];
					}
				}

				if($updateQuantity > 0){
					if($update = $add->updateQuantityBasket($user['id'], $_POST['id_product'], $updateQuantity)){
						$json = [
							'code' => 'ok'
						];
					}
					else{
						$json = [	
							'code' => 'no'
						];
					}
				}
			}else{
				$json = [
					'code' => 'no'
				];
			}

		}
		$this->showJson($json);
	}
}