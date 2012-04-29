<?php

class ConnexionException extends PDOException
{
	public function __construct()
	{
		parent::__construct("Echec lors de la connexion ˆ la base de donnes Polyjoule !", 100, NULL);
	}
	
	public function message()
	{
		echo("<p>ConnexionException : ".$this->message." (Peut-tre est-elle hors ligne ?)</p>");
	}
}

?>
