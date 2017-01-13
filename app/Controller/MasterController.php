<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\BasketModel;

class MasterController extends Controller
{

	/**
	 * Constante du chemin du dossier des vues
	 */
	const PATH_VIEWS = '../app/Views';
	
	/**
	 * Affiche un template
	 * @param string $file Chemin vers le template, relatif à app/Views/
	 * @param array  $data Données à rendre disponibles à la vue
	 */
	public function showStuff($file, array $data = array())
	{
		//incluant le chemin vers nos vues
		$engine = new \League\Plates\Engine(self::PATH_VIEWS);

		//charge nos extensions (nos fonctions personnalisées)
		$engine->loadExtension(new \W\View\Plates\PlatesExtensions());

		$app = getApp();

		$getBasket = new BasketModel;
		$user = $this->getUser(); //On récupère l'utilisateur connecté

		// Rend certaines données disponibles à tous les vues
		// accessible avec $w_user & $w_current_route dans les fichiers de vue
		$engine->addData(
			[
				'w_user' 		  => $this->getUser(),
				'w_current_route' => $app->getCurrentRoute(),
				'w_site_name'	  => $app->getConfig('site_name'),
				'w_items'		  => $getBasket->getShoppingCartItem($user['id']),
			]
		);

		// Retire l'éventuelle extension .php
		$file = str_replace('.php', '', $file);

		// Affiche le template
		echo $engine->render($file, $data);
		die();
	}


}