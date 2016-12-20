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
					$updateCart = new UserModel();

					//On remplit le panier avec l'id
					$shoppingCart = [
						'cart_item'	=>	$_POST['id_product'].', ',
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

	//public function 
}