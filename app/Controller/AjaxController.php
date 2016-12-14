<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Model\UsersModel;
use \Model\ItemModel;
use \Model\MessageModel;
use \Model\EventModel;
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
			
		if($logout->logUserOut()) {
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
}