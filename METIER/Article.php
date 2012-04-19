<?php

//require_once('../BD/BD.php');

class Article
{  
	private $id;
	private $idRubrique;
	private $auteur;
	private $titreFR;
	private $titreEN;
	private $contenuFR;
	private $contenuEN;
	private $autorisationCommentaire;
	private $statut;
	private $photo_principale;
	private $visible_home;
	
	/** Constructeur de Article
	 * 
	 * Objet qui reprŽsente un tuple de la table Article
	 * @param unknown_type $idArticle
	 * @param unknown_type $titreFRArticle
	 * @param unknown_type $titreENArticle
	 * @param unknown_type $contenuFRArticle
	 * @param unknown_type $contenuENArticle
	 * @param unknown_type $autorisationCommentaire
	 */
	public function __construct( $idArticle , $idRubrique, $auteur, $titreFRArticle , $titreENArticle , $contenuFRArticle, $contenuENArticle, $autorisationCommentaire, 									$statut, $date, $photo_principale, $visible_home  )
	{
		$this->id = $idArticle;
		$this->idRubrique = $idRubrique;
		$this->auteur = $auteur;
		$this->titreFR = $titreFRArticle;
		$this->titreEN = $titreENArticle;
		$this->contenuFR = $contenuFRArticle;
		$this->contenuEN = $contenuENArticle;
		$this->autorisationCommentaire = $autorisationCommentaire;
        $this->date = $date;
        $this->photo_principale = $photo_principale;
        $this->visible_home = $visible_home;
	}
	
	public function getId()
	{
		return $this->id ;
	}
	
	public function getAuteur()
	{
		return $this->auteur();
	}
	
	public function getIdRubrique()
	{
		return $this->idRubrique;
	}
    
	public function getTitre()
	{
		if( (ISSET($_SESSION['langue'])) && ($_SESSION['langue'] == 'FR') )
		{
			return $this->titreFR;
		}
		else if( (ISSET($_SESSION['langue'])) && ($_SESSION['langue'] == 'EN') )
		{
			return $this->titreEN;
		}
		else
		{
			// A TRAITER ???
		}
	}
	
    public function getDate()
    {
        return $this->date;
    }
    
    public function getFormatedDate()
    {	
        return date('d', strtotime($this->date))." ".$this->getStringMonth(strtotime($this->date))." ".date('Y', strtotime($this->date));
    }
    
    private function getStringMonth($date)
    {
    	$stringDay = "";
    	if($_SESSION['langue'] == 'EN')
    	{
    		$stringDay = date("F",$date);
    	}
    	else
    	{
    		switch(intval(date("m",$date)))
    		{
    			case 1:
    				$stringDay = "Janvier";
    				break;
    			case 2:
    				$stringDay = "F&eacute;vrier";
    				break;
    			case 3:
    				$stringDay = "Mars";
    				break;
    			case 4:
    				$stringDay = "Avril";
    				break;
    			case 5:
    				$stringDay = "Mai";
    				break;
    			case 6:
    				$stringDay = "Juin";
    				break;
    			case 7:
    				$stringDay = "Juillet";
    				break;
    			case 8:
    				$stringDay = "Ao&ucirc;t";
    				break;
    			case 9:
    				$stringDay = "Septembre";
    				break;
    			case 10:
    				$stringDay = "Octobre";
    				break;
    			case 11:
    				$stringDay = "Novembre";
    				break;
    			case 12:
    				$stringDay = "D&eacute;cembre";
    				break;
    		}
    	}
    	return $stringDay;
    }
    
	public function getContenu()
    {
        if($_SESSION['langue'] == 'EN')
        {
            return $this->contenuEN;
        }
        else
        {
            return $this->contenuFR;
        }
    }
    
	
    public function getApercu()
    {
    	$text = "";
    	$nb_max_mots = 20;
    	
        $text = Bd::securityHTML($this->getContenu());
        
        $apercu = "";
		$t_chaineNouvelle = explode(" ",$text);
		foreach($t_chaineNouvelle as $cle => $mot)
		{
			if($cle < $nb_max_mots)
			{
				$apercu .= $mot." ";
			}
		}
		return $apercu."...";
		
    }
    
   	public function getAutorisationCommentaire()
	{
		return $this->autorisationCommentaire ;
	}

	public function getStatut()
	{
		return $this->statut;
	}
	
    public function getUrl()
    {
        $idArticle = intval($this->id);
        return("article-".$idArticle);
    }
    
    public function getBasePhoto()
    {
    	return $this->photo_principale;
    }
    
    public function getVisibleHome()
    {
    	return $this->visible_home;
    }
    
    

}
?>