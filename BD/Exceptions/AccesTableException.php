<?php

class AccesTableException extends Exception
{
	public function __construct()
	{
		parent::__construct() ;
	}
	
	public function Message()
	{
		echo( 'AccesTableException : Erreur lors de l\'acc�s � la table de la base de donn�es !' ) ;
	}

}

?>
