<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\GuestbookModel;

class FrontController extends Controller
{
	
	/**
	 * Page d'accueil par défaut
	 */
	public function index()
	{	
		$getComment = new GuestbookModel();
		$comments = $getComment->findAllMessageFront();
		$data = [
			'comments' => $comments,
			
		]; 
		$this->show('front/index', $data);
	}

	/**
	 * Page A propos
	 */
	public function about()
	{
		$this->show('front/Pages/aPropos');
	}
	/**
	 * Page CGV
	 */
	public function cgv()
	{
		$this->show('front/Pages/cgv');
	}
	/**
	 * Page A propos
	 */
	public function contact()
	{
		$this->show('front/Pages/contact');
	}
	/**
	 * Page A propos
	 */
	public function legalMention()
	{
		$this->show('front/Pages/legalMention');
	}
	/**
	 * Page Events
	 */
	public function events()
	{
		$this->show('front/Event/viewEvent');
	}

}