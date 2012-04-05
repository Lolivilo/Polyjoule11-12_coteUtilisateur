<?php
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
        return( date('d/m/y', strtotime($this->date)) );
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
    	
        $text = $this->getContenu();
        
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
        return("article.php?article=".$idArticle);
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