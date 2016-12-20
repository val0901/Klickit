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
	 * Ajoute un produit au panier
	 */
	public function addToCart()
	{
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


					$updateCart = new UserModel();

					//On remplit le panier avec l'id
					$shoppingCart = [
						'cart_item'	=>	$_SESSION['shop']['cart_item'],
					];
				}
				
				if($updateCart->update($shoppingCart,$loggedUser['id'])){
					$json = ['code' => 'ok'];
				}
			}else{
				$json = ['code' => 'error'];
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
			
		if(isset($_POST['id_logout'])) {
			$logout->logUserOut();
			
			$this->showJson(['code' => 'ok']);
		}
	}
}