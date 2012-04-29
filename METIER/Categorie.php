<?php
	include_once('../BD/BD.php');
	require_once('../BD/acces_rubrique.php');
	
	
class Categorie
{  
	private $id;
	private $idParent;
	private $titreFR;
	private $titreEN;
	private $descFR;
	private $descEN;
	private $idTemplate;
	
    
	public function __construct( $idCat , $idCatParent , $titreFRCat , $titreENCat, $descFR, $descEN, $idTemplate)
	{
		$this->id = $idCat ;
		$this->idParent = $idCatParent ;
		$this->titreFR = $titreFRCat ;
		$this->titreEN = $titreENCat ;
		$this->descFR = $descFR;
		$this->descEN = $descEN;
        $this->idTemplate = $idTemplate;
	}
	
	public function getId()
	{
		return $this->id ;
	}
	
	public function getIdParent()
	{
		return $this->idParent ;
	}
	
	public function getTitre()
    {
        if($_SESSION['langue'] == 'EN')
        {
            return Bd::securityHTML($this->titreEN);
        }
        else
        {
            return Bd::securityHTML($this->titreFR);
        }
    
    }
	
	public function getDesc()
	{
		if($_SESSION['langue'] == 'EN')
		{
			//return Bd::securityHTML($this->descEN);
			return $this->descEN;
		}
		else
		{
			//return Bd::securityHTML($this->descFR);
			return $this->descFR;
		}
	}
    
    /**
    Sera toujours appelée dans le dossier PRESENTATION => lien relatif a partir de la
    **/
    public function getUrl()
    {
        $idCat = intval($this->id);

        //$ret = getNomTemplateById($this->idTemplate)."?cat=".$idCat;
		$template = getNomTemplateById($this->idTemplate);
		
		////// TEMPORAIRE : POUR LA MISE EN LIGNE /////////
		if($this->id == 1)
		{
			return("lassociation.php");
		}
		
		if($this->id == 2)
		{
			return("leshelleco.php?cat=2");
		}
		
		if($this->id == 8)
		{
			return("lurbanconcept.php?cat=8");
		}
		
		if($this->id == 20)
		{
			return("leduceco.php?cat=20");
		}
		
		$url = NULL;
		switch($template)
		{
			case "rubrique": 
				$url = "rubrique-".$idCat;
				break;
			case "rubriquearticles.php":
				$url = $template."?cat=".$this->id;
				break;
			default: 
				$url = $template;
				break;
		}
        
        
        return $url;
    }
    
    public function getIdTemplate()
    {
    	return $this->idTemplate;
    }	
}
?>