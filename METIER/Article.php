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
	
	/** Constructeur de Article
	 * 
	 * Objet qui reprsente un tuple de la table Article
	 * @param unknown_type $idArticle
	 * @param unknown_type $titreFRArticle
	 * @param unknown_type $titreENArticle
	 * @param unknown_type $contenuFRArticle
	 * @param unknown_type $contenuENArticle
	 * @param unknown_type $autorisationCommentaire
	 */
	public function __construct( $idArticle , $idRubrique, $titreFRArticle , $titreENArticle , $contenuFRArticle, $contenuENArticle, $autorisationCommentaire, $date  )
	{
		$this->id = $idArticle;
		$this->idRubrique - $idRubrique;
		$this->titreFR = $titreFRArticle;
		$this->titreEN = $titreENArticle;
		$this->contenuFR = $contenuFRArticle;
		$this->contenuEN = $contenuENArticle;
		$this->autorisationCommentaire = $autorisationCommentaire;
        $this->date = $date;
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
        $url = "http://localhost:8888/article.php?article=".$idArticle;
        return $url;
    }

}
?>