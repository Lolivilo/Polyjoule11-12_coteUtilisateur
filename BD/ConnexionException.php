<?php

class ConnexionException extends Exception
{
	public function __construct()
	{
		parent::__construct("Echec lors de la connexion � la base de donn�es Poyjoule !", 100, NULL);
	}

	public function Message()
	{
		echo('ConnexionException : Erreur lors de la connexion � la base de donn�es !') ;
	}
}

?>
