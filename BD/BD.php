<?php

//chargement des classes correspondant aux 2 types d'exception
include_once 'ConnexionException.php';
include_once 'AccesTableException.php';


class Bd
{  
	private $host ;
	private $database ;
	private $user ;
	private $password ;
	private $connexion ;

// constructeur
// permet de valuer les 4 premiers attributs de la classe
	public function __construct()
	{
		$this->host = 'localhost' ;
		$this->database = 'polyjoule' ;
		$this->user = 'polyjoule' ;
		$this->password = 'azerty' ;
		/*$this->host = 'sql.olympe-network.com' ;
		$this->database = '138931_polyj' ;
		$this->user = '138931_polyj' ;
		$this->password = 'polyjoule' ;*/
		
	}

// mthode qui permet de se connecter  la base de donnes
// une exception ConnexionException est leve s'il y a un problme de connexion  la base
	public function connexion() 
	{
		try
		{
			$dns = "mysql:host=".$this->host.";dbname=".$this->database;
			//echo $dns.'      '.$this->user.$this->password;
			$this->connexion = new PDO( $dns , $this->user , $this->password ) ;
			
		}
		catch ( PDOException $e )
		{
			$ex = new ConnexionException() ;
			$ex->Message() ;
	    }
	}

//Methode permettant la deconnexion de la base de donnees
	public function deconnexion()
	{
		$this->connexion = null;
		//echo('La dconnexion fonctionne !<br />') ;
	}

// les accesseurs
	public function getHost()
	{
	    return $this->host ;
	}
	
	public function getDatabase()
	{
		return $this->database ;
	}

	public function getUser()
	{
	    return $this->user ;
	}

	public function getPassword()
	{
	    return $this->password ;
	}
	
	public function getConnexion()
	{
		return $this->connexion ;
	}

// les modifieurs
	public function setHost( $host )
	{
		$this->host = $host ;
	}
	
	public function setDatabase( $database )
	{
		$this->database = $database ;
	}

	public function setUser( $user )
	{
		$this->user = $user ;
	}

	public function setPassword( $password )
	{
		$this->password = $password ;
	}
	
    public function security($string)
    {
    	settype ($string, "string"); 
    	return $string;
    	
    }
	
	
	
}

?>
