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
		$this->descFR = $descEN;
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
		if( (isset($_SESSION['langue'])) && ($_SESSION['langue'] == 'FR') )
		{
			return Bd::securityHTML($this->descFR);
		}
		else if( (isset($_SESSION['langue'])) && ($_SESSION['langue'] == 'FR') )
		{
			return Bd::securityHTML($this->descEN);
		}
	}
    
    /**
    Sera toujours appelée dans le dossier PRESENTATION => lien relatif a partir de la
    **/
    public function getUrl()
    {
        $idCat = intval($this->id);
        $ret = getNomTemplateById($this->idTemplate)."?cat=".$idCat;
        
        
        return $ret;
    }
    
    public function getIdTemplate()
    {
    	return $this->idTemplate;
    }	
}
?>