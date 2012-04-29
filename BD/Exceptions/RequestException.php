<?php

class RequestException extends Exception
{
	public function __construct()
	{
		parent::__construct("Erreur lors de l'analyse du resultat d'une requête : ce dernier doit être vide !");
	}
}

?>