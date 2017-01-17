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
}