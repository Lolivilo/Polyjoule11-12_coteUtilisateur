<?php
class Categorie
{  
	private $id;
	private $idParent;
	private $titreFR;
	private $titreEN;
    
	public function __construct( $idCat , $idCatParent , $titreFRCat , $titreENCat, $albumId, $personneId, $isLivreOr )
	{
		$this->id = $idCat ;
		$this->idParent = $idCatParent ;
		$this->titreFR = $titreFRCat ;
		$this->titreEN = $titreENCat ;
        $this->albumId = $albumId;
        $this->isLivreOr = $isLivreOr;
        $this->personneId = $personneId;
	}
	
	public function getId()
	{
		return $this->id ;
	}
	public function setId($id_)
	{
		$this->id = $id_;
	}
	
	public function getIdParent()
	{
		return $this->idParent ;
	}
	public function setIdParent($idParent_)
	{
		$this->idParent = $idParent_;
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
	public function setTitreEN($titreEN)
	{
		$this->titreEN = $titreEN;
	}
    
    public function getUrl()
    {
        $idCat = intval($this->id); // ATTENTION DANS LE FUTUR IL FAUDRA GERER SI LA CATEGORIE RENVOIE VERS UNE LISTE DARTICLE OU VERS UNE LISTE DE NEWS !!!!
        return( "http://".$_SERVER['HTTP_HOST']."/PRESENTATION/listArticle.php?cat=".$idCat );
    }
    
    public function getAlbumId()
    {
        return $this->albumId;
    }
    
    public function getIsLivreOr()
    {
        return $this->isLivreOr;
    }
    
    public function getPersonneId()
    {
        return $this->personneId;
    }
    
    public function isLivreOr()
    {
        if($this->getIsLivreOr() == 1 )
        {
            return true ;
        }
        return false;
    }
    
    
    public function isAlbum()
    {
        if( $this->getAlbumId() != NULL )
        {
            return true;
        }
        return false;
    }
    
    
    public function isPersonne()
    {
        if( $this->getPersonneId() != NULL )
        {
            return true;
        }
        return false;
    }
	
}
?>