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
		$insertFavorite = new FavoriteModel();
		$findFavorite = new FavoriteModel();
		$deleteFavorite = new FavoriteModel();

		$json = [];

		if(!empty($this->getUser())){
			if(!empty($_POST) && isset($_POST)){
				$post = implode('', $_POST);

				if($findFavorite->findFavoriteByIdItem($post, $_SESSION['user']['id'])){
					if($deleteFavorite->deleteFavorite($post, $_SESSION['user']['id'])){
						$json = [
							'msg' => 'ok',
						];
					}
				}
				else{
					$result = $insertFavorite->insert([
						'id_member' => $_SESSION['user']['id'],
						'id_item'	=> $post, 
					]);

					if($result){
						$json = [
							'msg' => 'ok',
						];
					}
				}
			}
		}
		$this->showJson($json);
	}
}