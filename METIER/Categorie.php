<?php
class Categorie
{  
	private $id;
	private $idParent;
	private $titreFR;
	private $titreEN;
		
	public function __construct( $idCat , $idCatParent , $titreFRCat , $titreENCat )
	{
		$this->id = $idCat ;
		$this->idParent = $idCatParent ;
		$this->titreFR = $titreFRCat ;
		$this->titreEN = $titreENCat ;
		
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
        $url = "http://localhost:8888/listArticle.php?cat=".$idCat;
        return $url;
    }
	
}
?>