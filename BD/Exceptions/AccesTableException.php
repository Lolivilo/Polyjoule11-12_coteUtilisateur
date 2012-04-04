<?php

class AccesTableException extends Exception
{
	public function __construct()
	{
		parent::__construct() ;
	}
	
	public function Message()
	{
		echo( 'AccesTableException : Erreur lors de l\'accs ˆ la table de la base de donnŽes !' ) ;
	}

}

?>
