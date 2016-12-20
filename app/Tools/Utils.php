<?php 	

namespace Tools;

class Utils 
{
	/**
	* Calcul du prix TTC
	* @param float $prix le prix unitaire
	* @param int $quantity la quantité
	* @return float $calculTtc Le prix total
	*/
	public static function calculTtc($prix, $quantity) 
	{
		$calculTtc = $prix * $quantity;
		return $calculTtc;

	}

	/**
	* Calcul du prix total avec frais de port
	* @param float $prix le prix unitaire
	* @param float $fdp les frais de port
	* @return float $calculTotal Le prix total
	*/
	public static function calculTotal($prixTtc, $fdp) 
	{
		$calculTotal = $prixTtc + $fdp ;
		return $calculTotal;

	}

}