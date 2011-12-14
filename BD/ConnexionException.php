<?php

class ConnexionException extends Exception
{
	public function __construct()
	{
		parent::__construct() ;
	}

	public function Message()
	{
		echo('ConnexionException : Erreur lors de la connexion ˆ la base de donnŽes !') ;
	}
}

?>
