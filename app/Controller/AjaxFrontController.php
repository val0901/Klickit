<?php

namespace Controller;

use \W\Controller\Controller;
use \W\View\Plates\PlatesExtensions;
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
use \Model\FilterModel;
use \Model\FiltrearticleModel;
use \W\Security\AuthentificationModel;
use \PHPMailer;
use \PayPal\Rest\ApiContext as APIContext;
use \PayPal\Auth\OAuthTokenCredential as TokenCredential;
use \PayPal\Api\Payer;
use \PayPal\Api\Item;
use \PayPal\Api\ItemList;
use \PayPal\Api\Details;
use \PayPal\Api\Amount;
use \PayPal\Api\Transaction;
use \PayPal\Api\RedirectUrls;
use \PayPal\Api\Payment;

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
		$getOrder = new UserModel;
		$deleteBasket = new BasketModel;
		$getItem = new ItemModel;
		$user = $this->getUser();
		$sendMail = new PHPMailer;
		$json = [];
		$orderContent = [];

		$getOrderByID = $getOrder->getCurrentOrderById($user['id']);

		$current_order = end($getOrderByID);

		$findItem = new ItemModel();

		$orderContent = explode(', ', $current_order['contenu']);

		if(!empty($_POST) && isset($_POST)){
			if($_POST['payment'] == 'paypal'){
				if($updateOrder->updatePaymentOrder($user['id'], $_POST['payment'])){
					if($deleteBasket->deleteAllBasket($user['id'])){

						$paypal = new APIContext(
							new TokenCredential(
								'AbZj79OCZKQQW7fUqhkL5oEqwQelg8KnLSkgRfceq4s33OAssaIge9dxeS--Cy-pS5uDXHqBthIjugS5',
								'EPF9t-DUzYMQmXG9eXhiDDLTGFNUpAC05WQMYyW-ho-dxC4VLlcpKVCEFXQ72IYbRh9qW3bBC7dWKhd8')
							);

						$payer = new Payer();
						$payer->setPaymentMethod('paypal');

						$quantity = explode(', ',$current_order['quantity']);
						$content = explode(', ', $current_order['contenu']);

						for($i = 0; $i <= count($orderContent); $i++){
							
							$item[$i] = new Item();

							foreach($current_order as $value){
								foreach($content as $key => $value){
									$item_property = $getItem->findItems($key);
									$qte = $quantity[$key];

									if($item_property['newPrice'] == 0){
										$item[$i]->setName($item_property)->setCurrency('EUR')->setQuantity($qte)->setPrice($item_property['price']);
									}elseif($item_property['newPrice'] > 0){
										$item[$i]->setName($item_property)->setCurrency('EUR')->setQuantity($qte)->setPrice($item_property['newPrice']);
									}
									
								}
							}
							$items[] = $item[$i];
						}
							$itemList = new ItemList();
							$itemList->setItems($items);

						$details = new Details();
						$details->setShipping($current_order['shipping'])->setSubTotal($current_order['sub_total']);

						$amount = new Amount();
						$amount->setCurrency('EUR')->setTotal($current_order['total'])->setDetails($details);

						$transaction = new Transaction();
						$transaction->setAmount($amount)->setItemList($itemList)->setDescription('Votre commande')->setInvoiceNumber(uniqid());

						$redirectUrls = new RedirectUrls();
						$redirectUrls->setReturnUrl('http://google.com')->setCancelUrl('http://facebook.com');

						$payment = new Payment();
						$payment->setIntent('sale')->setPayer($payer)->setRedirectUrls($redirectUrls)->setTransactions([$transaction]);	

						try {
							$payment->create($paypal);
						} catch (Exception $e) {
							die($e);
						}

						$approvalUrl = $payment->getApprovalLink();
						header("Location: {$approvalUrl}") ;

						$json = [
							'code' => 'paypal'
						];
					}
				}
			}
			elseif ($_POST['payment'] == 'cheque') {
				if($updateOrder->updatePaymentOrder($user['id'], $_POST['payment'])){
					if($deleteBasket->deleteAllBasket($user['id'])){
						if($user['social_title'] == 'Mme'){
							$contentEmail = 'Bonjour Madame '.$user['lastname'].' '.$user['firstname'].', vous avez choisi le mode de paiement par chèque pour votre commande n°'.$current_order['id'].' qui contient : <br> <ul>';

							foreach ($orderContent as $contentMail) {
								$contentEmail.= '<li>'.$contentMail.'</li>';
							}
							
							$contentEmail.= '</ul> <br> Votre commande vous sera expédié dès réception du chèque <br> <br> Merci de votre confiance, à très bientôt sur Klickit ! <br><br> L\'équipe Klickit.';
						}
						elseif($user['social_title'] == 'M'){
							$contentEmail = 'Bonjour Monsieur '.$user['lastname'].' '.$user['firstname'].', vous avez choisi le mode de paiement par chèque pour votre commande n°'.$current_order['id'].' qui contient : <br> <ul>';

							foreach ($orderContent as $contentMail) {
								$contentEmail.= '<li>'.$contentMail.'</li>';
							}
							
							$contentEmail.= '</ul> <br> Votre commande vous sera expédié dès réception du chèque <br>  <br> Merci de votre confiance, à très bientôt sur Klickit ! <br><br> L\'équipe Klickit.';
						}

						$sendMail->isSMTP();                                      
						$sendMail->Host = 'ssl0.ovh.net';  									// Hôte du SMTP
						$sendMail->SMTPAuth = true;                               				// SMTP Authentification
						$sendMail->Username = 'sav@klickit.fr'; //Username         				// SMTP username
						$sendMail->Password = 'silSAV33@'; //mot de passe                    	 				// SMTP password
						$sendMail->SMTPSecure = 'tls';                         					// Enable TLS encryption, `ssl` also accepted
						$sendMail->Port = 587;                                					// TCP port to connect to
						$sendMail->CharSet = 'UTF-8';

						$sendMail->setFrom('sav@klickit.fr', 'Klickit');		  		//Expéditeur
						
						$sendMail->addAddress($user['email'], $user['firstname'].' '.$user['lastname']); 	   	//$user['email']
						//$sendMail->addCC(''); 					//Copie envoyer à l'adresse souhaitée du mail

						$sendMail->Subject = 'paiement chèque';
						$sendMail->Body    = $contentEmail; //On envoi le message éventuellement en HTML
						$sendMail->AltBody = $contentEmail; //On envoi le message sans HTML

						if($sendMail->send()){
							$json = [
								'code' => 'cheque'
							];
						}
						
					}
				}
			}
			elseif($_POST['payment'] == 'virement') {
				if($updateOrder->updatePaymentOrder($user['id'], $_POST['payment'])){
					if($deleteBasket->deleteAllBasket($user['id'])){
						if($user['social_title'] == 'Mme'){
							$contentEmail = 'Bonjour Madame '.$user['lastname'].' '.$user['firstname'].', vous avez choisi le mode de paiement par virement pour votre commande n°'.$current_order['id'].' qui contient : <br> <ul>';

							foreach ($orderContent as $contentMail) {
								$contentEmail.= '<li>'.$contentMail.'</li>';
							}
							
							$contentEmail.= '</ul> <br> Votre commande vous sera expédié dès validation du virement <br> <br> Merci de votre confiance, à très bientôt sur Klickit ! <br><br> L\'équipe Klickit.';
						}
						elseif($user['social_title'] == 'M'){
							$contentEmail = 'Bonjour Monsieur '.$user['lastname'].' '.$user['firstname'].', vous avez choisi le mode de paiement par virement pour votre commande n°'.$current_order['id'].' qui contient : <br> <ul>';

							foreach ($orderContent as $contentMail) {
								$contentEmail.= '<li>'.$contentMail.'</li>';
							}
							
							$contentEmail.= '</ul> <br> Votre commande vous sera expédié dès validation du virement <br> <br> Merci de votre confiance, à très bientôt sur Klickit ! <br><br> L\'équipe Klickit.';
						}

						$sendMail->isSMTP();                                      
						$sendMail->Host = 'ssl0.ovh.net';  									// Hôte du SMTP
						$sendMail->SMTPAuth = true;                               				// SMTP Authentification
						$sendMail->Username = 'sav@klickit.fr'; //Username         				// SMTP username
						$sendMail->Password = 'silSAV33@'; //mot de passe                    	 				// SMTP password
						$sendMail->SMTPSecure = 'tls';                         					// Enable TLS encryption, `ssl` also accepted
						$sendMail->Port = 587;                                					// TCP port to connect to
						$sendMail->CharSet = 'UTF-8';

						$sendMail->setFrom('sav@klickit.fr', 'Klickit');		  		//Expéditeur
						
						$sendMail->addAddress($user['email'], $user['firstname'].' '.$user['lastname']); 	   	//$user['email']
						//$sendMail->addCC(''); 					//Copie envoyer à l'adresse souhaitée du mail

						$sendMail->Subject = 'paiement virement';
						$sendMail->Body    = $contentEmail; //On envoi le message éventuellement en HTML
						$sendMail->AltBody = $contentEmail; //On envoi le message sans HTML

						if($sendMail->send()){
							$json = [
								'code' => 'virement'
							];
						}
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

	/**
	 * Recherche par Filtre
	 */
	public function SearchByFilter()
	{
		$json = [];
		$idFilter = '';
		$contentSearch = '';
		$user = $this->getUser();
		$find = new FiltrearticleModel();
		$findItem = new ItemModel();
		$viewSearch = null;
		$picutreLink = new PlatesExtensions();

		$favorite = new FavoriteModel();
		$favoriteList = '';
		if(!empty($this->getUser())){
			$userFavorite = $favorite->findFavorisItem($user['id']);

			$myFavorite = '';

			foreach ($userFavorite as $favoris) {
				foreach ($favoris as $value) {
					$myFavorite.= $value.', ';
				}
			}

			$favoriteList = substr($myFavorite, 0, -2);
			$favorite = explode(', ', $favoriteList);
		}

		if(!empty($_POST)){
			$filterPost = substr($_POST['filter'], 0, -2);
			$post = explode(', ', $filterPost);

			foreach ($post as $value) {
				foreach($find->findItemByFilter($value) as $filter){
					foreach ($filter as $fil) {
						$idFilter.= $fil.', ';
					}
				}
			}
			$contentSearch = substr($idFilter, 0, -2);
			$contentSearchArray = explode(', ', $contentSearch);


			foreach ($contentSearchArray as $searchItem) {
				$item = $findItem->findItems($searchItem);

				$viewSearch.= '<div class="col-md-3 col-xs-6 viewcategoryrow2col1_img">';
				$viewSearch.= '<a href="'.$this->generateUrl('viewArt', ['id' => $item['id']]).'"><img src="'.$picutreLink->assetUrl('art/'.$item['picture1']).'" alt="photo de playmobil" class="img-thumbnail" style=""></a>';

				if($item['newPrice'] == 0){
					$viewSearch.= '<div class="viewcategorycaption"><h4>'.$item['price'].'€</h4>';
				}
				else {
					$viewSearch.= '<h4><span class="viewcategoryprixpromo">'.$item['newPrice'].'€</span><span class="viewcategoryprixdelete">'.$item['price'].'€</span></h4>';
				}

				$viewSearch.='<p class="iconeFavorite"><span style="cursor:pointer;">';
				if(!empty($user)){
					if(in_array($item['id'], $favorite)){
						$viewSearch.= '<button class="favorite" type="submit" name="'.str_replace(' ', '', $item['name']).'" value="'.$item['id'].'" data-id="'.$item['id'].'"><span id="'.$item['id'].'" class="fa fa-heart fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" style="color: #c11131;" title="Retirer de mes favoris"></span></button>';
					}
					else{
						$viewSearch.= '<button class="favorite" type="submit" name="'.str_replace(' ', '', $item['name']).'" value="'.$item['id'].'" data-id="'.$item['id'].'"><span id="'.$item['id'].'" class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></span></button>';
					}
				}
				else{
					$viewSearch.= '<a href="'.$this->generateUrl('login').'"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></a>';
				}
				$viewSearch.= '</span> '.$item['name'].'</p>';
				
				if($item['statut'] == 'nouveaute'){
					$viewSearch.= '<div class="viewcategory_nouveau">'.$item['statut'].'</div>';
				}
				elseif($item['statut'] == 'promotion'){
					$viewSearch.= '<div class="viewcategory_promo">'.$item['statut'].'</div>';
				}
				elseif($item['statut'] == 'defaut'){
					$viewSearch.= '<div class="viewcategory_defaut"></div>';
				}

				$viewSearch.= '</div><div class="viewcategory_button"><button type="submit" class="btn btn-primary viewcategory_button_size add_to_shopping_cart" data-id="'.$item['id'].'">ajouter au panier</button></div></div>';
			}

			if(!empty($viewSearch)){
				$json = [
					'code'     => 'ok',
					'msg'      => $viewSearch,
				];
			}
			else{
				$json = [
					'code' => 'no',
					'msg'  => 'Aucun résultat',
				];
			}
		}
		$this->showJson($json);
	}

	/**
	 * Pour reset le pays
	 */
	public function resetCountryOrder()
	{
		$json = [];
		$reset = new BasketModel();

		if(!empty($_POST)){
			if($reset->resetCountry($_POST['user'])){
				$json = [
					'code' => 'ok'
				];
			}
		}
		$this->showJson($json);
	}

	/**
	 * Recherche globale
	 */
	public function globalSearch()
	{
		$post = [];
		$json = [];

		if(!empty($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));

			$_SESSION['general_search'] = $post['search'];

			if(!empty($_SESSION['general_search'])){
				$json = [
					'code' => 'ok',
				];
			}
		}
		$this->showJson($json);
	}
}