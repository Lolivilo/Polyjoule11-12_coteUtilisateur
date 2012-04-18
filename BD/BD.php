<?php
    
    //chargement des classes correspondant aux 2 types d'exception
    require_once('Exceptions/ConnexionException.php');
    require_once('Exceptions/AccesTableException.php');
    require_once("Exceptions/RequestException.php");
    
    class Bd
    {  
        private $host ;
        private $database ;
        private $user ;
        private $port ;
        private $password ;
        private $connexion ;
        
        // constructeur
        // permet de valuer les 4 premiers attributs de la classe
        public function __construct()
        {
        
             $this->host = 'mysql51-62.perso';
             $this->database = 'polyjoule01';
             $this->user = 'polyjoule01';
             $this->password = '01admPoly';
             /*
            $this->host = 'instance6964.db.xeround.com' ;
            $this->database = 'polyjoule' ;
            $this->port = '5214' ;
            $this->user = 'polyjoule' ;
            $this->password = 'admin' ;
            */
            
        }
        
        // mthode qui permet de se connecter  la base de donnes
        // une exception ConnexionException est leve s'il y a un problme de connexion  la base
        public function connexion() 
        {
            try
            {
                //$dns = "mysql:host=".$this->host.";port=".$this->port.";dbname=".$this->database;
                $dns = "mysql:host=".$this->host.";dbname=".$this->database;
                //echo $dns.'      '.$this->user.$this->password;
                $this->connexion = new PDO( $dns , $this->user , $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") ) ;
                
            }
            catch ( PDOException $e )
            {
            	echo $e->getMessage();
                $ex = new ConnexionException();
                //$ex->Redirect();
                $ex->message();
                //echo("ERREUR BORDEL");
                //echo($ex->getCode() );
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
            if(ctype_digit($string))
			{
				$string = intval($string);
			}
			else
			{
				$this->connexion();
				$string = mysql_real_escape_string($string);
				$string = addcslashes($string, '%_');
			}
			return $string;
        }
        
        public static function securityHTML($string)
        {
        	return htmlentities($string);
        }
        
        
        
    }
    
    //FONCTIONS NON MEMBRES : FONCTION DE SECURITE
    //
    //
    function NoHtml($string)
    {
    	return strip_tags($string);
    }
    ?>