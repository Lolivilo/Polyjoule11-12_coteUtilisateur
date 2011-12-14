<?php
class Article
{  
	private $id;
	private $titreFR;
	private $titreEN;
	private $contenuFR;
	private $contenuEN;
	private $autorisationCommentaire;
	
	public function __construct( $idArticle , $titreFRArticle , $titreENArticle , $contenuFRArticle, $contenuENArticle, $autorisationCommentaire  )
	{
		$this->id = $idArticle ;
		$this->titreFR = $titreFRArticle ;
		$this->titreEN = $titreENArticle ;
		$this->contenuFR = $contenuFRArticle ;
		$this->contenuEN = $contenuENArticle ;
		$this->autorisationCommentaire = $autorisationCommentaire ;
	
	}
	
	public function getId()
	{
		return $this->id ;
	}
	public function setId($id_)
	{
		$this->id = $id_;
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
	public function setTitreEN($titreEN)
	{
		$this->titreEN = $titreEN;
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
}
?>