<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\SlideModel;
use \W\Security\AuthorizationModel;
use \W\Security\AuthentificationModel;
use \Respect\Validation\Validator as v;
use \Intervention\Image\ImageManagerStatic as Image;

class SlideController extends Controller 
{
	/**
	 * Liste des Slides
	 */
	public function listSlide()
	{
		$list = new SlideModel();
		$slide = $list->findAll();

		$data = [
			'slide'	=> $slide,
		];

		if(!empty($_SESSION)){

			$this->show('back/Slide/listSlide', $data);

			if($_SESSION['role'] == 'Utilisateur') {
				$this->redirectToRoute('front_index');
			}
		}
		else {
			$this->redirectToRoute('back_login');
		}
	}

	/**
	 * Ajout de Slide
	 */
	public function addSlide()
	{
		$this->show('back/Slide/addSlide');
	}

	/**
	 * Mise à jour de Slide
	 */
	public function updateSlide()
	{
		$this->show('back/Slide/updateSlide');
	}

	/** 
	 * Suppression de Slide
	 */
	public function deleteSlide()
	{
		$this->show('back/Slide/deleteSlide');
	}
}