<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Model\UsersModel;
use \Model\ItemModel;
use \Model\MessageModel;
use \Model\EventModel;
use \Model\GuestbookModel;
use \Model\OrdersModel;
use \Model\SlideModel;
use \Model\ShippingModel;
use \W\Security\AuthentificationModel;

use \Respect\Validation\Validator as v; 

class AjaxController extends Controller
{	
	/**
	 * Ajoute un produit au panier
	 */
	public function addToCart()
	{
		if(!empty($_POST)){

			if(is_numeric($_POST['id_product'])){
				$userModel = new UserModel();

				if($deleteOrder){
					$json = ['code' => 'ok'];
				}
			}else{
				$json = ['code' => 'error'];
			}
		}
		$this->showJson($json);
	}
}