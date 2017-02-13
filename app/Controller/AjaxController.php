<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Model\UsersModel;
use \Model\ItemModel;
use \Model\UserModel;
use \Model\MessageModel;
use \Model\EventModel;
use \Model\GuestbookModel;
use \Model\OrdersModel;
use \Model\SlideModel;
use \Model\ShippingModel;
use \Model\FilterModel;
use \Model\FiltrearticleModel;
use \Model\SalesrevenueModel;
use \W\Security\AuthentificationModel;
use \PHPMailer;

use \Respect\Validation\Validator as v; 

class AjaxController extends Controller
{	
	/**
	* Déconnexion en ajax
	*/
	public function logout()
	{
		$logout = new AuthentificationModel();
			
		if(isset($_POST['id_logout'])) {
			$logout->logUserOut();
			
			$this->showJson(['code' => 'ok']);
		}
	}

	/**
	* Effacer un utilisateur en ajax
	*/
	public function deleteUser()
	{

		if(!empty($_POST)){

			if(is_numeric($_POST['id_user'])){
				$userModel  = new UsersModel();
				$delete = $userModel->delete($_POST['id_user']);

				if($delete){
					$json = ['code' => 'ok'];
				}
			}
			else {
				$json = ['code' => 'error'];
			}
		}
		$this->showJson($json);
	}

	/**
	 * Effacer un article en Ajax
	 */
	public function deleteItem()
	{
		if(!empty($_POST)){
			if(is_numeric($_POST['id_item'])){
				$itemModel  = new ItemModel();
				$deleteItem = $itemModel->delete($_POST['id_item']);

				if($deleteItem){
					$json = ['code' => 'ok'];
				}
			}
			else {
				$json = ['code' => 'error'];
			}
		}
		$this->showJson($json);
	}

	/**
	* Efface un message en Ajax
	*/
	public function deleteMessage()
	{
		if(!empty($_POST)){

			if(is_numeric($_POST['id_message'])){
				$messageModel = new MessageModel();
				$deleteMessage = $messageModel->delete($_POST['id_message']);

				if($deleteMessage){
					$json = ['code' => 'ok'];
				}
			}else{
				$json = ['code' => 'error'];
			}
		}
		$this->showJson($json);
	}

	/**
	 * Efface un évènement en Ajax
	 */
	public function deleteEvent()
	{
		if(!empty($_POST)){

			if(is_numeric($_POST['id_event'])){
				$eventModel = new EventModel();
				$deleteEvent = $eventModel->delete($_POST['id_event']);

				if($deleteEvent){
					$json = ['code' => 'ok'];
				}
			}else{
				$json = ['code' => 'error'];
			}
		}
		$this->showJson($json);
	}

	/**
	 * Efface un commentaire dans le livre d'or en Ajax
	 */
	public function deleteMessageMod()
	{
		if(!empty($_POST)){

			if(is_numeric($_POST['id_comment'])){
				$eventModel = new GuestbookModel();
				$deleteEvent = $eventModel->delete($_POST['id_comment']);

				if($deleteEvent){
					$json = ['code' => 'ok'];
				}
			}else{
				$json = ['code' => 'error'];
			}
		}
		$this->showJson($json);
	}

	/**
	 * Efface un slide en Ajax
	 */
	public function deleteSlide()
	{
		if(!empty($_POST)){

			if(is_numeric($_POST['id_slide'])){
				$slideModel = new SlideModel();
				$deleteSlide = $slideModel->delete($_POST['id_slide']);

				if($deleteSlide){
					$json = ['code' => 'ok'];
				}
			}else{
				$json = ['code' => 'error'];
			}
		}
		$this->showJson($json);
	}

	/**
	 * Efface une option d'envoi en Ajax
	 */
	public function deleteShipping()
	{
		if(!empty($_POST)){

			if(is_numeric($_POST['id_shipping'])){
				$shippingModel = new ShippingModel();
				$deleteShipping = $shippingModel->delete($_POST['id_shipping']);

				if($deleteShipping){
					$json = ['code' => 'ok'];
				}
			}else{
				$json = ['code' => 'error'];
			}
		}
		$this->showJson($json);
	}

	/**
	 * Efface une commande
	 */
	public function deleteOrder()
	{
		if(!empty($_POST)){

			if(is_numeric($_POST['id_order'])){
				$orderModel = new OrdersModel();
				$deleteOrder = $orderModel->delete($_POST['id_order']);

				if($deleteOrder){
					$json = ['code' => 'ok'];
				}
			}else{
				$json = ['code' => 'error'];
			}
		}
		$this->showJson($json);
	}

	/**
	* Change le statut de la commande
	*/
	public function updateStatus()
	{
		/************CHANGEMENT DE STATUT DE LA COMMANDE**************/

		$state = ['commandé', 'en préparation', 'expédié'];
		$new_state = '';
		$json = [];

		if(!empty($_POST)){
			if(is_numeric($_POST['id'])){
				
				if(!in_array($_POST['status'], $state)){
					$error = 'Veuillez choisir le statut de la commande';
				}
				elseif($_POST['status'] == 'commandé'){
					$new_state = 'commandé';
				}
				elseif($_POST['status'] == 'en préparation'){
					$new_state = 'en préparation';
				}
				elseif($_POST['status'] == 'expédié'){
					$new_state = 'expédié';
				}

				//On met à jour l'état de la commande
				$update = new OrdersModel;
				$updated_status = [
					'statut'	=> $new_state
				];

				$updating = $update->update($updated_status, $_POST['id']);
				if($updating){
					$json = [
						'code'=>'ok',
					];
				}
				else{
					$json = [
						'code'=>'no'
					];
				}
			}
		}
			
		$this->showJson($json);
	}

	/**
	 * Requête de recherche d'utilisateur
	 */
	public function searchUser()
	{
		$json = [];
		$get = [];
		$viewSearch = null;

		if(!empty($_GET)){
			$get = array_map('trim', array_map('strip_tags', $_GET));

			$searchUser = new UserModel();

			$search = $searchUser->searchUser($get['search']);

			if(!empty($search)){	
				foreach ($search as $value) {
					$viewSearch.= '<tr><td>'.$value['social_title'].'</td>';
					$viewSearch.= '<td>'.$value['role'].'</td>';
					$viewSearch.= '<td>'.$value['lastname'].'</td>';
					$viewSearch.= '<td>'.$value['firstname'].'</td>';
					$viewSearch.= '<td>'.$value['username'].'</td>';
					$viewSearch.= '<td>'.$value['email'].'</td>';
					$viewSearch.= '<td><a href="'.$this->generateUrl('updateUser', ['id'=> $value['id']]).'">Mettre à jour le profil</a></td>';
					$viewSearch.= '<td><button class="btn btn-danger delete-user" data-id="'.$value['id'].'">Effacer le profil</button></td></tr>';
				}
			}
			else {
				$viewSearch.= '<td>Aucun utilisateur correspondant à votre recherche</td>';
			}

			$json = [
				'code' => 'success',
				'msg'  => $viewSearch
			];
		}

		echo json_encode($json);
	}

	/**
	 * Requête pour les messages
	 */
	public function searchMessage()
	{
		$json = [];
		$get = [];
		$bold = '';
		$viewSearch = null;

		if(!empty($_GET)){
			$get = array_map('trim', array_map('strip_tags', $_GET));

			$searchMessage = new MessageModel();

			$search = $searchMessage->searchMessage($get['search']);

			if(!empty($search)){	
				foreach ($search as $value) {
					if ($value['statut'] == 'NonLu'){
						$bold = ' style="font-weight:bold;" ';
					}else{
						$bold = '';
					}

					$viewSearch.= '<tr><td'.$bold.'>'.$value['username'].'</td>';
					$viewSearch.= '<td'.$bold.'>'.$value['email'].'</td>';
					$viewSearch.= '<td'.$bold.'>'.$value['subject'].'</td>';
					$viewSearch.= '<td'.$bold.'>'.$value['content'].'</td>';
					$viewSearch.= '<td'.$bold.'>'.$value['statut'].'</td>';
					$viewSearch.= '<td><a href="'.$this->generateUrl('viewMessage', ['id'=> $value['id']]).'"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></a></td>';
					$viewSearch.= '<td><button class="btn btn-danger delete-message" data-id="'.$value['id'].'">Effacer le message</button></td></tr>';
				}
			}
			else {
				$viewSearch.= '<td>Aucun message correspondant à votre recherche</td>';
			}

			$json = [
				'code' => 'success',
				'msg'  => $viewSearch
			];
		}

		echo json_encode($json);
	}

	/**
	 * Requête pour les commandes
	 */
	public function searchOrder()
	{
		$json = [];
		$get = [];
		$viewSearch = null;

		if(!empty($_GET)){
			$get = array_map('trim', array_map('strip_tags', $_GET));

			$searchOrders = new OrdersModel();
			$items = new ItemModel();

			$search = $searchOrders->searchOrder($get['search']);

			if(!empty($search)){	
				foreach ($search as $value) {
					$viewSearch.= '<tr><td>'.$value['id'].'</td>';

					$findUser = new UserModel();
					$user = $findUser->findUser($value['idMember']);
					$viewSearch.= '<td>'.$user['lastname'].' '.$user['firstname'].'<br>'.$user['adress'].'<br>'.$user['zipcode'].' '.$user['city'].'</td>';

					$contents = explode(', ', $value['contenu']); 
					$quantity = explode(', ', $value['quantity']);

					for($i=0;$i<count($contents);$i++){
						$content_basket[$value['id']][] = [
							'content' 	=> $contents[$i],
							'quantity' 	=> $quantity[$i],
						];
					}

					$itemsContent = '';
					foreach ($content_basket[$value['id']] as $basket){
						$list_items = $items->findItems($basket['content']); 

						$itemsContent.= '<a href="'.$this->generateUrl('updateItem', ['id'=>$list_items['id']]).'" style="color:white;">'.$list_items['name'].'</a> <br>';
					}
					$viewSearch.= '<td>'.$itemsContent.'</td>';

					$quantityContent = '';
					foreach ($content_basket[$value['id']] as $basket){
						$quantityContent.= $basket['quantity'].'<br>';
					}
					$viewSearch.= '<td>'.$quantityContent.'</td>';

					$priceContent = '';
					foreach ($contents as $content) {
						$list_items = $items->findItems($content);
					
						if($list_items['newPrice'] == 0){
							$priceContent.= $list_items['price'].' €<br>';
						}
						elseif($list_items['newPrice'] > 0) {
							$priceContent.= $list_items['newPrice'].' €<br>';
						}

					}
					$viewSearch.= '<td>'.$priceContent.'</td>';

					$totalContent = '';
					foreach ($content_basket[$value['id']] as $basket) {
					    $price_items = $items->findItems($basket['content']); 

					    if($price_items['newPrice'] == 0){
					    	$price = $price_items['price'];
					    }
					    elseif($price_items['newPrice'] > 0){
					    	$price = $price_items['newPrice'];
					    }
						$totalContent.= \Tools\Utils::calculTtc($price, $basket['quantity']).' €<br>';
					}
					$viewSearch.= '<td>'.$totalContent.'</td>';

					$viewSearch.= '<td>'.date('d/m/Y', strtotime($value['date_creation'])).'</td>';

					$viewSearch.= '<td>';
					if ($value['statut'] == 'enPreparation'){
						$viewSearch.= '<p>En préparation</p>';
						$viewSearch.= '<button type="button" data-id="'.$value['id'].'" class="order_sent" style="color:black;">Commande expédiée</button>';

					}elseif ($value['statut'] == 'commande'){
						$viewSearch.= '<p>Commandé</p>';
						$viewSearch.= '<button type="button" data-id="'.$value['id'].'" class="order_prepare" style="color:black;">Commande en préparation</button>';
					}elseif ($value['statut'] == 'expedie'){
						$viewSearch.= '<p>Expédiée</p>';
					}
					$viewSearch.= '</td>';
					$viewSearch.= '<td>'.$value['statut'].'</td>';
					$viewSearch.= '<td><a href="'.$this->generateUrl('viewOrders', ['id'=> $value['id']]).'"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></a></td>';
				}
			}
			else {
				$viewSearch.= '<td>Aucun message correspondant à votre recherche</td>';
			}

			$json = [
				'code' => 'success',
				'msg'  => $viewSearch
			];
		}

		echo json_encode($json);
	}

	/**
	 * Efface un filtre en Ajax
	 */
	public function deleteFilter()
	{
		if(!empty($_POST)){

			if(is_numeric($_POST['id_filter'])){
				$filterModel = new FilterModel();
				$deleteFilter = $filterModel->delete($_POST['id_filter']);

				if($deleteFilter){
					$json = ['code' => 'ok'];
				}
			}else{
				$json = ['code' => 'error'];
			}
		}
		$this->showJson($json);
	}

	/**
	 * Insert dans la table FiltrearticleModel
	 */
	public function UpdateItemFilter()
	{
		$post = [];
		$getInfos = new ItemModel;
		$insert = new FiltrearticleModel;
		$json = [];
		$my_filters2 = '';

		$lastItem = $getInfos->RealLastInsertId();

		$RealLastItem = end($lastItem);

		if(!empty($_POST)){
			foreach($_POST as $key => $value){
				$post[$key] = trim(strip_tags($value));
			}

			$my_filters = explode(', ', $post['fil']);
			
			foreach($my_filters as $value){
				$insert_filter = $insert->insert([
					'id_item'		=>  implode('', $RealLastItem),
					'name_filter'	=>	$value,
				]);
				$my_filters2.= $value.', ';
			}

			if(!empty($my_filters2)){
				$json = ['code'	=>	'ok'];
			}else{
				$json = ['code'	=>	'no'];
			}
		}
		$this->showJson($json);
	}

	/**
	* Ajout des filtres sur la SESSION
	*/
	public function addFilter()
	{	
		$post = [];
		$json = [];

		if(!empty($_POST)){
			foreach($_POST as $key => $value){
				$post[$key] = trim(strip_tags($value));
			}

			$my_filters = substr($post['filters'], 0, -1 );

			$_SESSION['filter'] = $my_filters;

			if(!empty($_SESSION['filter'])){
				$json = [
					'code'	=>	'ok',
					'msg'	=>  'Fitre(s) enregistré(s), veuillez continuer la création de l\'article',
				];
			}else{
				$json = ['code'	=>	'no'];
			}
		}
		$this->showJson($json);
	}

	/**
	 * Mise à jour des filtres d'un article
	 */
	public function updateFilter()
	{
		$post = [];
		$json = [];
		$deleteFilter = new FiltrearticleModel();
		$insert = new FiltrearticleModel();
		$my_filters2 = '';

		if(!empty($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));

			$my_filters = explode(', ', substr($post['filters'], 0, -1));

			if($deleteFilter->deleteByItem($post['item'])){
				foreach($my_filters as $value){
					$insert->insert([
						'id_item'		=>  $post['item'],
						'name_filter'	=>	$value,
					]);
					$my_filters2.= $value.', ';
				}

				if(!empty($my_filters2)){
					$json = ['code'	=>	'ok'];
				}else{
					$json = ['code'	=>	'no'];
				}
			}
		}
		$this->showJson($json);
	}

	/**
	 * Mise à jour du statut d'une commande
	 */
	public function orderUpdateStatut()
	{
		$updateOrder = new OrdersModel();
		$find = new OrdersModel;
		$json = [];
		$post = [];
		$success = false;
		$sendMail = new PHPMailer;

		if(!empty($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));
			$infos = $find->findOrdersAndCustom($post['id']);

			foreach($infos as $user){

			}


			if($updateOrder->updateStatutOrder($post['id'], $post['statut'])){		

				if($post['statut'] == 'enPreparation'){
					$contentEmail = 'commande en préparation';

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

					$sendMail->Subject = 'commande en préparation';
					$sendMail->Body    = $contentEmail; //On envoi le message éventuellement en HTML
					$sendMail->AltBody = $contentEmail; //On envoi le message sans HTML

					if($sendMail->send()){

						$success = true;

						$json = [
							'code' => 'ok',

						];

					}
				}
				elseif($post['statut'] == 'expedie'){
					$contentEmail = 'commande expédiée';

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

					$sendMail->Subject = 'commande expédiée';
					$sendMail->Body    = $contentEmail; //On envoi le message éventuellement en HTML
					$sendMail->AltBody = $contentEmail; //On envoi le message sans HTML

					if($sendMail->send()){

						$success = true;

						$json = [
							'code' => 'ok',

						];

					}
				}
				
				
			}
		}
		$this->showJson($json);
	}

	/**
	 * Création des sales revenues
	 */
	public function salesRevenu()
	{
		$json = [];
		$salesRevenu = null;

		$getOrder = new OrdersModel();
		$sales = new SalesrevenueModel();

		$allOrder = $getOrder->findOrderForsales();

		if(empty($allOrder)){
			$json = [
				'code' => 'no',
				'msg'  => 'Aucune mise à jour du chiffre d\'affaire disponible, réessayez quand vous aurez vendu quelque chose ;)',
			];
			$this->showJson($json);
		}

		foreach($allOrder as $dateValue){
			$year = date_format(date_create($dateValue['date_creation']), 'Y');

			if(date_format(date_create($dateValue['date_creation']), 'm') == '01'){
				$month = 1;
			}
			elseif(date_format(date_create($dateValue['date_creation']), 'm') == '02'){
				$month = 2;
			}
			elseif(date_format(date_create($dateValue['date_creation']), 'm') == '03'){
				$month = 3;
			}
			elseif(date_format(date_create($dateValue['date_creation']), 'm') == '04'){
				$month = 4;
			}
			elseif(date_format(date_create($dateValue['date_creation']), 'm') == '05'){
				$month = 5;
			}
			elseif(date_format(date_create($dateValue['date_creation']), 'm') == '06'){
				$month = 6;
			}
			elseif(date_format(date_create($dateValue['date_creation']), 'm') == '07'){
				$month = 7;
			}
			elseif(date_format(date_create($dateValue['date_creation']), 'm') == '08'){
				$month = 8;
			}
			elseif(date_format(date_create($dateValue['date_creation']), 'm') == '09'){
				$month = 9;
			}
			elseif(date_format(date_create($dateValue['date_creation']), 'm') == '10'){
				$month = 10;
			}
			elseif(date_format(date_create($dateValue['date_creation']), 'm') == '11'){
				$month = 11;
			}
			elseif(date_format(date_create($dateValue['date_creation']), 'm') == '12'){
				$month = 12;
			}

			$monthAndYear = $sales->monthAndYear($month, $year);

			foreach ($monthAndYear as $rMAY) {
				$realMonthAndYear = implode('', $rMAY);
			}

			if($monthAndYear){
				$revenue = $realMonthAndYear + $dateValue['total'];
				$salesRevenu = $sales->updateRevenu($month, $year, $revenue);

				if(isset($salesRevenu)){
					$getOrder->updateAccounted($dateValue['id']);
				}
			}
			else {
				$salesRevenu = $sales->insert([
					'month'   => $month,
					'year' 	  => $year,
					'revenue' => $dateValue['total'],
 				]);

 				if(isset($salesRevenu)){
 					$getOrder->updateAccounted($dateValue['id']);
 				}
			}
		}

		if(isset($salesRevenu)){
			$json = [
				'code' => 'ok',
			];
		}
		else {
			$json = [
				'code' => 'no',
				'msg'  => 'Erreur lors de la mise à jour du chiffre d\'affaire',
			];
		}

		$this->showJson($json);
	}

	/**
	 * Recherche pour listItem
	 */
	public function searchItem()
	{
		$json = [];
		$post = [];
		$viewSearch = null;

		if(isset($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));
			
			if(!empty($post['search'])){

				$searchItem = new ItemModel();

				$search = $searchItem->searchItem($post['search'], $post['category']);

				if(!empty($search)){
					foreach ($search as $value) {
						$viewSearch.= '<tr><td>'.$value['id'].'</td>';
						$viewSearch.= '<td>'.$value['name'].'</td>';
						$viewSearch.= '<td>'.$value['quantity'].'</td>';
						if($value['newPrice'] == 0) {
							$viewSearch.= '<td>'.$value['price'].'</td>';
						}
						elseif($value['newPrice'] > 0){
							$viewSearch.= '<td>'.$value['newPrice'].'</td>';
						}
						$viewSearch.= '<td>'.$value['statut'].'</td>';
						$viewSearch.= '<td><a href="'.$this->generateUrl('updateItem', ['id'=> $value['id']]).'"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></a></td>';
						$viewSearch.= '<td><button class="btn btn-danger delete-message" data-id="'.$value['id'].'">Effacer le message</button></td></tr>';
					}
				}
				else {
					$viewSearch = '<td>Aucun article correspondant à votre recherche</td>';
				}

				if($post['category'] == 'PlaymobilClassique'){	
					$json = [
						'code' => 'classique',
						'msg'  => $viewSearch
					];
				}
				elseif ($post['category'] == 'PlaymobilCustom') {
					$json = [
						'code' => 'custom',
						'msg'  => $viewSearch
					];
				}
				elseif($post['category'] == 'PiecesDetachees'){
					$json = [
						'code' => 'piece',
						'msg'  => $viewSearch
					];
				}
				elseif($post['category'] == 'Divers'){
					$json = [
						'code' => 'divers',
						'msg'  => $viewSearch
					];
				}
			}

			if($post['category'] == 'PlaymobilClassique'){	
				$json = [
					'code' => 'classique',
					'msg'  => 'Veuillez renseigner la recherche'
				];
			}
			elseif ($post['category'] == 'PlaymobilCustom') {
				$json = [
					'code' => 'custom',
					'msg'  => 'Veuillez renseigner la recherche'
				];
			}
			elseif($post['category'] == 'PiecesDetachees'){
				$json = [
					'code' => 'piece',
					'msg'  => 'Veuillez renseigner la recherche'
				];
			}
			elseif($post['category'] == 'Divers'){
				$json = [
					'code' => 'divers',
					'msg'  => 'Veuillez renseigner la recherche'
				];
			}
		}
		echo json_encode($json);
	}

	/**
	 * Recherche pour le chiffre d'affaire
	 */
	public function searchSales()
	{
		$json = [];
		$get = [];
		$viewSearch = null;
		$search = '';

		if(!empty($_GET)){
			$get = array_map('trim', array_map('strip_tags', $_GET));

			$searchSales = new SalesrevenueModel();

			if($get['search'] == 'Janvier' || $get['search'] == 'janvier'){
				$searchMonth = 1;
				$search = $searchSales->searchSalesByMonth($searchMonth);
			}
			elseif($get['search'] == 'Février' || $get['search'] == 'février' || $get['search'] == 'Fevrier' || $get['search'] == 'fevrier'){
				$searchMonth = 2;
				$search = $searchSales->searchSalesByMonth($searchMonth);
			}
			elseif($get['search'] == 'Mars' || $get['search'] == 'mars'){
				$searchMonth = 3;
				$search = $searchSales->searchSalesByMonth($searchMonth);
			}
			elseif($get['search'] == 'Avril' || $get['search'] == 'avril'){
				$searchMonth = 4;
				$search = $searchSales->searchSalesByMonth($searchMonth);
			}
			elseif($get['search'] == 'Mai' || $get['search'] == 'mai'){
				$searchMonth = 5;
				$search = $searchSales->searchSalesByMonth($searchMonth);
			}
			elseif($get['search'] == 'Juin' || $get['search'] == 'juin'){
				$searchMonth = 6;
				$search = $searchSales->searchSalesByMonth($searchMonth);
			}
			elseif($get['search'] == 'Juillet' || $get['search'] == 'juillet'){
				$searchMonth = 7;
				$search = $searchSales->searchSalesByMonth($searchMonth);
			}
			elseif($get['search'] == 'Août' || $get['search'] == 'août' || $get['search'] == 'Aout' || $get['search'] == 'aout'){
				$searchMonth = 8;
				$search = $searchSales->searchSalesByMonth($searchMonth);
			}
			elseif($get['search'] == 'Septembre' || $get['search'] == 'septembre'){
				$searchMonth = 9;
				$search = $searchSales->searchSalesByMonth($searchMonth);
			}
			elseif($get['search'] == 'Octobre' || $get['search'] == 'octobre'){
				$searchMonth = 10;
				$search = $searchSales->searchSalesByMonth($searchMonth);
			}
			elseif($get['search'] == 'Novembre' || $get['search'] == 'novembre'){
				$searchMonth = 11;
				$search = $searchSales->searchSalesByMonth($searchMonth);
			}
			elseif($get['search'] == 'Décembre' || $get['search'] == 'décembre' || $get['search'] == 'Decembre' || $get['search'] == 'decembre'){
				$searchMonth = 12;
				$search = $searchSales->searchSalesByMonth($searchMonth);
			}
			else{
				$search = $searchSales->searchSales($get['search']);	
			}

			if(!empty($search)){	
				foreach ($search as $value) {
					$viewSearch.= '<tr><td>'.$value['month'].'</td>';
					$viewSearch.= '<td>'.$value['year'].'</td>';
					$viewSearch.= '<td>'.$value['revenue'].'€</td>';
				}
			}
			else {
				$viewSearch.= '<td>Aucun mois/année correspondant à votre recherche</td>';
			}

			$json = [
				'code' => 'success',
				'msg'  => $viewSearch
			];
		}

		echo json_encode($json);
	}
}