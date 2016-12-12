<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\SlideModel;
use \W\Security\AuthorizationModel;

class SlideController extends Controller 
{
	/**
	 * Liste des Slides
	 */
	public function listSlide()
	{
		$this->show('back/Slide/listSlide');
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