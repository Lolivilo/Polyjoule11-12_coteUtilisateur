<?php

class ConnexionException extends PDOException
{
	public function __construct()
	{
		parent::__construct("Echec lors de la connexion ˆ la base de donnŽes Poyjoule !", 100, NULL);
	}

	public function Message()
	{
		echo('ConnexionException : Erreur lors de la connexion ˆ la base de donnŽes !') ;
	}
    
    public function Redirect()
    {
        echo( parent::getCode() );
        $url = "http://".$_SERVER['HTTP_HOST']."/PRESENTATION/erreur.php?code=".parent::getCode();
        header('location: $url');
        
    }
}

?>
