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
use \Model\SlideModel;
use \Model\ShippingModel;
use \W\Security\AuthentificationModel;

use \Respect\Validation\Validator as v; 

class AjaxFrontController extends Controller
{	

	/**
	 * Ajoute un article depuis la vue Article
	 */
	public function addToCartView()
	{	
		$html = '';
		$price = 0;
		$updateCart = new UserModel;

		if(!empty($_POST)){
			if(is_numeric($_POST['id_product_view'])){
				$user = $this->getUser();

				if(!empty($user)){
					if(!isset($_SESSION['shop']['cart_item']) || empty($_SESSION['shop']['cart_item'])){ 
						$_SESSION['shop']['cart_item'] = $_POST['id_product_view'];
					}
					else {
						$_SESSION['shop']['cart_item'] = $_SESSION['shop']['cart_item'].', '.$_POST['id_product_view'];
					}

				}

				//On remplit le panier avec l'id
					$shoppingCart = [
						'cart_item'	=>	$_SESSION['shop']['cart_item'],
					];
				}
				
					/************Affichage des articles dans le panier***********/
					if($updateCart->update($shoppingCart,$user['id'])){
						
						$getShoppingCart = new UserModel(); 
						$getItems = new ItemModel();
						$user = $this->getUser();
						$shoppingCart = $getShoppingCart->find($user['id']);

						$panier = explode(', ', $shoppingCart['cart_item']);

						foreach($panier as $value){ 

							$list_items = $getItems->findItems($value);
							$html.= '<div class="col-xs-6">'.$list_items['name'].'</div>';
							if($list_items['newPrice'] == 0){
								$html.= '<div class="col-xs-6" style="text-align:right;">'.$list_items['price'].'€</div>';
								$price = $list_items['price'] + $price;
							}else{
								$html.= '<div class="col-xs-6" style="text-align:right;">'.$list_items['newPrice'].'€</div>';
								$price = $list_items['newPrice'] + $price;
							}
							
							//Je stocke les résultats dans mon tableau json
							$json = ['code' => 'ok', 'item_cart'=>$html, 'price'=>$price];
						}
					}else{
						$json = ['code' => 'error'];
				}
		}
		$this->showJson($json);
	}
	


	/**
	 * Ajoute un produit au panier depuis Customs
	 */
	public function addToCart()
	{	
		$html = '';
		$price = 0;
		$updateCart = new UserModel();

		if(!empty($_POST)){


			if(is_numeric($_POST['id_product'])){
				$islogged = new Controller;
				$loggedUser = $islogged->getUser(); //On récupère l'utilisateur connecté

				if(!empty($loggedUser)){

					/************On stocke en session*************/ 

					//Si notre panier est vide ou non défini, alors on rajoute notre produit au panier
					if(!isset($_SESSION['shop']['cart_item']) || empty($_SESSION['shop']['cart_item'])){ 
						$_SESSION['shop']['cart_item'] = $_POST['id_product'];
					}
					//Sinon, on récupère les valeurs stockées dans notre panier puis on rajoute la valeur sélectionnée en la concatennant
					else {
						$_SESSION['shop']['cart_item'] = $_SESSION['shop']['cart_item'].', '.$_POST['id_product'];
					}


					//On remplit le panier avec l'id
					$shoppingCart = [
						'cart_item'	=>	$_SESSION['shop']['cart_item'],
					];
				}
				
					/************Affichage des articles dans le panier***********/
					if($updateCart->update($shoppingCart,$loggedUser['id'])){
						
						$getShoppingCart = new UserModel(); 
						$getItems = new ItemModel();
						$user = $this->getUser();
						$shoppingCart = $getShoppingCart->find($user['id']); //Je récupère le panier de l'utilisateur connecté

						$panier = explode(', ', $shoppingCart['cart_item']); //Je crées un tableau à partir des clés en string

						foreach($panier as $value){ //Je parcours tout mon panier et je cherche à afficher le nom et le prix de tous les articles (produit x Y pas encore pris en compte)

							$list_items = $getItems->findItems($value);
							$html.= '<div class="col-xs-6">'.$list_items['name'].'</div>';
							if($list_items['newPrice'] == 0){
								$html.= '<div class="col-xs-6" style="text-align:right;">'.$list_items['price'].'€</div>';
								$price = $list_items['price'] + $price;
							}else{
								$html.= '<div class="col-xs-6" style="text-align:right;">'.$list_items['newPrice'].'€</div>';
								$price = $list_items['newPrice'] + $price;
							}
							
							//Je stocke les résultats dans mon tableau json
							$json = ['code' => 'ok', 'item_cart'=>$html, 'price'=>$price];
						}
					}else{
						$json = ['code' => 'error'];
				}
			}
			$this->showJson($json);
		}
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
}