<?php
class Article
{  
	private $id;
	private $idRubrique;
	private $titreFR;
	private $titreEN;
	private $contenuFR;
	private $contenuEN;
	private $autorisationCommentaire;
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
	public function __construct( $idArticle , $idRubrique, $titreFRArticle , $titreENArticle , $contenuFRArticle, $contenuENArticle, $autorisationCommentaire, $date, $photo_principale, $visible_home  )
	{
		$this->id = $idArticle;
		$this->idRubrique - $idRubrique;
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
	public function setId($id_)
	{
		$this->id = $id_;
	}
	
	public function getIdRubrique()
	{
		return $this->idRubrique;
	}
    
	public function getTitre()
    {
        if($_SESSION['langue'] == 'EN')
        {
            return $this->titreEN;
        }
        else
        {
            return $this->titreFR;
        }

    }
	public function getTitreFR()
	{
		return $this->titreFR ;
	}
	public function setTitreFR($titreFR)
	{
		$this->titreFR = $titreFR;
	}
	
	public function getTitreEN()
	{
		return $this->titreEN ;
	}
    
    public function getDate()
    {
        return $this->date;
    }
    
    public function getFormatedDate()
    {
        return( date('d/m/y', strtotime($this->date)) );
    }
    
	public function setTitreEN($titreEN)
	{
		$this->titreEN = $titreEN;
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
        if($_SESSION['langue'] == 'EN')
        {
            $text = $this->contenuEN;
        }
        else
        {
            $text = $this->contenuFR;
        }
        
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
    
	public function getContenuFR()
	{
		return $this->contenuFR;
	}
	public function setContenuFR($contenuFR)
	{
		$this->contenuFR = $contenuFR;
	}
	
	public function getContenuEN()
	{
		return $this->contenuEN;
	}
	public function setContenuEN($contenuEN)
	{
		$this->contenuEN = $contenuEN;
	}
	
	public function getAutorisationCommentaire()
	{
		return $this->autorisationCommentaire ;
	}
	public function setAutorisationCommentaire($autCom)
	{
		$this->autorisationCommentaire = $autCom;
	}
    
    public function getUrl()
    {
        $idArticle = intval($this->id);
        return "http://".$_SERVER['HTTP_HOST']."/PRESENTATION/article.php?article=".$idArticle;
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