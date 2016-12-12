<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\SlideModel;
use \W\Security\AuthorizationModel;

class SlideController extends Controller 
{
	public function listSlide()
	{
		$this->show('back/Slide/listSlide');
	}

	public function addSlide()
	{
		$this->show('back/Slide/addSlide');
	}

	public function updateSlide()
	{
		$this->show('back/Slide/updateSlide');
	}

	public function deleteSlide()
	{
		$this->show('back/Slide/deleteSlide');
	}
}