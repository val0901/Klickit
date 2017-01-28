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
use \W\Security\AuthentificationModel;

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
					$user = $findUser->findUser($value['id']);
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
	 * Update table item pour stocker filtre
	 */
	public function UpdateItemFilter()
	{
		$post = [];
		$getInfos = new ItemModel;
		$insert = new FiltrearticleModel;
		$json = [];

		$lastItem = $getInfos->RealLastInsertId();

		$RealLastItem = end($lastItem);

		if(!empty($_POST)){
			foreach($_POST as $key => $value){
				$post[$key] = trim(strip_tags($value));
			}

			$my_filters = explode(', ', $post['fil']);
			$my_filters2 = '';

			foreach($my_filters as $value){
				$insert_filter = $insert->insert([
					'id_item'		=>  $RealLastItem,
					'name_filter'	=>	$my_filters,
				]);
				$filters2.= $value.', ';
			}

			$my_filters2 = substr($filters1, 0, -2);

			if($my_filters2 == $post['fil']){
				$json = ['code'	=>	'ok'];
			}else{
				$json = ['code'	=>	'no'];
			}
		}
		$this->showJson($json);
	}

	/**
	* Ajout des filtres lors de l'ajout d'un article en bdd
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
}